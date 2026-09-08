<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Services\PaystackService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    protected PaystackService $paystack;

    public function __construct(PaystackService $paystack)
    {
        $this->paystack = $paystack;
    }

    /**
     * Show Checkout Review Screen
     */
    public function checkout(Request $request)
    {
        $user = Auth::user();
        $cartItems = CartItem::with('product')
            ->where(function ($query) use ($user) {
                if ($user) {
                    $query->where('user_id', $user->id);
                } else {
                    $query->where('session_id', session()->getId());
                }
            })->get();

        // If cart is empty, redirect back to catalog with message
        if ($cartItems->isEmpty()) {
            return redirect()->route('catalog')->with('info', 'Your procurement cart is currently empty. Add items from the catalog to checkout.');
        }

        $subtotal = $cartItems->sum(fn($i) => $i->unit_price * $i->quantity);
        $retailMsrp = $cartItems->sum(function($i) {
            $msrp = $i->product->msrp ?: ($i->unit_price * 1.45);
            return $msrp * $i->quantity;
        });
        $savings = max(0, $retailMsrp - $subtotal);

        return view('checkout', compact('cartItems', 'subtotal', 'retailMsrp', 'savings', 'user'));
    }

    /**
     * Initialize Paystack Payment for Current Cart
     */
    public function initialize(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'company_name' => 'nullable|string|max:255',
            'shipping_address' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'nullable|string',
            'payment_method' => 'required|string|in:paystack,net30,net60',
        ]);

        $user = Auth::user();
        $userId = $user ? $user->id : null;
        $sessionId = session()->getId();

        $cartItems = CartItem::with('product')
            ->where(function ($query) use ($userId, $sessionId) {
                if ($userId) {
                    $query->where('user_id', $userId);
                } else {
                    $query->where('session_id', $sessionId);
                }
            })->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Cart is empty');
        }

        $subtotal = $cartItems->sum(fn($i) => $i->unit_price * $i->quantity);
        $totalAmount = $subtotal; // B2B Consolidated delivery inclusive

        $orderNumber = 'EB-PO-' . strtoupper(dechex(time())) . rand(10, 99);
        $invoiceRef = 'EB-INV-' . date('Y') . '-' . rand(1000, 9999);

        // Begin Transaction
        DB::beginTransaction();
        try {
            // Create Order
            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => $userId ?: 1, // Default buyer or guest linked
                'subtotal' => $subtotal,
                'tax_amount' => 0.00,
                'shipping_amount' => 0.00,
                'total_amount' => $totalAmount,
                'payment_status' => $request->payment_method === 'paystack' ? 'pending' : $request->payment_method,
                'fulfillment_status' => 'processing',
                'single_invoice_ref' => $invoiceRef,
                'shipping_address' => [
                    'company' => $request->company_name ?: ($user->company_name ?? 'Procurement Department'),
                    'address' => $request->shipping_address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip ?? '',
                    'email' => $request->email,
                ],
                'notes' => $request->notes ?? 'Consolidated single-invoice B2B order.',
            ]);

            // Create Order Items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'supplier_id' => $item->product->supplier_id ?? null,
                    'product_name' => $item->product->name,
                    'product_sku' => $item->product->sku ?: 'SKU-' . $item->product_id,
                    'unit_price' => $item->unit_price,
                    'quantity' => $item->quantity,
                    'total_price' => $item->unit_price * $item->quantity,
                    'status' => 'awaiting_packing',
                ]);
            }

            // Handle Net-30 / Net-60 Corporate Terms
            if (in_array($request->payment_method, ['net30', 'net60'])) {
                // Clear cart immediately
                CartItem::where(function ($query) use ($userId, $sessionId) {
                    if ($userId) $query->where('user_id', $userId);
                    else $query->where('session_id', $sessionId);
                })->delete();

                DB::commit();
                return redirect()->route('order.invoice', ['orderNumber' => $order->order_number])
                    ->with('success', "Order {$orderNumber} successfully issued under {$request->payment_method} corporate terms!");
            }

            // Paystack Payment flow
            $reference = 'EB-PAY-' . strtoupper(uniqid());

            Payment::create([
                'order_id' => $order->id,
                'user_id' => $userId ?: 1,
                'reference' => $reference,
                'amount' => $totalAmount,
                'currency' => 'NGN',
                'payment_method' => 'paystack',
                'status' => 'pending',
            ]);

            DB::commit();

            // Initialize with Paystack
            $paystackData = $this->paystack->initializeTransaction([
                'email' => $request->email,
                'amount' => $totalAmount,
                'reference' => $reference,
                'callback_url' => route('payment.callback'),
                'metadata' => [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                    'buyer_name' => $user->username ?? 'Buyer',
                ]
            ]);

            if ($paystackData['status'] && !empty($paystackData['authorization_url'])) {
                return redirect()->away($paystackData['authorization_url']);
            }

            return redirect()->route('cart')->with('error', 'Unable to initiate Paystack gateway: ' . ($paystackData['message'] ?? 'Please try again.'));

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Order placement failure: ' . $e->getMessage());
            return redirect()->route('cart')->with('error', 'An error occurred during checkout. Please try again.');
        }
    }

    /**
     * Paystack Redirect Callback Verification
     */
    public function callback(Request $request)
    {
        $reference = $request->query('reference') ?? $request->query('trxref');

        if (!$reference) {
            return redirect()->route('cart')->with('error', 'No transaction reference found.');
        }

        $verification = $this->paystack->verifyTransaction($reference);
        $payment = Payment::where('reference', $reference)->first();

        if (!$payment) {
            // Find latest order if reference missing
            $order = Order::latest()->first();
        } else {
            $order = $payment->order;
        }

        if ($verification['status'] && $order) {
            // Update Payment record
            if ($payment) {
                $payment->update([
                    'status' => 'success',
                    'channel' => $verification['channel'] ?? 'card',
                    'gateway_response' => $verification['raw'] ?? [],
                    'paid_at' => now(),
                ]);
            }

            // Update Order record
            $order->update([
                'payment_status' => 'paid',
                'fulfillment_status' => 'processing',
            ]);

            // Clear User's Cart
            $user = Auth::user();
            CartItem::where(function ($query) use ($user) {
                if ($user) $query->where('user_id', $user->id);
                else $query->where('session_id', session()->getId());
            })->delete();

            return redirect()->route('order.invoice', ['orderNumber' => $order->order_number])
                ->with('success', 'Payment confirmed via Paystack! Single consolidated tax invoice is ready.');
        }

        if ($payment) {
            $payment->update(['status' => 'failed']);
        }

        return redirect()->route('cart')->with('error', 'Payment verification was unsuccessful. Please check card details or contact support.');
    }

    /**
     * Display Single Consolidated Invoice & Order Receipt
     */
    public function invoice($orderNumber)
    {
        $order = Order::with(['items.product', 'payment', 'user'])
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        return view('invoice', compact('order'));
    }

    /**
     * Paystack Webhook Handler
     */
    public function webhook(Request $request)
    {
        $signature = $request->header('x-paystack-signature');
        $secret = config('services.paystack.secret_key');

        if (!$signature || ($signature !== hash_hmac('sha512', $request->getContent(), $secret))) {
            return response()->json(['status' => 'ignored'], 400);
        }

        $event = $request->input('event');
        $data = $request->input('data');

        if ($event === 'charge.success') {
            $reference = $data['reference'] ?? null;
            if ($reference) {
                $payment = Payment::where('reference', $reference)->first();
                if ($payment) {
                    $payment->update([
                        'status' => 'success',
                        'channel' => $data['channel'] ?? 'card',
                        'paid_at' => now(),
                    ]);
                    $payment->order->update([
                        'payment_status' => 'paid',
                        'fulfillment_status' => 'processing',
                    ]);
                }
            }
        }

        return response()->json(['status' => 'success'], 200);
    }
}

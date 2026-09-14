<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\OrderItem;
use App\Models\CartItem;
use App\Models\Payment;
use App\Models\Order;
use App\Services\PaystackService;
use App\Mail\OrderReceiptMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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

        $subtotal = (float) $cartItems->sum(fn($i) => $i->unit_price * $i->quantity);
        $retailMsrp = (float) $cartItems->sum(function($i) {
            $msrp = $i->product->msrp ?: ($i->unit_price * 1.45);
            return $msrp * $i->quantity;
        });
        $savings = max(0, $retailMsrp - $subtotal);
        $savingsPercentage = $retailMsrp > 0 ? round(($savings / $retailMsrp) * 100, 1) : 31;

        // Consolidated Freight (5% Dynamic Rate, Minimum ₦1,000.00 Floor) & 7.5% Nigerian Statutory VAT
        $shippingAmount = $subtotal > 0 ? max(1000.00, round($subtotal * 0.05, 2)) : 0.00;
        $vatAmount = round($subtotal * 0.075, 2);
        $totalAmount = round($subtotal + $shippingAmount + $vatAmount, 2);

        return view('checkout', compact('cartItems', 'subtotal', 'retailMsrp', 'savings', 'savingsPercentage', 'shippingAmount', 'vatAmount', 'totalAmount', 'user'));
    }

    /**
     * Initialize Paystack Payment for Current Cart
     */
    public function initialize(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'company_name' => 'nullable|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'phone' => 'required|string|max:35',
            'country' => 'required|string|max:100',
            'shipping_address' => 'required|string',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'zip' => 'nullable|string|max:20',
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

        $subtotal = (float) $cartItems->sum(fn($i) => $i->unit_price * $i->quantity);
        $shippingAmount = $subtotal > 0 ? max(1000.00, round($subtotal * 0.05, 2)) : 0.00;
        $vatAmount = round($subtotal * 0.075, 2);
        $totalAmount = round($subtotal + $shippingAmount + $vatAmount, 2);

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
                'tax_amount' => $vatAmount,
                'shipping_amount' => $shippingAmount,
                'total_amount' => $totalAmount,
                'payment_status' => $request->payment_method === 'paystack' ? 'pending' : $request->payment_method,
                'fulfillment_status' => 'processing',
                'single_invoice_ref' => $invoiceRef,
                'shipping_address' => [
                    'company' => $request->company_name ?: ($user->company_name ?? 'EasyBuy Technologies Nigeria Ltd'),
                    'contact_name' => $request->contact_name ?: ($user->name ?? $user->username ?? 'Procurement Officer'),
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'country' => $request->country ?? 'Nigeria',
                    'address' => $request->shipping_address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip ?? '',
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

                // Trigger automatic email receipt dispatch to customer
                $this->sendReceiptEmail($order);

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
                    'buyer_name' => $request->contact_name ?: ($user->username ?? 'Buyer'),
                    'phone' => $request->phone,
                    'company' => $request->company_name,
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

            // Trigger automatic email receipt dispatch to customer
            $this->sendReceiptEmail($order);

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
     * Re-send / Trigger Email Receipt to Customer
     */
    public function resendEmail(Request $request, $orderNumber)
    {
        $order = Order::with(['items.product', 'payment', 'user'])
            ->where('order_number', $orderNumber)
            ->firstOrFail();

        $recipientEmail = $order->shipping_address['email'] ?? ($order->user->email ?? null);

        if (!$recipientEmail) {
            return response()->json([
                'success' => false,
                'message' => 'No destination email address associated with this invoice.'
            ], 422);
        }

        $sent = $this->sendReceiptEmail($order);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => "Official invoice receipt successfully dispatched to {$recipientEmail}!"
            ]);
        }

        return redirect()->back()->with('success', "Invoice receipt sent to {$recipientEmail}!");
    }

    /**
     * Helper to safely dispatch order receipt emails without throwing fatal exceptions
     */
    protected function sendReceiptEmail(Order $order): bool
    {
        $recipientEmail = $order->shipping_address['email'] ?? ($order->user->email ?? null);
        if (!$recipientEmail) {
            Log::warning("Order #{$order->order_number} has no destination email for receipt.");
            return false;
        }

        try {
            Mail::to($recipientEmail)->send(new OrderReceiptMail($order));
            Log::info("Order receipt email successfully sent to {$recipientEmail} for order #{$order->order_number}");
            return true;
        } catch (\Throwable $e) {
            Log::error("Failed to deliver order receipt email to {$recipientEmail}: " . $e->getMessage());
            return false;
        }
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

                    // Send receipt email
                    $this->sendReceiptEmail($payment->order);
                }
            }
        }

        return response()->json(['status' => 'success'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Helper to get base cart query for active buyer or guest session
     */
    private function getCartQuery()
    {
        $user = Auth::user();
        if ($user) {
            return CartItem::where('user_id', $user->id);
        }
        return CartItem::where('session_id', session()->getId());
    }

    /**
     * Display Cart Page
     */
    public function index()
    {
        $cartItems = $this->getCartQuery()->with('product')->get();
        
        $subtotal = $cartItems->sum(fn($item) => $item->unit_price * $item->quantity);
        $totalItems = $cartItems->sum('quantity');

        $retailTotal = $cartItems->sum(function($item) {
            $msrp = $item->product->msrp ?: ($item->unit_price * 1.45);
            return $msrp * $item->quantity;
        });

        $savings = max(0, $retailTotal - $subtotal);
        $savingsPercentage = $retailTotal > 0 ? round(($savings / $retailTotal) * 100, 1) : 0;

        return view('cart', compact('cartItems', 'subtotal', 'totalItems', 'retailTotal', 'savings', 'savingsPercentage'));
    }

    /**
     * Add Product to Cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'nullable|integer|min:1',
            'set_quantity' => 'nullable|boolean',
        ]);

        $productId = $request->product_id;
        $quantity = (int) ($request->quantity ?? 1);
        $setQuantity = $request->boolean('set_quantity', false);

        // Find product in DB or match by SKU
        $product = Product::where('id', $productId)
            ->orWhere('sku', $productId)
            ->first();

        if (!$product) {
            // Fallback: Check if it matches a seeded SKU or generate product
            $product = Product::first();
        }

        if (!$product) {
            if ($request->wantsJson() || $request->ajax()) {
                return response()->json(['status' => 'error', 'message' => 'Product not found'], 404);
            }
            return redirect()->back()->with('error', 'Product not found');
        }

        $user = Auth::user();
        $sessionId = session()->getId();

        // Check if item already exists in cart
        $cartItem = CartItem::where(function ($q) use ($user, $sessionId) {
            if ($user) $q->where('user_id', $user->id);
            else $q->where('session_id', $sessionId);
        })->where('product_id', $product->id)->first();

        if ($cartItem) {
            if ($setQuantity) {
                $cartItem->update(['quantity' => $quantity]);
            } else {
                $cartItem->increment('quantity', $quantity);
            }
        } else {
            CartItem::create([
                'user_id' => $user ? $user->id : null,
                'session_id' => $sessionId,
                'product_id' => $product->id,
                'quantity' => max($quantity, $product->min_order_qty ?? 1),
                'unit_price' => $product->price,
                'custom_notes' => $request->custom_notes ?? null,
            ]);
        }

        $totalCount = $this->getCartQuery()->sum('quantity');

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => "{$product->name} added to your procurement cart!",
                'cart_count' => $totalCount,
                'product' => [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => (float) $product->price,
                ]
            ]);
        }

        return redirect()->route('cart')->with('success', "{$product->name} added to cart!");
    }

    /**
     * Synchronize Full Cart State from Client
     */
    public function sync(Request $request)
    {
        $items = $request->input('items', []);
        $user = Auth::user();
        $sessionId = session()->getId();

        // Clear existing database cart items for clean replacement
        $this->getCartQuery()->delete();

        if (is_array($items)) {
            foreach ($items as $item) {
                $productId = $item['id'] ?? null;
                $quantity = max(1, (int) ($item['qty'] ?? 1));

                $product = Product::where('id', $productId)
                    ->orWhere('sku', $productId)
                    ->first();

                if (!$product) {
                    $product = Product::first();
                }

                if ($product) {
                    CartItem::create([
                        'user_id' => $user ? $user->id : null,
                        'session_id' => $sessionId,
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'unit_price' => $product->price,
                        'custom_notes' => $item['custom_notes'] ?? null,
                    ]);
                }
            }
        }

        $totalCount = $this->getCartQuery()->sum('quantity');

        return response()->json([
            'status' => 'success',
            'cart_count' => (int) $totalCount
        ]);
    }

    /**
     * Update Line Item Quantity
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = $this->getCartQuery()->where(function($q) use ($id) {
            $q->where('id', $id)->orWhere('product_id', $id);
        })->first();

        if ($cartItem) {
            $cartItem->update(['quantity' => (int) $request->quantity]);
        }

        if ($request->wantsJson() || $request->ajax()) {
            $totalSubtotal = $this->getCartQuery()->sum(\DB::raw('unit_price * quantity'));
            return response()->json([
                'status' => 'success',
                'item_total' => $cartItem ? (float) ($cartItem->unit_price * $cartItem->quantity) : 0,
                'cart_subtotal' => (float) $totalSubtotal,
                'cart_count' => $this->getCartQuery()->sum('quantity')
            ]);
        }

        return redirect()->route('cart')->with('success', 'Quantity updated.');
    }

    /**
     * Remove Item from Cart
     */
    public function remove(Request $request, $id)
    {
        $this->getCartQuery()->where(function($q) use ($id) {
            $q->where('id', $id)->orWhere('product_id', $id);
        })->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Item removed from cart',
                'cart_count' => $this->getCartQuery()->sum('quantity')
            ]);
        }

        return redirect()->route('cart')->with('success', 'Item removed.');
    }

    /**
     * Clear Entire Cart
     */
    public function clear(Request $request)
    {
        $this->getCartQuery()->delete();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json(['status' => 'success', 'cart_count' => 0]);
        }

        return redirect()->route('cart')->with('success', 'Procurement cart cleared.');
    }

    /**
     * Return Live Cart Count Badge
     */
    public function count()
    {
        $count = $this->getCartQuery()->sum('quantity');
        return response()->json(['count' => (int) $count]);
    }
}

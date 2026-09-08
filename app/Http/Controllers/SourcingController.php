<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\SourcingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SourcingController extends Controller
{
    /**
     * Sourcing Simulation API (Used on Landing Page & Simulator)
     */
    public function simulate(Request $request)
    {
        $prompt = trim($request->input('prompt', ''));
        $user = Auth::user();
        $sessionId = session()->getId();

        $products = Product::where('status', 'active')->get();
        $matched = [];
        $lowerPrompt = strtolower($prompt);

        $totalRetail = 0;
        $totalWholesale = 0;

        foreach ($products as $p) {
            $matchedThis = false;

            if ($p->sku && str_contains($lowerPrompt, strtolower($p->sku))) {
                $matchedThis = true;
            } else {
                $terms = explode(' ', strtolower($p->name . ' ' . $p->category));
                foreach ($terms as $t) {
                    if (strlen($t) > 3 && str_contains($lowerPrompt, $t)) {
                        $matchedThis = true;
                        break;
                    }
                }
            }

            if ($matchedThis) {
                $qty = 1;
                if (preg_match('/(\d+)\s*(?:x\s*)?' . preg_quote(explode(' ', $p->name)[0], '/') . '/i', $prompt, $m)) {
                    $qty = max(1, (int)$m[1]);
                } else {
                    $qty = max(1, $p->min_order_qty ?? 1);
                }

                $uPrice = (float) $p->price;
                $msrp = (float) ($p->msrp ?: ($uPrice * 1.45));
                $lineTotal = $uPrice * $qty;
                $retailLine = $msrp * $qty;

                $totalWholesale += $lineTotal;
                $totalRetail += $retailLine;

                $matched[] = [
                    'id' => $p->id,
                    'sku' => $p->sku,
                    'name' => $p->name,
                    'category' => $p->category,
                    'image' => $p->primary_image,
                    'qty' => $qty,
                    'unit_price' => $uPrice,
                    'msrp' => $msrp,
                    'line_total' => $lineTotal,
                    'lead_time' => $p->lead_time ?? '2-3 Days Dispatch',
                    'warranty' => $p->warranty ?? 'Commercial Quality Guarantee',
                    'confidence' => $p->confidence ?? '99% Match'
                ];
            }
        }

        // Fallback to top 3 products if empty
        if (empty($matched)) {
            $defaults = Product::where('status', 'active')->limit(3)->get();
            foreach ($defaults as $p) {
                $qty = max(1, $p->min_order_qty ?? 1);
                $uPrice = (float) $p->price;
                $msrp = (float) ($p->msrp ?: ($uPrice * 1.45));
                $lineTotal = $uPrice * $qty;

                $totalWholesale += $lineTotal;
                $totalRetail += ($msrp * $qty);

                $matched[] = [
                    'id' => $p->id,
                    'sku' => $p->sku,
                    'name' => $p->name,
                    'category' => $p->category,
                    'image' => $p->primary_image,
                    'qty' => $qty,
                    'unit_price' => $uPrice,
                    'msrp' => $msrp,
                    'line_total' => $lineTotal,
                    'lead_time' => $p->lead_time ?? '2-3 Days Dispatch',
                    'warranty' => $p->warranty ?? 'Commercial Quality Guarantee',
                    'confidence' => 'Verified Wholesale Match'
                ];
            }
        }

        $savings = max(0, $totalRetail - $totalWholesale);
        $suppliersCount = min(count($matched), 3);

        $sourcingRequest = SourcingRequest::create([
            'user_id' => $user ? $user->id : null,
            'session_id' => $sessionId,
            'prompt_text' => $prompt ?: 'Instant Sourcing Simulation',
            'parsed_items' => $matched,
            'total_estimated_retail' => $totalRetail,
            'total_wholesale_quote' => $totalWholesale,
            'savings_amount' => $savings,
            'matched_suppliers_count' => $suppliersCount,
            'status' => 'quoted'
        ]);

        return response()->json([
            'status' => 'success',
            'request_id' => $sourcingRequest->id,
            'items' => $matched,
            'retail_total' => $totalRetail,
            'wholesale_total' => $totalWholesale,
            'savings' => $savings,
            'matched_suppliers_count' => $suppliersCount,
            'message' => "Unified quote ready • {$suppliersCount} Verified Direct Suppliers matched."
        ]);
    }

    /**
     * Batch add all quoted items to cart in 1 click
     */
    public function convertToCart(Request $request)
    {
        $user = Auth::user();
        $sessionId = session()->getId();
        $items = $request->input('items', []);

        if (empty($items) && $request->input('request_id')) {
            $sourcing = SourcingRequest::find($request->input('request_id'));
            if ($sourcing && is_array($sourcing->parsed_items)) {
                $items = $sourcing->parsed_items;
            }
        }

        foreach ($items as $item) {
            $productId = $item['id'] ?? null;
            $qty = (int) ($item['qty'] ?? 1);

            $product = Product::find($productId);
            if ($product) {
                $cartItem = CartItem::where(function ($q) use ($user, $sessionId) {
                    if ($user) $q->where('user_id', $user->id);
                    else $q->where('session_id', $sessionId);
                })->where('product_id', $product->id)->first();

                if ($cartItem) {
                    $cartItem->increment('quantity', $qty);
                } else {
                    CartItem::create([
                        'user_id' => $user ? $user->id : null,
                        'session_id' => $sessionId,
                        'product_id' => $product->id,
                        'quantity' => $qty,
                        'unit_price' => $product->price,
                    ]);
                }
            }
        }

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'All matched items transferred to your single-invoice cart!',
                'redirect_url' => route('cart')
            ]);
        }

        return redirect()->route('cart')->with('success', 'Requisition quote added to your single-invoice cart!');
    }
}

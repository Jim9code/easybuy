<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\SupplierProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Get supplier application details from DB
     */
    private function getApplicationData()
    {
        $user = Auth::user();
        $profile = null;
        if ($user) {
            $profile = SupplierProfile::where('user_id', $user->id)->first();
        }

        $status = $profile ? $profile->verification_status : 'under_review';
        $isApproved = ($status === 'approved');

        return [
            'ref_no' => $profile ? $profile->ref_no : ('EB-SUP-' . ($user ? $user->id : '0000')),
            'company_name' => $profile ? $profile->company_name : ($user ? ($user->company_name ?: $user->username) : 'Direct Supplier'),
            'status' => $status,
            'business_type' => $profile ? $profile->business_type : 'Direct Manufacturer',
            'primary_category' => $profile ? $profile->primary_category : 'Commercial Wholesale',
            'tax_id' => $profile ? ($profile->tax_id_ein ?: 'Pending') : 'Pending',
            'submitted_at' => $profile ? $profile->created_at->format('M d, Y') : date('M d, Y'),
            'specialist' => 'EasyBuy Procurement Compliance Team',
            'lead_time' => ($profile ? $profile->lead_time_days : 2) . ' Business Days',
            'warehouse_address' => $profile ? ($profile->warehouse_address ?: 'Warehouse Facility') : 'Warehouse Facility',
            'steps' => [
                [
                    'number' => 1,
                    'title' => 'Application Submitted',
                    'desc' => 'Registration form & tax documentation received',
                    'date' => $profile ? $profile->created_at->format('M d, Y') : date('M d, Y'),
                    'status' => $profile ? 'completed' : 'in_progress'
                ],
                [
                    'number' => 2,
                    'title' => 'KYC & Tax Verification',
                    'desc' => 'EIN validation and direct supplier credential audit',
                    'date' => $profile ? $profile->created_at->addDays(2)->format('M d, Y') : 'Pending',
                    'status' => $isApproved ? 'completed' : ($status === 'under_review' ? 'in_progress' : 'pending')
                ],
                [
                    'number' => 3,
                    'title' => 'Factory Spec & Quality Audit',
                    'desc' => 'Factory batch compliance and blind packing slip verification',
                    'date' => $profile ? $profile->created_at->addDays(5)->format('M d, Y') : 'Pending',
                    'status' => $isApproved ? 'completed' : ($status === 'in_audit' ? 'in_progress' : 'pending')
                ],
                [
                    'number' => 4,
                    'title' => 'Wholesale Network Approval',
                    'desc' => 'Final sign-off, Net-15 escrow setup, and catalog activation',
                    'date' => $profile ? $profile->created_at->addDays(7)->format('M d, Y') : 'Pending',
                    'status' => $isApproved ? 'completed' : 'pending'
                ]
            ]
        ];
    }

    /**
     * Get supplier dashboard metrics, orders, inventory, and RFQs (Zero-Dummy State)
     */
    private function getSupplierDashboardData()
    {
        $user = Auth::user();
        $userId = $user ? $user->id : 0;
        $profile = null;
        if ($user) {
            $profile = SupplierProfile::where('user_id', $userId)->first();
        }

        // 1. Fetch real order items for this supplier only
        $dbOrderItems = OrderItem::with(['order.user', 'product'])
            ->where('supplier_id', $userId)
            ->latest()
            ->get();

        $orders = $dbOrderItems->map(function($item) {
            $statusKey = match($item->status) {
                'packed' => 'dock-pickup',
                'dispatched' => 'in-transit',
                'delivered' => 'settled',
                default => 'awaiting-packing'
            };
            $statusColor = match($item->status) {
                'delivered' => 'bg-emerald-100 text-emerald-900 border-emerald-300',
                'dispatched' => 'bg-purple-100 text-purple-900 border-purple-300',
                'packed' => 'bg-blue-100 text-blue-900 border-blue-300',
                default => 'bg-amber-100 text-amber-900 border-amber-300'
            };

            return [
                'id' => $item->order ? $item->order->order_number : ('PO-' . $item->id),
                'order_item_id' => $item->id,
                'raw_status' => $item->status,
                'tracking_number' => $item->tracking_number,
                'buyer' => $item->order && $item->order->user ? ($item->order->user->company_name ?: $item->order->user->username) : 'Commercial Buyer',
                'buyer_type' => 'Verified Wholesale Buyer',
                'item' => $item->product_name,
                'sku' => $item->product_sku,
                'qty' => $item->quantity,
                'unit_price' => (float) $item->unit_price,
                'total' => (float) $item->total_price,
                'ordered_at' => $item->created_at->diffForHumans(),
                'lead_days' => 2,
                'status' => ucwords(str_replace('_', ' ', $item->status)),
                'status_key' => $statusKey,
                'status_color' => $statusColor,
                'image' => $item->product ? $item->product->primary_image : asset('images/3d-refs/ergo_chair.jpg'),
                'blind_slip_ready' => true,
                'destination' => $item->order && $item->order->shipping_address ? (($item->order->shipping_address['city'] ?? 'Austin') . ', ' . ($item->order->shipping_address['state'] ?? 'TX')) : 'Consolidated Drop Facility'
            ];
        })->toArray();

        // 2. Real Live Inventory assigned to this supplier
        $dbProducts = Product::where('supplier_id', $userId)->latest()->get();
        $inventory = $dbProducts->map(function($p) {
            $unitPrice = (float) $p->price;
            $tier1 = (float) ($p->msrp ?: ($unitPrice * 1.45));
            $tier2 = $unitPrice;
            $tier3 = round($unitPrice * 0.90, 2);

            return [
                'id' => $p->id,
                'name' => $p->name,
                'sku' => $p->sku ?: 'EB-SKU-' . $p->id,
                'category' => $p->category,
                'description' => $p->description ?: '',
                'stock' => $p->stock,
                'allocated' => 0,
                'available' => $p->stock,
                'reorder_point' => 20,
                'unit_cost' => $unitPrice,
                'tier_1' => $tier1,
                'tier_2' => $tier2,
                'tier_3' => $tier3,
                'lead_time' => $p->lead_time ?: '2-3 Business Days',
                'warranty' => $p->warranty ?: 'Commercial Quality Guarantee',
                'min_order_qty' => $p->min_order_qty ?: 1,
                'status' => $p->stock > 20 ? 'Healthy' : 'Low Stock',
                'status_color' => $p->stock > 20 ? 'bg-emerald-100 text-emerald-800' : 'bg-amber-100 text-amber-800',
                'image' => $p->primary_image,
                'images' => $p->gallery_images
            ];
        })->toArray();

        // 3. Real Calculated Metrics
        $totalRevenue = (float) OrderItem::where('supplier_id', $userId)
            ->sum('total_price');

        $settledRevenue = (float) OrderItem::where('supplier_id', $userId)
            ->where('status', 'delivered')
            ->sum('total_price');

        $settledOrdersCount = OrderItem::where('supplier_id', $userId)
            ->where('status', 'delivered')
            ->count();

        $inFulfillmentValue = (float) OrderItem::where('supplier_id', $userId)
            ->whereIn('status', ['awaiting_packing', 'packed', 'dispatched'])
            ->sum('total_price');

        $inFulfillmentCount = OrderItem::where('supplier_id', $userId)
            ->whereIn('status', ['awaiting_packing', 'packed', 'dispatched'])
            ->count();

        // Calculate next payout amount from settled balance or profile
        $profilePayoutBalance = $profile ? (float) $profile->next_payout_amount : 0.00;
        $nextPayoutAmount = $settledRevenue > 0 ? $settledRevenue : $profilePayoutBalance;

        $metrics = [
            'total_revenue' => $totalRevenue,
            'settled_revenue' => $settledRevenue,
            'settled_orders_count' => $settledOrdersCount,
            'in_fulfillment_value' => $inFulfillmentValue,
            'in_fulfillment_count' => $inFulfillmentCount,
            'monthly_growth' => '+0.0%',
            'active_pos' => $inFulfillmentCount > 0 ? $inFulfillmentCount : count($orders),
            'in_transit_value' => $inFulfillmentValue,
            'open_rfqs' => 0,
            'on_time_rate' => 100.0,
            'tier_status' => $profile ? $profile->tier_level : 'Tier 1 Verified Manufacturer',
            'next_payout_amount' => $nextPayoutAmount,
            'next_payout_date' => $nextPayoutAmount > 0 ? 'Next Settlement Cycle (Net-15)' : 'No Pending Payouts',
            'payout_method' => $profile ? ($profile->payout_method ?: 'Bank Transfer (ACH / Paystack)') : 'Bank Transfer (ACH / Paystack)'
        ];

        // 4. Dynamic Payout History for Settled Orders
        $rfqs = [];
        $payoutHistory = [];
        if ($settledRevenue > 0) {
            $payoutHistory[] = [
                'ref' => 'REM-' . date('Ymd') . '-' . str_pad($userId, 4, '0', STR_PAD_LEFT),
                'period' => 'Current Billing Cycle (Net-15)',
                'orders_count' => $settledOrdersCount,
                'paid_on' => 'Settlement Ready (Auto-Scheduled)',
                'amount' => $settledRevenue,
            ];
        }

        return compact('metrics', 'orders', 'inventory', 'rfqs', 'payoutHistory');
    }

    /**
     * Display the Application Status page
     */
    public function status(Request $request)
    {
        $user = Auth::user();
        if (!$user || (!$user->isSupplier() && !$user->isAdmin())) {
            return redirect()->route('home')
                ->with('error', 'Access restricted: Application status is only accessible to verified supplier accounts.');
        }

        $application = $this->getApplicationData();
        
        if ($request->has('status')) {
            $application['status'] = $request->get('status');
        }

        return view('supplier-status', compact('application'));
    }

    /**
     * Display the Supplier Dashboard Workspace
     */
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        if (!$user || (!$user->isSupplier() && !$user->isAdmin())) {
            return redirect()->route('home')
                ->with('error', 'Access restricted: You are signed in with Buyer account (' . ($user ? $user->email : 'Guest') . '). The Supplier Dashboard is reserved for verified suppliers.');
        }

        $data = $this->getSupplierDashboardData();
        $application = $this->getApplicationData();
        $activeTab = $request->get('tab', 'overview');

        return view('supplier-dashboard', array_merge($data, [
            'application' => $application,
            'activeTab' => $activeTab
        ]));
    }

    /**
     * Update Line Item Fulfillment Status (e.g. dispatched, packed)
     */
    public function updateOrderStatus(Request $request, $orderItemId)
    {
        $user = Auth::user();
        if (!$user || (!$user->isSupplier() && !$user->isAdmin())) {
            if ($request->wantsJson()) {
                return response()->json(['status' => 'error', 'message' => 'Unauthorized: Supplier account required.'], 403);
            }
            return redirect()->route('home')->with('error', 'Unauthorized: Supplier account required.');
        }

        $request->validate([
            'status' => 'required|string|in:awaiting_packing,packed,dispatched,delivered',
            'tracking_number' => 'nullable|string',
        ]);

        $item = OrderItem::findOrFail($orderItemId);
        $item->update([
            'status' => $request->status,
            'tracking_number' => $request->tracking_number ?? $item->tracking_number,
        ]);

        if ($request->wantsJson()) {
            return response()->json(['status' => 'success', 'message' => 'PO Line item status updated!']);
        }

        return redirect()->back()->with('success', 'PO status updated.');
    }

    /**
     * Store new Supplier Application for Admin Review
     */
    public function apply(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'business_type' => 'required|string|max:255',
            'primary_category' => 'required|string|max:255',
            'tax_id_ein' => 'required|string|max:255',
            'lead_time_days' => 'nullable|integer|min:1|max:30',
            'warehouse_address' => 'required|string|max:500',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please sign in or create an account to submit your supplier credentials.'
            ], 401);
        }

        $refNo = 'EB-APP-' . date('Y') . '-' . rand(100, 999);

        $profile = SupplierProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'ref_no' => $refNo,
                'company_name' => $validated['company_name'],
                'business_type' => $validated['business_type'],
                'primary_category' => $validated['primary_category'],
                'tax_id_ein' => $validated['tax_id_ein'],
                'lead_time_days' => $validated['lead_time_days'] ?? 2,
                'warehouse_address' => $validated['warehouse_address'],
                'verification_status' => 'under_review',
                'tier_level' => 'Tier 1 Gold',
                'total_revenue' => 0.00,
                'next_payout_amount' => 0.00,
                'payout_method' => 'Chase Commercial ACH',
            ]
        );

        $user->update(['company_name' => $validated['company_name']]);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => "Application submitted for {$profile->company_name}! Our procurement compliance team will review your credentials within 24-48 hours.",
                'ref_no' => $profile->ref_no
            ]);
        }

        return redirect()->route('supplier.status')->with('success', 'Application submitted for review.');
    }
}

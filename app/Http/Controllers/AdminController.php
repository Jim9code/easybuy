<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\SupplierProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Ensure current user is an authenticated Admin
     */
    private function guardAdmin()
    {
        $user = Auth::user();
        if (!$user || !$user->isAdmin()) {
            abort(403, 'Unauthorized. EasyBuy Admin privileges required.');
        }
    }

    /**
     * Display the Admin Central Operations Panel
     */
    public function dashboard(Request $request)
    {
        $user = Auth::user();
        if (!$user || !$user->isAdmin()) {
            return redirect()->route('home')
                ->with('error', 'Access restricted: EasyBuy Admin panel requires super-administrator credentials.');
        }

        $activeTab = $request->get('tab', 'overview');

        // 1. Core Metrics (Calculated live from real database records)
        $totalVolume = (float) Order::where('payment_status', '!=', 'failed')->sum('total_amount');
        $activeEscrow = (float) Order::where('payment_status', 'paid')->sum('total_amount');

        $metrics = [
            'total_volume' => $totalVolume,
            'total_orders' => Order::count(),
            'pending_applications' => SupplierProfile::whereIn('verification_status', ['under_review', 'in_audit'])->count(),
            'verified_suppliers' => SupplierProfile::where('verification_status', 'approved')->count(),
            'total_buyers' => User::where('role', 'buyer')->count(),
            'total_users' => User::count(),
            'total_products' => Product::count(),
            'active_escrow' => $activeEscrow,
        ];

        // 2. Pending & All Supplier Applications
        $pendingApplications = SupplierProfile::with('user')
            ->whereIn('verification_status', ['under_review', 'in_audit'])
            ->latest()
            ->get();

        $allApplications = SupplierProfile::with(['user', 'products'])
            ->latest()
            ->get();

        // 3. Verified Suppliers
        $verifiedSuppliers = SupplierProfile::with(['user', 'products'])
            ->where('verification_status', 'approved')
            ->latest()
            ->get();

        // 4. Platform Orders (Consolidated Single Invoices)
        $orders = Order::with(['user', 'items.product', 'items.supplier'])
            ->latest()
            ->get();

        // 5. Wholesale Catalog SKUs
        $products = Product::with('supplier')
            ->latest()
            ->get();

        // 6. User Management
        $users = User::with('supplierProfile')
            ->latest()
            ->get();

        return view('admin-dashboard', compact(
            'metrics',
            'pendingApplications',
            'allApplications',
            'verifiedSuppliers',
            'orders',
            'products',
            'users',
            'activeTab'
        ));
    }

    /**
     * Approve a Supplier Application
     */
    public function approveApplication(Request $request, $id)
    {
        $this->guardAdmin();

        $profile = SupplierProfile::with('user')->findOrFail($id);
        $tier = $request->input('tier_level', 'Tier 1 Verified Manufacturer');

        $profile->update([
            'verification_status' => 'approved',
            'tier_level' => $tier,
        ]);

        if ($profile->user) {
            $profile->user->update([
                'role' => 'supplier',
                'company_name' => $profile->company_name,
            ]);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => "Approved {$profile->company_name} as a Verified Supplier ({$tier})!",
                'profile' => $profile
            ]);
        }

        return redirect()->back()->with('success', "Approved {$profile->company_name} as a Verified Supplier!");
    }

    /**
     * Reject a Supplier Application
     */
    public function rejectApplication(Request $request, $id)
    {
        $this->guardAdmin();

        $profile = SupplierProfile::findOrFail($id);
        $profile->update([
            'verification_status' => 'rejected'
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => "Application for {$profile->company_name} marked as Rejected.",
                'profile' => $profile
            ]);
        }

        return redirect()->back()->with('info', "Application for {$profile->company_name} rejected.");
    }

    /**
     * Update Supplier Tier Level
     */
    public function updateSupplierTier(Request $request, $id)
    {
        $this->guardAdmin();

        $request->validate([
            'tier_level' => 'required|string|max:100',
        ]);

        $profile = SupplierProfile::findOrFail($id);
        $profile->update([
            'tier_level' => $request->tier_level
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => "Tier updated to {$request->tier_level} for {$profile->company_name}."
            ]);
        }

        return redirect()->back()->with('success', "Tier updated for {$profile->company_name}.");
    }

    /**
     * Update User Role (e.g. buyer, supplier, admin)
     */
    public function updateUserRole(Request $request, $id)
    {
        $this->guardAdmin();

        $request->validate([
            'role' => 'required|string|in:buyer,supplier,admin',
        ]);

        $targetUser = User::findOrFail($id);
        $targetUser->update([
            'role' => $request->role
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => "Role for user {$targetUser->email} changed to {$request->role}."
            ]);
        }

        return redirect()->back()->with('success', "Role for {$targetUser->email} changed to {$request->role}.");
    }

    /**
     * Remove or delist a product from the platform
     */
    public function destroyProduct(Request $request, $id)
    {
        $this->guardAdmin();

        $product = Product::findOrFail($id);
        $name = $product->name;
        $product->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => "Product '{$name}' has been delisted from the platform catalog."
            ]);
        }

        return redirect()->back()->with('success', "Product '{$name}' deleted.");
    }
}

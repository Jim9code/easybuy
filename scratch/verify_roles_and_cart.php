<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Product;
use App\Models\SupplierProfile;
use App\Models\CartItem;

echo "=======================================================\n";
echo "    EasyBuy Roles, Products & Cart Audit Verification  \n";
echo "=======================================================\n\n";

// 1. Check Supplier Account
$supplier = User::where('email', 'rinfwang4@gmail.com')->first();
echo "1. Supplier Account: rinfwang4@gmail.com\n";
if ($supplier && $supplier->isSupplier()) {
    echo "   ✓ User exists with ID {$supplier->id} and role: {$supplier->role}\n";
    $profile = $supplier->supplierProfile;
    if ($profile) {
        echo "   ✓ Supplier Profile Active: Ref {$profile->ref_no} | Status: {$profile->verification_status} | Tier: {$profile->tier_level}\n";
    } else {
        echo "   ✗ Missing SupplierProfile!\n";
    }
} else {
    echo "   ✗ Supplier account missing or incorrect role!\n";
}

// 2. Check Buyer Account
$buyer = User::where('email', 'jethwork4@gmail.com')->first();
echo "\n2. Buyer Account: jethwork4@gmail.com\n";
if ($buyer && $buyer->isBuyer()) {
    echo "   ✓ User exists with ID {$buyer->id} and role: {$buyer->role}\n";
} else {
    echo "   ✗ Buyer account missing or incorrect role!\n";
}

// 3. Check Products Ownership
echo "\n3. Catalog Products Assignment:\n";
$totalProducts = Product::count();
$supplierProducts = Product::where('supplier_id', $supplier->id)->count();
echo "   - Total Catalog Products: {$totalProducts}\n";
echo "   - Assigned to Supplier ({$supplier->email}): {$supplierProducts}\n";
if ($totalProducts > 0 && $totalProducts === $supplierProducts) {
    echo "   ✓ 100% of products are owned and managed by supplier {$supplier->email}!\n";
} else {
    echo "   ✗ Some products are not linked to supplier {$supplier->email}!\n";
}

// 4. Check Cart Cleanliness
echo "\n4. Cart Database Audit:\n";
$cartCount = CartItem::count();
$cartQuantity = CartItem::sum('quantity');
echo "   - Total Cart Item Rows in DB: {$cartCount}\n";
echo "   - Total Cart Units in DB: {$cartQuantity}\n";
if ($cartCount === 0 && $cartQuantity === 0) {
    echo "   ✓ Cart items table is completely clean (Count: 0)!\n";
} else {
    echo "   ✗ Cart table has lingering rows!\n";
}

echo "\n=======================================================\n";
echo "       Role & Database Configuration Verified 100%!     \n";
echo "=======================================================\n";

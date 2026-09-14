<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\SupplierProfile;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create or update verified Demo Supplier User
        $supplierUser = User::updateOrCreate(
            ['email' => 'supplier@easybuy.com'],
            [
                'username' => 'apex_manufacturing',
                'password' => Hash::make('password123'),
                'role' => 'supplier',
                'company_name' => 'Apex Industrial Manufacturing Ltd.',
                'phone' => '+1 (312) 555-0198',
                'avatar_url' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=120&auto=format&fit=crop&q=80'
            ]
        );

        // 2. Create or update Supplier Profile
        $profile = SupplierProfile::updateOrCreate(
            ['user_id' => $supplierUser->id],
            [
                'ref_no' => 'EB-SUP-8921',
                'company_name' => 'Apex Industrial Manufacturing Ltd.',
                'business_type' => 'Direct Manufacturer',
                'primary_category' => 'Ergonomics & Workstations',
                'tax_id_ein' => 'US-EIN-94-382910',
                'lead_time_days' => 2,
                'warehouse_address' => 'Warehouse Dock Bay 4, 102 Logistics Blvd, Chicago, IL',
                'verification_status' => 'approved',
                'tier_level' => 'Tier 1 Gold',
                'total_revenue' => 148250.00,
                'next_payout_amount' => 42800.00,
                'payout_method' => 'Chase Commercial ACH (•••• 4892)'
            ]
        );

        // Link existing ergonomics products to this supplier
        Product::whereIn('category', ['Ergonomics', 'Facilities'])->update(['supplier_id' => $supplierUser->id]);

        // 3. Create demo Buyer User
        $buyerUser = User::updateOrCreate(
            ['email' => 'buyer@cloudflow.io'],
            [
                'username' => 'marcus_buyer',
                'password' => Hash::make('password123'),
                'role' => 'buyer',
                'company_name' => 'CloudFlow Inc. (Series B)',
                'phone' => '+1 (415) 555-0142',
            ]
        );

        // 4. Create Demo Orders and Line Items for Supplier Dashboard
        $demoOrder1 = Order::updateOrCreate(
            ['order_number' => 'PO-8821'],
            [
                'user_id' => $buyerUser->id,
                'subtotal' => 5600.00,
                'tax_amount' => 0.00,
                'shipping_amount' => 0.00,
                'total_amount' => 5600.00,
                'payment_status' => 'paid',
                'fulfillment_status' => 'packing',
                'single_invoice_ref' => 'EB-INV-2026-8821',
                'shipping_address' => [
                    'company' => 'CloudFlow Inc.',
                    'contact' => 'Marcus Vance',
                    'address' => '500 Tech Hub Way, Suite 400',
                    'city' => 'Austin',
                    'state' => 'TX',
                    'zip' => '78701'
                ]
            ]
        );

        $chair = Product::where('sku', 'EB-ERG-904')->first();

        OrderItem::updateOrCreate(
            ['order_id' => $demoOrder1->id, 'product_sku' => 'EB-ERG-904'],
            [
                'product_id' => $chair ? $chair->id : null,
                'supplier_id' => $supplierUser->id,
                'product_name' => 'Ergonomic Lumbar Mesh Task Chair',
                'unit_price' => 140.00,
                'quantity' => 40,
                'total_price' => 5600.00,
                'status' => 'awaiting_packing',
                'tracking_number' => null
            ]
        );

        $demoOrder2 = Order::updateOrCreate(
            ['order_number' => 'PO-8819'],
            [
                'user_id' => $buyerUser->id,
                'subtotal' => 5500.00,
                'tax_amount' => 0.00,
                'shipping_amount' => 0.00,
                'total_amount' => 5500.00,
                'payment_status' => 'paid',
                'fulfillment_status' => 'dispatched',
                'single_invoice_ref' => 'EB-INV-2026-8819',
                'shipping_address' => [
                    'company' => 'Apex Logistics Group',
                    'contact' => 'Sarah Jenkins',
                    'address' => '880 Harbor Blvd, Dock 12',
                    'city' => 'Seattle',
                    'state' => 'WA',
                    'zip' => '98101'
                ]
            ]
        );

        $display = Product::where('sku', 'EB-DISP-4K')->first();

        OrderItem::updateOrCreate(
            ['order_id' => $demoOrder2->id, 'product_sku' => 'EB-DISP-4K'],
            [
                'product_id' => $display ? $display->id : null,
                'supplier_id' => $supplierUser->id,
                'product_name' => '27-inch 4K UHD IPS USB-C Business Display',
                'unit_price' => 220.00,
                'quantity' => 25,
                'total_price' => 5500.00,
                'status' => 'dispatched',
                'tracking_number' => 'FX-98214-US'
            ]
        );

        // 5. Create or update Admin User
        User::updateOrCreate(
            ['email' => 'codecraft4th@gmail.com'],
            [
                'username' => 'CodecraftAdmin',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'company_name' => 'EasyBuy HQ Admin Operations',
                'phone' => '+1 (800) 555-0199',
            ]
        );
    }
}

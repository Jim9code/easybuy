<?php

namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\SupplierProfile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Configure Supplier Account: rinfwang4@gmail.com
        $supplier = User::where('email', 'rinfwang4@gmail.com')->first();
        if ($supplier) {
            $supplier->update([
                'role' => 'supplier',
                'company_name' => 'Apex Industrial Manufacturing Ltd.',
            ]);
        } else {
            $supplier = User::create([
                'username' => 'rinfwang',
                'email' => 'rinfwang4@gmail.com',
                'password' => 'password123',
                'role' => 'supplier',
                'company_name' => 'Apex Industrial Manufacturing Ltd.',
            ]);
        }

        // Create or update Supplier Profile for rinfwang4@gmail.com (clean zero stats)
        SupplierProfile::updateOrCreate(
            ['user_id' => $supplier->id],
            [
                'ref_no' => 'EB-SUP-2026-08',
                'company_name' => 'Apex Industrial Manufacturing Ltd.',
                'business_type' => 'Direct Factory Manufacturer',
                'primary_category' => 'Ergonomics, IT & Commercial Facilities',
                'tax_id_ein' => 'US-EIN-94-829104',
                'lead_time_days' => 2,
                'warehouse_address' => 'Bay 4, 102 Logistics Blvd, Chicago, IL',
                'verification_status' => 'approved',
                'tier_level' => 'Tier 1 Verified Manufacturer',
                'total_revenue' => 0.00,
                'next_payout_amount' => 0.00,
                'payout_method' => 'Direct Bank Wire (ACH / Paystack Merchant)',
            ]
        );

        // 2. Configure Buyer Account: jethwork4@gmail.com
        $buyer = User::where('email', 'jethwork4@gmail.com')->first();
        if ($buyer) {
            $buyer->update([
                'role' => 'buyer',
                'company_name' => 'Jethwork Procurement Corp',
            ]);
        } else {
            $buyer = User::create([
                'username' => 'jethwork',
                'email' => 'jethwork4@gmail.com',
                'password' => 'password123',
                'role' => 'buyer',
                'company_name' => 'Jethwork Procurement Corp',
            ]);
        }

        // 3. Configure Admin Account: codecraft4th@gmail.com
        $admin = User::where('email', 'codecraft4th@gmail.com')->first();
        if ($admin) {
            $admin->update([
                'role' => 'admin',
                'username' => 'CodecraftAdmin',
                'company_name' => 'EasyBuy HQ Admin Operations',
            ]);
        } else {
            $admin = User::create([
                'username' => 'CodecraftAdmin',
                'email' => 'codecraft4th@gmail.com',
                'password' => 'password123',
                'role' => 'admin',
                'company_name' => 'EasyBuy HQ Admin Operations',
            ]);
        }

        // 4. Remove all dummy test users and their supplier profiles
        $keepEmails = ['rinfwang4@gmail.com', 'jethwork4@gmail.com', 'codecraft4th@gmail.com'];
        $dummyUsers = User::whereNotIn('email', $keepEmails)->get();
        foreach ($dummyUsers as $du) {
            SupplierProfile::where('user_id', $du->id)->delete();
            $du->delete();
        }

        // Delete any extra dummy supplier profiles not belonging to our verified supplier
        SupplierProfile::where('user_id', '!=', $supplier->id)->delete();

        // 5. Assign all catalog products to real supplier (rinfwang4@gmail.com)
        Product::query()->update([
            'supplier_id' => $supplier->id
        ]);

        // 6. Purge all dummy orders, order items, payments, and cart items
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('order_items')->truncate();
        DB::table('orders')->truncate();
        DB::table('payments')->truncate();
        CartItem::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        echo "UserRoleSetupSeeder completed (Clean Zero-Dummy State):\n";
        echo "- Admin: {$admin->email} (ID: {$admin->id}, Role: {$admin->role})\n";
        echo "- Supplier: {$supplier->email} (ID: {$supplier->id}, Role: {$supplier->role})\n";
        echo "- Buyer: {$buyer->email} (ID: {$buyer->id}, Role: {$buyer->role})\n";
        echo "- All dummy users, applications, and fake orders purged.\n";
        echo "- All " . Product::count() . " products assigned to Supplier ID {$supplier->id}\n";
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('supplier_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->string('ref_no')->unique(); // e.g. EB-SUP-8921
            $table->string('company_name');
            $table->string('business_type')->default('Direct Manufacturer');
            $table->string('primary_category');
            $table->string('tax_id_ein')->nullable();
            $table->integer('lead_time_days')->default(2);
            $table->text('warehouse_address')->nullable();
            $table->string('verification_status')->default('under_review'); // 'under_review', 'in_audit', 'approved', 'rejected'
            $table->string('tier_level')->default('Tier 1 Gold'); // 'Tier 1 Gold', 'Tier 2 Silver', 'Standard'
            $table->decimal('total_revenue', 12, 2)->default(0.00);
            $table->decimal('next_payout_amount', 10, 2)->default(0.00);
            $table->string('payout_method')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supplier_profiles');
    }
};

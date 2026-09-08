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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('sku')->unique()->nullable();
            $table->string('name');
            $table->string('category');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('msrp', 10, 2)->nullable();
            $table->string('image_url')->nullable();
            $table->json('images')->nullable();
            $table->integer('stock')->default(50);
            $table->integer('min_order_qty')->default(1);
            $table->string('lead_time')->nullable()->default('2-3 Days Dispatch');
            $table->string('warranty')->nullable()->default('Commercial Quality Guarantee');
            $table->string('confidence')->nullable()->default('Verified Wholesale Match');
            $table->json('specs')->nullable();
            $table->foreignId('supplier_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('active'); // 'active', 'draft', 'archived'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('reference')->unique(); // e.g. EB-PAY-66DE1234ABC
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('NGN');
            $table->string('payment_method')->default('paystack');
            $table->string('channel')->nullable(); // 'card', 'bank', 'ussd', 'bank_transfer', etc.
            $table->string('status')->default('pending'); // 'pending', 'success', 'failed'
            $table->json('gateway_response')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

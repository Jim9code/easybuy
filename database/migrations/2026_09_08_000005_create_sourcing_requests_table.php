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
        Schema::create('sourcing_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('ai_conversation_id')->nullable()->constrained('ai_conversations')->nullOnDelete();
            $table->string('session_id')->nullable()->index();
            $table->text('prompt_text');
            $table->json('parsed_items')->nullable();
            $table->decimal('total_estimated_retail', 10, 2)->default(0.00);
            $table->decimal('total_wholesale_quote', 10, 2)->default(0.00);
            $table->decimal('savings_amount', 10, 2)->default(0.00);
            $table->integer('matched_suppliers_count')->default(0);
            $table->string('status')->default('quoted'); // 'draft', 'quoted', 'converted_to_order', 'cancelled'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sourcing_requests');
    }
};

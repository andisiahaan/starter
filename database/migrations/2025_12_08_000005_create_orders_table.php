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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('payment_method_id')->nullable()->constrained()->nullOnDelete();

            // Snapshot data (untuk audit)
            $table->string('product_name');
            $table->decimal('product_price', 14, 2);
            $table->decimal('credit_amount', 14, 2);
            $table->string('payment_method_code')->nullable();

            // Pricing
            $table->decimal('subtotal', 14, 2);
            $table->decimal('fee_amount', 14, 2)->default(0);
            $table->decimal('total_amount', 14, 2);

            // Status & Timing
            $table->string('status')->default('pending');
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('credit_given_at')->nullable();
            $table->timestamp('expires_at')->nullable();

            // Payment Gateway Data
            $table->string('gateway_reference')->nullable();
            $table->json('gateway_data')->nullable();

            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

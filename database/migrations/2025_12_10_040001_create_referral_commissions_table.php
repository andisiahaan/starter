<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('referral_commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Referrer (who gets the commission)
            $table->foreignId('referred_user_id')->constrained('users')->onDelete('cascade'); // Referred user
            $table->decimal('amount', 15, 2);
            $table->enum('type', ['fixed', 'percent', 'both'])->default('both');
            $table->nullableMorphs('commissionable'); // Polymorphic relation to Order or other
            $table->enum('status', ['pending', 'available', 'withdrawn', 'expired', 'canceled'])->default('pending');
            $table->timestamp('available_at')->nullable(); // When commission becomes available
            $table->timestamp('expired_at')->nullable(); // When commission expires
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('referral_commissions');
    }
};

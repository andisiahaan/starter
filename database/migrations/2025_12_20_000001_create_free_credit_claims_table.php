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
        Schema::create('free_credit_claims', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->decimal('amount', 14, 2);
            $table->string('period'); // Format: "2025-12" (YYYY-MM)
            $table->foreignId('credit_log_id')->nullable()->constrained('credit_logs')->nullOnDelete();
            $table->timestamps();

            $table->unique(['user_id', 'period']); // Satu claim per user per periode
            $table->index('period');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('free_credit_claims');
    }
};

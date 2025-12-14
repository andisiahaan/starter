<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Add indexes for frequently queried columns to improve performance.
     */
    public function up(): void
    {
        // Helper to check if index exists
        $indexExists = function (string $table, string $indexName): bool {
            $database = config('database.connections.mysql.database');
            $result = DB::select("
                SELECT COUNT(*) as count 
                FROM information_schema.statistics 
                WHERE table_schema = ? 
                AND table_name = ? 
                AND index_name = ?
            ", [$database, $table, $indexName]);
            return $result[0]->count > 0;
        };

        // Orders table indexes
        Schema::table('orders', function (Blueprint $table) use ($indexExists) {
            if (!$indexExists('orders', 'orders_status_index')) {
                $table->index('status');
            }
            if (!$indexExists('orders', 'orders_user_id_index')) {
                $table->index('user_id');
            }
            if (!$indexExists('orders', 'orders_status_created_at_index')) {
                $table->index(['status', 'created_at']);
            }
            if (!$indexExists('orders', 'orders_expires_at_index')) {
                $table->index('expires_at');
            }
        });

        // Credit logs table indexes
        Schema::table('credit_logs', function (Blueprint $table) use ($indexExists) {
            if (!$indexExists('credit_logs', 'credit_logs_user_id_index')) {
                $table->index('user_id');
            }
            if (!$indexExists('credit_logs', 'credit_logs_type_index')) {
                $table->index('type');
            }
            if (!$indexExists('credit_logs', 'credit_logs_user_id_type_index')) {
                $table->index(['user_id', 'type']);
            }
        });

        // Referral commissions table indexes
        Schema::table('referral_commissions', function (Blueprint $table) use ($indexExists) {
            if (!$indexExists('referral_commissions', 'referral_commissions_status_index')) {
                $table->index('status');
            }
            if (!$indexExists('referral_commissions', 'referral_commissions_user_id_index')) {
                $table->index('user_id');
            }
            if (!$indexExists('referral_commissions', 'referral_commissions_available_at_index')) {
                $table->index('available_at');
            }
            if (!$indexExists('referral_commissions', 'referral_commissions_status_available_at_index')) {
                $table->index(['status', 'available_at']);
            }
        });

        // Tickets table indexes
        Schema::table('tickets', function (Blueprint $table) use ($indexExists) {
            if (!$indexExists('tickets', 'tickets_status_index')) {
                $table->index('status');
            }
            if (!$indexExists('tickets', 'tickets_user_id_index')) {
                $table->index('user_id');
            }
        });

        // Withdrawals table indexes
        Schema::table('withdrawals', function (Blueprint $table) use ($indexExists) {
            if (!$indexExists('withdrawals', 'withdrawals_status_index')) {
                $table->index('status');
            }
            if (!$indexExists('withdrawals', 'withdrawals_user_id_index')) {
                $table->index('user_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $indexExists = function (string $table, string $indexName): bool {
            $database = config('database.connections.mysql.database');
            $result = DB::select("
                SELECT COUNT(*) as count 
                FROM information_schema.statistics 
                WHERE table_schema = ? 
                AND table_name = ? 
                AND index_name = ?
            ", [$database, $table, $indexName]);
            return $result[0]->count > 0;
        };

        Schema::table('orders', function (Blueprint $table) use ($indexExists) {
            if ($indexExists('orders', 'orders_status_index')) {
                $table->dropIndex(['status']);
            }
            if ($indexExists('orders', 'orders_user_id_index')) {
                $table->dropIndex(['user_id']);
            }
            if ($indexExists('orders', 'orders_status_created_at_index')) {
                $table->dropIndex(['status', 'created_at']);
            }
            if ($indexExists('orders', 'orders_expires_at_index')) {
                $table->dropIndex(['expires_at']);
            }
        });

        Schema::table('credit_logs', function (Blueprint $table) use ($indexExists) {
            if ($indexExists('credit_logs', 'credit_logs_user_id_index')) {
                $table->dropIndex(['user_id']);
            }
            if ($indexExists('credit_logs', 'credit_logs_type_index')) {
                $table->dropIndex(['type']);
            }
            if ($indexExists('credit_logs', 'credit_logs_user_id_type_index')) {
                $table->dropIndex(['user_id', 'type']);
            }
        });

        Schema::table('referral_commissions', function (Blueprint $table) use ($indexExists) {
            if ($indexExists('referral_commissions', 'referral_commissions_status_index')) {
                $table->dropIndex(['status']);
            }
            if ($indexExists('referral_commissions', 'referral_commissions_user_id_index')) {
                $table->dropIndex(['user_id']);
            }
            if ($indexExists('referral_commissions', 'referral_commissions_available_at_index')) {
                $table->dropIndex(['available_at']);
            }
            if ($indexExists('referral_commissions', 'referral_commissions_status_available_at_index')) {
                $table->dropIndex(['status', 'available_at']);
            }
        });

        Schema::table('tickets', function (Blueprint $table) use ($indexExists) {
            if ($indexExists('tickets', 'tickets_status_index')) {
                $table->dropIndex(['status']);
            }
            if ($indexExists('tickets', 'tickets_user_id_index')) {
                $table->dropIndex(['user_id']);
            }
        });

        Schema::table('withdrawals', function (Blueprint $table) use ($indexExists) {
            if ($indexExists('withdrawals', 'withdrawals_status_index')) {
                $table->dropIndex(['status']);
            }
            if ($indexExists('withdrawals', 'withdrawals_user_id_index')) {
                $table->dropIndex(['user_id']);
            }
        });
    }
};

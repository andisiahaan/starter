<?php

namespace App\Services;

use App\Models\Order;
use App\Models\ReferralCommission;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ReferralService
{
    /**
     * Check if referral system is enabled.
     */
    public function isEnabled(): bool
    {
        return (bool) setting('referral.is_enabled', false);
    }

    /**
     * Get referral settings with caching.
     */
    public function getSettings(): array
    {
        return [
            'is_enabled' => (bool) setting('referral.is_enabled', false),
            'referral_cookie_days' => (int) setting('referral.referral_cookie_days', 60),
            'referral_expiry_days' => (int) setting('referral.referral_expiry_days', 30),
            'commission_fixed' => (float) setting('referral.commission_fixed', 1000),
            'commission_percent' => (float) setting('referral.commission_percent', 20),
        ];
    }

    /**
     * Calculate commission for an order.
     */
    public function calculateCommission(Order $order): array
    {
        $settings = $this->getSettings();
        
        $fixedAmount = $settings['commission_fixed'];
        $percentAmount = ($settings['commission_percent'] / 100) * (float) $order->total_amount;
        
        $totalAmount = $fixedAmount + $percentAmount;

        return [
            'fixed' => $fixedAmount,
            'percent' => $percentAmount,
            'total' => $totalAmount,
            'type' => 'both',
        ];
    }

    /**
     * Create referral commission for an order.
     * Called when order status changes to verified.
     */
    public function createCommissionForOrder(Order $order): ?ReferralCommission
    {
        if (!$this->isEnabled()) {
            Log::info('[ReferralService] Referral system is disabled');
            return null;
        }

        $user = $order->user;
        if (!$user) {
            Log::warning('[ReferralService] Order has no user', ['order_id' => $order->id]);
            return null;
        }

        // Check if user has a referrer
        if (!$user->referrer_id) {
            Log::info('[ReferralService] User has no referrer', ['user_id' => $user->id]);
            return null;
        }

        $referrer = $user->referrer;
        if (!$referrer) {
            Log::warning('[ReferralService] Referrer not found', ['referrer_id' => $user->referrer_id]);
            return null;
        }

        // Check if commission already exists for this order (idempotency)
        $existingCommission = ReferralCommission::where('commissionable_type', Order::class)
            ->where('commissionable_id', $order->id)
            ->first();

        if ($existingCommission) {
            Log::info('[ReferralService] Commission already exists for order', [
                'order_id' => $order->id,
                'commission_id' => $existingCommission->id,
            ]);
            return $existingCommission;
        }

        // Calculate commission
        $commission = $this->calculateCommission($order);
        $settings = $this->getSettings();

        // Determine when commission becomes available
        $availableAt = now()->addDays($settings['referral_expiry_days']);

        try {
            $referralCommission = ReferralCommission::create([
                'user_id' => $referrer->id,
                'referred_user_id' => $user->id,
                'amount' => $commission['total'],
                'type' => $commission['type'],
                'commissionable_type' => Order::class,
                'commissionable_id' => $order->id,
                'status' => ReferralCommission::STATUS_PENDING,
                'available_at' => $availableAt,
                'expired_at' => null, // Will be set by expiry job if needed
            ]);

            Log::info('[ReferralService] Commission created', [
                'commission_id' => $referralCommission->id,
                'referrer_id' => $referrer->id,
                'referred_user_id' => $user->id,
                'order_id' => $order->id,
                'amount' => $commission['total'],
            ]);

            return $referralCommission;
        } catch (\Exception $e) {
            Log::error('[ReferralService] Failed to create commission', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);
            return null;
        }
    }

    /**
     * Process pending commissions and make them available.
     * Should be run via scheduled job.
     */
    public function processAvailableCommissions(): int
    {
        $count = ReferralCommission::shouldBeAvailable()
            ->update(['status' => ReferralCommission::STATUS_AVAILABLE]);

        if ($count > 0) {
            Log::info('[ReferralService] Marked commissions as available', ['count' => $count]);
        }

        return $count;
    }

    /**
     * Process expired commissions.
     * Should be run via scheduled job.
     */
    public function processExpiredCommissions(): int
    {
        $count = ReferralCommission::shouldExpire()
            ->update(['status' => ReferralCommission::STATUS_EXPIRED]);

        if ($count > 0) {
            Log::info('[ReferralService] Marked commissions as expired', ['count' => $count]);
        }

        return $count;
    }

    /**
     * Get user by referral code.
     */
    public function getUserByReferralCode(string $code): ?User
    {
        return User::where('referral_code', $code)->first();
    }

    /**
     * Mark commissions as withdrawn for a withdrawal.
     */
    public function markCommissionsAsWithdrawn(User $user, float $amount): int
    {
        return DB::transaction(function () use ($user, $amount) {
            $remaining = $amount;
            $count = 0;

            $commissions = $user->referralCommissions()
                ->available()
                ->orderBy('created_at')
                ->get();

            foreach ($commissions as $commission) {
                if ($remaining <= 0) {
                    break;
                }

                $commission->markAsWithdrawn();
                $remaining -= (float) $commission->amount;
                $count++;
            }

            return $count;
        });
    }
}

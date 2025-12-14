<?php

namespace App\Observers;

use App\Enums\ReferralBalanceLogType;
use App\Models\ReferralCommission;
use Illuminate\Support\Facades\Log;

/**
 * Observer for ReferralCommission model events.
 * Handles adding to referral_balance when commission becomes available.
 */
class ReferralCommissionObserver
{
    /**
     * Handle the ReferralCommission "updated" event.
     */
    public function updated(ReferralCommission $commission): void
    {
        // Check if status changed to 'available'
        if ($commission->isDirty('status') && $commission->status === ReferralCommission::STATUS_AVAILABLE) {
            $this->handleCommissionAvailable($commission);
        }
    }

    /**
     * Handle commission becoming available.
     * Add amount to user's referral_balance.
     */
    protected function handleCommissionAvailable(ReferralCommission $commission): void
    {
        $user = $commission->user;

        if (!$user) {
            Log::warning('[ReferralCommissionObserver] Commission has no user', [
                'commission_id' => $commission->id,
            ]);
            return;
        }

        try {
            $user->addReferralBalance(
                amount: (float) $commission->amount,
                type: ReferralBalanceLogType::COMMISSION_AVAILABLE,
                description: __('referral.balance_log.commission_available', [
                    'order' => $commission->commissionable?->order_number ?? $commission->commissionable_id,
                ]),
                reference: $commission
            );

            Log::info('[ReferralCommissionObserver] Added commission to referral balance', [
                'commission_id' => $commission->id,
                'user_id' => $user->id,
                'amount' => $commission->amount,
                'new_balance' => $user->referral_balance,
            ]);
        } catch (\Throwable $e) {
            Log::error('[ReferralCommissionObserver] Failed to add commission to balance', [
                'commission_id' => $commission->id,
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);
        }
    }
}

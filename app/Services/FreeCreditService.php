<?php

namespace App\Services;

use App\Enums\CreditLogType;
use App\Models\FreeCreditClaim;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FreeCreditService
{
    protected array $settings;

    public function __construct()
    {
        $this->loadSettings();
    }

    /**
     * Load settings from database.
     */
    protected function loadSettings(): void
    {
        $setting = Setting::where('section', 'free_credit')->first();
        
        $this->settings = $setting?->config ?? [
            'enabled' => false,
            'amount' => 0,
        ];
    }

    /**
     * Check if free credit feature is enabled.
     */
    public function isEnabled(): bool
    {
        return (bool) ($this->settings['enabled'] ?? false);
    }

    /**
     * Get the amount of free credit per claim.
     */
    public function getAmount(): float
    {
        return (float) ($this->settings['amount'] ?? 0);
    }

    /**
     * Get the current claim period (YYYY-MM format).
     */
    public function getCurrentPeriod(): string
    {
        return now()->format('Y-m');
    }

    /**
     * Get the period display name.
     */
    public function getPeriodDisplayName(?string $period = null): string
    {
        $period = $period ?? $this->getCurrentPeriod();
        return \Carbon\Carbon::createFromFormat('Y-m', $period)->translatedFormat('F Y');
    }

    /**
     * Check if user has already claimed for a specific period.
     */
    public function hasClaimedForPeriod(User $user, ?string $period = null): bool
    {
        $period = $period ?? $this->getCurrentPeriod();
        
        return FreeCreditClaim::where('user_id', $user->id)
            ->where('period', $period)
            ->exists();
    }

    /**
     * Check if user can claim free credit for current period.
     */
    public function canClaim(User $user): bool
    {
        // Feature must be enabled
        if (!$this->isEnabled()) {
            return false;
        }

        // Amount must be greater than 0
        if ($this->getAmount() <= 0) {
            return false;
        }

        // User must not have claimed for this period
        if ($this->hasClaimedForPeriod($user)) {
            return false;
        }

        return true;
    }

    /**
     * Get claim record for current period if exists.
     */
    public function getClaimForPeriod(User $user, ?string $period = null): ?FreeCreditClaim
    {
        $period = $period ?? $this->getCurrentPeriod();
        
        return FreeCreditClaim::where('user_id', $user->id)
            ->where('period', $period)
            ->first();
    }

    /**
     * Process the free credit claim.
     * Returns the FreeCreditClaim record or null if failed.
     */
    public function claim(User $user): ?FreeCreditClaim
    {
        if (!$this->canClaim($user)) {
            return null;
        }

        return DB::transaction(function () use ($user) {
            $amount = $this->getAmount();
            $period = $this->getCurrentPeriod();

            // Add credit to user account
            $creditLog = $user->addCredit(
                $amount,
                CreditLogType::FREE_CREDIT,
                __('free_credit.claim_description', ['period' => $this->getPeriodDisplayName($period)])
            );

            // Create claim record
            $claim = FreeCreditClaim::create([
                'user_id' => $user->id,
                'amount' => $amount,
                'period' => $period,
                'credit_log_id' => $creditLog->id,
            ]);

            return $claim;
        });
    }

    /**
     * Get claim info for display.
     */
    public function getClaimInfo(User $user): array
    {
        $period = $this->getCurrentPeriod();
        $claim = $this->getClaimForPeriod($user, $period);

        return [
            'enabled' => $this->isEnabled(),
            'amount' => $this->getAmount(),
            'period' => $period,
            'period_display' => $this->getPeriodDisplayName($period),
            'can_claim' => $this->canClaim($user),
            'has_claimed' => $claim !== null,
            'claimed_at' => $claim?->created_at,
            'claim' => $claim,
        ];
    }

    /**
     * Get next period start date.
     */
    public function getNextPeriodStart(): \Carbon\Carbon
    {
        return now()->addMonth()->startOfMonth();
    }
}

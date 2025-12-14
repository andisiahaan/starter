<?php

namespace App\Enums;

enum ReferralBalanceLogType: string
{
    case COMMISSION_AVAILABLE = 'commission_available';
    case WITHDRAWAL_PENDING = 'withdrawal_pending';
    case WITHDRAWAL_COMPLETED = 'withdrawal_completed';
    case WITHDRAWAL_REJECTED = 'withdrawal_rejected';
    case ADJUSTMENT = 'adjustment';

    /**
     * Get human-readable label.
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::COMMISSION_AVAILABLE => __('referral.balance_log_types.commission_available'),
            self::WITHDRAWAL_PENDING => __('referral.balance_log_types.withdrawal_pending'),
            self::WITHDRAWAL_COMPLETED => __('referral.balance_log_types.withdrawal_completed'),
            self::WITHDRAWAL_REJECTED => __('referral.balance_log_types.withdrawal_rejected'),
            self::ADJUSTMENT => __('referral.balance_log_types.adjustment'),
        };
    }

    /**
     * Get CSS color classes.
     */
    public function getColor(): string
    {
        return match ($this) {
            self::COMMISSION_AVAILABLE => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
            self::WITHDRAWAL_PENDING => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
            self::WITHDRAWAL_COMPLETED => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
            self::WITHDRAWAL_REJECTED => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
            self::ADJUSTMENT => 'bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-200',
        };
    }

    /**
     * Check if this is an addition (positive amount).
     */
    public function isAddition(): bool
    {
        return in_array($this, [
            self::COMMISSION_AVAILABLE,
            self::WITHDRAWAL_REJECTED, // Restore on rejection
        ]);
    }

    /**
     * Check if this is a deduction (negative amount).
     */
    public function isDeduction(): bool
    {
        return in_array($this, [
            self::WITHDRAWAL_PENDING,
            self::WITHDRAWAL_COMPLETED,
        ]);
    }

    /**
     * Get all values.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

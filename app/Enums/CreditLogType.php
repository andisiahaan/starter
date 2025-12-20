<?php

namespace App\Enums;

enum CreditLogType: string
{
    case PURCHASE = 'purchase';
    case ADMIN_ADJUSTMENT = 'admin_adjustment';
    case REFUND = 'refund';
    case BONUS = 'bonus';
    case WITHDRAWAL = 'withdrawal';
    case FREE_CREDIT = 'free_credit';

    /**
     * Get localized label for the type.
     */
    public function getLabel(): string
    {
        return __('enums.credit_log_type.labels.' . $this->value);
    }

    /**
     * Get description explaining this type.
     */
    public function getDescription(): string
    {
        return __('enums.credit_log_type.descriptions.' . $this->value);
    }

    /**
     * Get SVG icon for this type (Heroicons).
     */
    public function getIcon(): string
    {
        return match ($this) {
            self::PURCHASE => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
            self::ADMIN_ADJUSTMENT => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>',
            self::REFUND => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/></svg>',
            self::BONUS => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"/></svg>',
            self::WITHDRAWAL => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>',
            self::FREE_CREDIT => '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        };
    }

    /**
     * Get tailwind color classes for badge styling.
     */
    public function getColorClasses(): string
    {
        return match ($this) {
            self::PURCHASE => 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400',
            self::ADMIN_ADJUSTMENT => 'bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400',
            self::REFUND => 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400',
            self::BONUS => 'bg-pink-100 dark:bg-pink-900/30 text-pink-700 dark:text-pink-400',
            self::WITHDRAWAL => 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400',
            self::FREE_CREDIT => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400',
        };
    }

    /**
     * Get icon color classes.
     */
    public function getIconColorClasses(): string
    {
        return match ($this) {
            self::PURCHASE => 'text-green-500 dark:text-green-400',
            self::ADMIN_ADJUSTMENT => 'text-purple-500 dark:text-purple-400',
            self::REFUND => 'text-blue-500 dark:text-blue-400',
            self::BONUS => 'text-pink-500 dark:text-pink-400',
            self::WITHDRAWAL => 'text-red-500 dark:text-red-400',
            self::FREE_CREDIT => 'text-emerald-500 dark:text-emerald-400',
        };
    }

    /**
     * Check if this type typically adds credit (positive amount).
     */
    public function isCredit(): bool
    {
        return match ($this) {
            self::PURCHASE, self::REFUND, self::BONUS, self::ADMIN_ADJUSTMENT, self::FREE_CREDIT => true,
            self::WITHDRAWAL => false,
        };
    }

    /**
     * Get all types that can be manually created by admin.
     */
    public static function getAdminCreatableTypes(): array
    {
        return [
            self::ADMIN_ADJUSTMENT,
            self::BONUS,
            self::REFUND,
        ];
    }

    /**
     * Get all cases as array for dropdowns.
     */
    public static function toArray(): array
    {
        return array_combine(
            array_column(self::cases(), 'value'),
            array_map(fn($case) => $case->getLabel(), self::cases())
        );
    }
}

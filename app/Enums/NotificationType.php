<?php

namespace App\Enums;

/**
 * Notification types with their events.
 * Format: CATEGORY_EVENT
 */
enum NotificationType: string
{
    // Order notifications
    case ORDER_CREATED = 'order.created';
    case ORDER_PAID = 'order.paid';
    case ORDER_PROCESSING = 'order.processing';
    case ORDER_COMPLETED = 'order.completed';
    case ORDER_FAILED = 'order.failed';
    case ORDER_REFUNDED = 'order.refunded';

    // Credit/Balance notifications
    case CREDIT_ADDED = 'credit.added';
    case CREDIT_DEDUCTED = 'credit.deducted';
    case CREDIT_LOW_BALANCE = 'credit.low_balance';

    // Ticket notifications
    case TICKET_CREATED = 'ticket.created';
    case TICKET_REPLIED = 'ticket.replied';
    case TICKET_CLOSED = 'ticket.closed';
    case TICKET_ASSIGNED = 'ticket.assigned';

    // Withdrawal notifications
    case WITHDRAWAL_CREATED = 'withdrawal.created';
    case WITHDRAWAL_STATUS_UPDATED = 'withdrawal.status_updated';

    // News notifications
    case NEWS_PUBLISHED = 'news.published';

    // Account notifications
    case ACCOUNT_LOGIN_ALERT = 'account.login_alert';
    case ACCOUNT_PASSWORD_CHANGED = 'account.password_changed';
    case ACCOUNT_EMAIL_CHANGED = 'account.email_changed';
    case ACCOUNT_2FA_ENABLED = 'account.2fa_enabled';
    case ACCOUNT_2FA_DISABLED = 'account.2fa_disabled';

    // System notifications
    case SYSTEM_MAINTENANCE = 'system.maintenance';
    case SYSTEM_UPDATE = 'system.update';
    case SYSTEM_ANNOUNCEMENT = 'system.announcement';

    // Admin notifications (for admin panel users)
    case ADMIN_USER_REGISTERED = 'admin.user_registered';
    case ADMIN_ORDER_CREATED = 'admin.order_created';
    case ADMIN_ORDER_FAILED = 'admin.order_failed';
    case ADMIN_TICKET_CREATED = 'admin.ticket_created';
    case ADMIN_SYSTEM_ERROR = 'admin.system_error';
    case ADMIN_LOW_STOCK = 'admin.low_stock';
    case ADMIN_WITHDRAWAL_CREATED = 'admin.withdrawal_created';

    // Test notification
    case TEST = 'test';

    /**
     * Get human-readable label.
     */
    public function getLabel(): string
    {
        $key = str_replace('.', '_', $this->value);
        return __('enums.notification_type.labels.' . $key);
    }

    /**
     * Get category/group name.
     */
    public function getCategory(): string
    {
        return match ($this) {
            self::ORDER_CREATED, self::ORDER_PAID, self::ORDER_PROCESSING,
            self::ORDER_COMPLETED, self::ORDER_FAILED, self::ORDER_REFUNDED => 'order',
            
            self::CREDIT_ADDED, self::CREDIT_DEDUCTED, self::CREDIT_LOW_BALANCE => 'credit',
            
            self::TICKET_CREATED, self::TICKET_REPLIED, self::TICKET_CLOSED,
            self::TICKET_ASSIGNED => 'ticket',

            self::WITHDRAWAL_CREATED, self::WITHDRAWAL_STATUS_UPDATED => 'withdrawal',
            
            self::NEWS_PUBLISHED => 'news',
            
            self::ACCOUNT_LOGIN_ALERT, self::ACCOUNT_PASSWORD_CHANGED,
            self::ACCOUNT_EMAIL_CHANGED, self::ACCOUNT_2FA_ENABLED,
            self::ACCOUNT_2FA_DISABLED => 'account',
            
            self::SYSTEM_MAINTENANCE, self::SYSTEM_UPDATE, self::SYSTEM_ANNOUNCEMENT => 'system',

            self::ADMIN_USER_REGISTERED, self::ADMIN_ORDER_CREATED, self::ADMIN_ORDER_FAILED,
            self::ADMIN_TICKET_CREATED, self::ADMIN_SYSTEM_ERROR, self::ADMIN_LOW_STOCK,
            self::ADMIN_WITHDRAWAL_CREATED => 'admin',
            
            self::TEST => 'test',
        };
    }

    /**
     * Get category label.
     */
    public function getCategoryLabel(): string
    {
        return __('enums.notification_type.categories.' . $this->getCategory());
    }

    /**
     * Get description.
     */
    public function getDescription(): string
    {
        $key = str_replace('.', '_', $this->value);
        return __('enums.notification_type.descriptions.' . $key);
    }

    /**
     * Get SVG icon path.
     */
    public function getIcon(): string
    {
        return match ($this->getCategory()) {
            'order' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z',
            'credit' => 'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z',
            'ticket' => 'M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z',
            'withdrawal' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
            'news' => 'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z',
            'account' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
            'system' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z',
            'admin' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
            'test' => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9',
        };
    }

    /**
     * Get color classes.
     */
    public function getColor(): array
    {
        return match ($this->getCategory()) {
            'order' => ['bg' => 'bg-blue-100 dark:bg-blue-900/30', 'text' => 'text-blue-600 dark:text-blue-400'],
            'credit' => ['bg' => 'bg-green-100 dark:bg-green-900/30', 'text' => 'text-green-600 dark:text-green-400'],
            'ticket' => ['bg' => 'bg-orange-100 dark:bg-orange-900/30', 'text' => 'text-orange-600 dark:text-orange-400'],
            'withdrawal' => ['bg' => 'bg-emerald-100 dark:bg-emerald-900/30', 'text' => 'text-emerald-600 dark:text-emerald-400'],
            'news' => ['bg' => 'bg-indigo-100 dark:bg-indigo-900/30', 'text' => 'text-indigo-600 dark:text-indigo-400'],
            'account' => ['bg' => 'bg-purple-100 dark:bg-purple-900/30', 'text' => 'text-purple-600 dark:text-purple-400'],
            'system' => ['bg' => 'bg-amber-100 dark:bg-amber-900/30', 'text' => 'text-amber-600 dark:text-amber-400'],
            'admin' => ['bg' => 'bg-red-100 dark:bg-red-900/30', 'text' => 'text-red-600 dark:text-red-400'],
            'test' => ['bg' => 'bg-slate-100 dark:bg-slate-700', 'text' => 'text-slate-600 dark:text-slate-400'],
        };
    }

    /**
     * Check if this type is enabled by default.
     */
    public function isEnabledByDefault(): bool
    {
        return match ($this) {
            self::TEST => false, // Test notifications disabled by default
            default => true,
        };
    }

    /**
     * Check if this is a security-related notification (always sent).
     */
    public function isSecurityCritical(): bool
    {
        return match ($this) {
            self::ACCOUNT_LOGIN_ALERT,
            self::ACCOUNT_PASSWORD_CHANGED,
            self::ACCOUNT_EMAIL_CHANGED,
            self::ACCOUNT_2FA_ENABLED,
            self::ACCOUNT_2FA_DISABLED => true,
            default => false,
        };
    }

    /**
     * Check if this notification type is for admin users only.
     */
    public function isForAdmin(): bool
    {
        return $this->getCategory() === 'admin';
    }

    /**
     * Check if this notification type is for regular users.
     */
    public function isForUser(): bool
    {
        return !$this->isForAdmin() && $this->getCategory() !== 'test';
    }

    /**
     * Get all unique categories.
     * @param string|null $audience Filter by 'user', 'admin', or null for all
     */
    public static function getCategories(?string $audience = null): array
    {
        $categories = [];
        foreach (self::cases() as $case) {
            // Filter by audience
            if ($audience === 'user' && !$case->isForUser()) {
                continue;
            }
            if ($audience === 'admin' && !$case->isForAdmin()) {
                continue;
            }

            $category = $case->getCategory();
            if (!isset($categories[$category])) {
                $categories[$category] = [
                    'label' => $case->getCategoryLabel(),
                    'icon' => $case->getIcon(),
                    'color' => $case->getColor(),
                ];
            }
        }
        return $categories;
    }

    /**
     * Get categories visible to regular users (excludes admin and test).
     */
    public static function getUserCategories(): array
    {
        return self::getCategories('user');
    }

    /**
     * Get categories visible to admin users only.
     */
    public static function getAdminCategories(): array
    {
        return self::getCategories('admin');
    }

    /**
     * Get all types for a specific category.
     */
    public static function forCategory(string $category): array
    {
        return array_values(array_filter(
            self::cases(),
            fn($case) => $case->getCategory() === $category
        ));
    }

    /**
     * Get all types for regular users (excludes admin types).
     */
    public static function forUser(): array
    {
        return array_values(array_filter(
            self::cases(),
            fn($case) => $case->isForUser()
        ));
    }

    /**
     * Get all types for admin users only.
     */
    public static function forAdmin(): array
    {
        return array_values(array_filter(
            self::cases(),
            fn($case) => $case->isForAdmin()
        ));
    }

    /**
     * Get all type values as simple array.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get default enabled types (for settings initialization).
     */
    public static function getDefaults(): array
    {
        $defaults = [];
        foreach (self::cases() as $case) {
            $defaults[$case->value] = $case->isEnabledByDefault();
        }
        return $defaults;
    }
}

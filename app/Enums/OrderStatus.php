<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case PROCESSING = 'processing';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
    case CANCELLED = 'cancelled';
    case REFUNDED = 'refunded';

    /**
     * Get human-readable label.
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::PENDING => __('orders.status.pending'),
            self::PAID => __('orders.status.paid'),
            self::PROCESSING => __('orders.status.processing'),
            self::COMPLETED => __('orders.status.completed'),
            self::FAILED => __('orders.status.failed'),
            self::CANCELLED => __('orders.status.cancelled'),
            self::REFUNDED => __('orders.status.refunded'),
        };
    }

    /**
     * Get CSS classes for badge styling.
     */
    public function getColor(): string
    {
        return match ($this) {
            self::PENDING => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
            self::PAID => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
            self::PROCESSING => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
            self::COMPLETED => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900 dark:text-emerald-200',
            self::FAILED => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
            self::CANCELLED => 'bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-200',
            self::REFUNDED => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200',
        };
    }

    /**
     * Get Heroicon name for status.
     */
    public function getIcon(): string
    {
        return match ($this) {
            self::PENDING => 'clock',
            self::PAID => 'check-circle',
            self::PROCESSING => 'arrow-path',
            self::COMPLETED => 'check-badge',
            self::FAILED => 'x-circle',
            self::CANCELLED => 'no-symbol',
            self::REFUNDED => 'arrow-uturn-left',
        };
    }

    /**
     * Get notification type key for this status.
     */
    public function getNotificationType(): ?string
    {
        return match ($this) {
            self::PAID => 'order.paid',
            self::PROCESSING => 'order.processing',
            self::COMPLETED => 'order.completed',
            self::FAILED, self::CANCELLED => 'order.failed',
            self::REFUNDED => 'order.refunded',
            default => null,
        };
    }

    /**
     * Check if this status represents a successful payment.
     */
    public function isPaid(): bool
    {
        return $this === self::PAID;
    }

    /**
     * Check if this status is terminal (order is finished).
     */
    public function isTerminal(): bool
    {
        return in_array($this, [
            self::COMPLETED,
            self::FAILED,
            self::CANCELLED,
            self::REFUNDED,
        ]);
    }

    /**
     * Check if this status can be changed to another status.
     */
    public function canTransitionTo(self $newStatus): bool
    {
        // Define valid transitions
        $validTransitions = [
            self::PENDING->value => [self::PAID, self::FAILED, self::CANCELLED],
            self::PAID->value => [self::PROCESSING, self::COMPLETED, self::REFUNDED],
            self::PROCESSING->value => [self::COMPLETED, self::FAILED, self::REFUNDED],
            self::COMPLETED->value => [self::REFUNDED],
            self::FAILED->value => [],
            self::CANCELLED->value => [],
            self::REFUNDED->value => [],
        ];

        return in_array($newStatus, $validTransitions[$this->value] ?? []);
    }

    /**
     * Get all values as array.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get options for select dropdown.
     */
    public static function toSelectOptions(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($case) => [$case->value => $case->getLabel()])
            ->toArray();
    }
}

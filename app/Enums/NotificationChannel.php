<?php

namespace App\Enums;

/**
 * Notification delivery channels.
 */
enum NotificationChannel: string
{
    case DATABASE = 'database';
    case EMAIL = 'email';
    case PUSH = 'push';

    /**
     * Get human-readable label.
     */
    public function getLabel(): string
    {
        return match ($this) {
            self::DATABASE => 'In-App',
            self::EMAIL => 'Email',
            self::PUSH => 'Push',
        };
    }

    /**
     * Get description for the channel.
     */
    public function getDescription(): string
    {
        return match ($this) {
            self::DATABASE => 'Notifications appear in your notification center',
            self::EMAIL => 'Receive notifications via email',
            self::PUSH => 'Browser push notifications',
        };
    }

    /**
     * Get SVG icon path for the channel.
     */
    public function getIcon(): string
    {
        return match ($this) {
            self::DATABASE => 'M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4',
            self::EMAIL => 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
            self::PUSH => 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9',
        };
    }

    /**
     * Check if this channel is required (cannot be disabled).
     */
    public function isRequired(): bool
    {
        return $this === self::DATABASE;
    }

    /**
     * Check if this channel requires external configuration.
     */
    public function requiresConfiguration(): bool
    {
        return match ($this) {
            self::EMAIL => true, // Requires SMTP config
            self::PUSH => true,  // Requires VAPID keys
            self::DATABASE => false,
        };
    }

    /**
     * Get the Laravel notification channel class/name.
     */
    public function getChannelClass(): string
    {
        return match ($this) {
            self::DATABASE => 'database',
            self::EMAIL => 'mail',
            self::PUSH => \NotificationChannels\WebPush\WebPushChannel::class,
        };
    }

    /**
     * Get all channel values as simple array.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get default enabled channels (for settings initialization).
     */
    public static function getDefaults(): array
    {
        $defaults = [];
        foreach (self::cases() as $case) {
            $defaults[$case->value] = $case->isRequired();
        }
        return $defaults;
    }
}

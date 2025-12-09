<?php

namespace App\Traits;

use App\Enums\NotificationChannel;
use App\Enums\NotificationType;

/**
 * Trait for handling user notification preferences.
 * Checks both global settings (admin-level) and user preferences (user-level).
 */
trait HasNotificationPreferences
{
    /**
     * Check if a notification type is enabled for this user.
     * Considers both global settings AND user preferences.
     *
     * @param NotificationType|string $type
     * @return bool
     */
    public function isNotificationTypeEnabled(NotificationType|string $type): bool
    {
        $typeValue = $type instanceof NotificationType ? $type->value : $type;
        
        // 1. Check global settings first - if globally disabled, user can't enable
        $globalSettings = setting('notifications');
        $globalEnabled = $globalSettings['types'][$typeValue] ?? true;
        
        if (!$globalEnabled) {
            return false;
        }
        
        // 2. Check if it's a security-critical notification (always enabled)
        if ($type instanceof NotificationType && $type->isSecurityCritical()) {
            return true;
        }
        
        // 3. Check user preferences
        $userPrefs = $this->getNotificationPreferences();
        
        return $userPrefs['types'][$typeValue] ?? true;
    }

    /**
     * Check if a notification channel is enabled for this user.
     * Considers both global settings AND user preferences.
     *
     * @param NotificationChannel|string $channel
     * @return bool
     */
    public function isNotificationChannelEnabled(NotificationChannel|string $channel): bool
    {
        $channelValue = $channel instanceof NotificationChannel ? $channel->value : $channel;
        
        // 1. Check global settings first
        $globalSettings = setting('notifications');
        $globalEnabled = $globalSettings['channels'][$channelValue] ?? false;
        
        if (!$globalEnabled) {
            // Required channels are always enabled
            if ($channel instanceof NotificationChannel && $channel->isRequired()) {
                return true;
            }
            return false;
        }
        
        // 2. Check if it's a required channel (always enabled)
        if ($channel instanceof NotificationChannel && $channel->isRequired()) {
            return true;
        }
        
        // 3. Check user preferences
        $userPrefs = $this->getNotificationPreferences();
        
        return $userPrefs['channels'][$channelValue] ?? true;
    }

    /**
     * Get user's notification preferences from preferences column.
     *
     * @return array
     */
    public function getNotificationPreferences(): array
    {
        $preferences = $this->preferences ?? [];
        
        return $preferences['notifications'] ?? [
            'channels' => [],
            'types' => [],
        ];
    }

    /**
     * Set user's notification preferences.
     *
     * @param array $notificationPrefs
     * @return bool
     */
    public function setNotificationPreferences(array $notificationPrefs): bool
    {
        $preferences = $this->preferences ?? [];
        $preferences['notifications'] = $notificationPrefs;
        
        return $this->update(['preferences' => $preferences]);
    }

    /**
     * Get enabled channels for this user (respecting global + user settings).
     *
     * @return array Array of NotificationChannel enum cases
     */
    public function getEnabledNotificationChannels(): array
    {
        $enabled = [];
        
        foreach (NotificationChannel::cases() as $channel) {
            if ($this->isNotificationChannelEnabled($channel)) {
                $enabled[] = $channel;
            }
        }
        
        return $enabled;
    }

    /**
     * Get enabled notification types for this user (respecting global + user settings).
     *
     * @return array Array of NotificationType enum cases
     */
    public function getEnabledNotificationTypes(): array
    {
        $enabled = [];
        
        foreach (NotificationType::cases() as $type) {
            if ($this->isNotificationTypeEnabled($type)) {
                $enabled[] = $type;
            }
        }
        
        return $enabled;
    }

    /**
     * Get the notification channels to use for sending.
     * Returns channel class names ready for via() method.
     *
     * @param NotificationType|null $type Optional type to filter by
     * @return array Array of channel class names
     */
    public function getNotificationViaChannels(?NotificationType $type = null): array
    {
        $channels = [];
        
        // If type specified and disabled, return database only for history
        if ($type && !$this->isNotificationTypeEnabled($type)) {
            return [NotificationChannel::DATABASE->getChannelClass()];
        }
        
        foreach (NotificationChannel::cases() as $channel) {
            if (!$this->isNotificationChannelEnabled($channel)) {
                continue;
            }
            
            // For push, check if user has subscriptions
            if ($channel === NotificationChannel::PUSH) {
                if (!$this->pushSubscriptions()->exists()) {
                    continue;
                }
            }
            
            $channels[] = $channel->getChannelClass();
        }
        
        // Fallback to database if nothing enabled
        if (empty($channels)) {
            $channels[] = NotificationChannel::DATABASE->getChannelClass();
        }
        
        return $channels;
    }

    /**
     * Toggle a notification type for this user.
     *
     * @param NotificationType|string $type
     * @return bool New state
     */
    public function toggleNotificationType(NotificationType|string $type): bool
    {
        $typeValue = $type instanceof NotificationType ? $type->value : $type;
        
        // Security-critical notifications cannot be toggled
        if ($type instanceof NotificationType && $type->isSecurityCritical()) {
            return true;
        }
        
        $prefs = $this->getNotificationPreferences();
        $currentState = $prefs['types'][$typeValue] ?? true;
        $prefs['types'][$typeValue] = !$currentState;
        
        $this->setNotificationPreferences($prefs);
        
        return !$currentState;
    }

    /**
     * Toggle a notification channel for this user.
     *
     * @param NotificationChannel|string $channel
     * @return bool New state
     */
    public function toggleNotificationChannel(NotificationChannel|string $channel): bool
    {
        $channelValue = $channel instanceof NotificationChannel ? $channel->value : $channel;
        
        // Required channels cannot be toggled
        if ($channel instanceof NotificationChannel && $channel->isRequired()) {
            return true;
        }
        
        $prefs = $this->getNotificationPreferences();
        $currentState = $prefs['channels'][$channelValue] ?? true;
        $prefs['channels'][$channelValue] = !$currentState;
        
        $this->setNotificationPreferences($prefs);
        
        return !$currentState;
    }
}

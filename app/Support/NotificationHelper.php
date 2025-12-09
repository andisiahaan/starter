<?php

namespace App\Support;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification as NotificationFacade;
use Throwable;

/**
 * Helper class for sending notifications safely without breaking main transaction flow.
 */
class NotificationHelper
{
    /**
     * Send notification synchronously with try-catch.
     * Will NOT throw exception on failure, only logs the error.
     *
     * @param mixed $notifiable The user or entity to notify
     * @param Notification $notification The notification instance
     * @return bool True if sent successfully, false otherwise
     */
    public static function sendSafely(mixed $notifiable, Notification $notification): bool
    {
        try {
            $notifiable->notify($notification);
            
            Log::info('[Notification] Sent successfully', [
                'notification' => get_class($notification),
                'notifiable_type' => get_class($notifiable),
                'notifiable_id' => $notifiable->id ?? null,
            ]);
            
            return true;
        } catch (Throwable $e) {
            Log::error('[Notification] Failed to send', [
                'notification' => get_class($notification),
                'notifiable_type' => get_class($notifiable),
                'notifiable_id' => $notifiable->id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return false;
        }
    }

    /**
     * Send notification asynchronously via queue with afterCommit.
     * The notification class should implement ShouldQueue and have $afterCommit = true.
     *
     * @param mixed $notifiable The user or entity to notify
     * @param Notification $notification The notification instance (should implement ShouldQueue)
     * @return bool True if queued successfully, false otherwise
     */
    public static function sendAsync(mixed $notifiable, Notification $notification): bool
    {
        try {
            // Verify notification implements ShouldQueue
            if (!$notification instanceof ShouldQueue) {
                Log::warning('[Notification] Notification does not implement ShouldQueue, sending synchronously', [
                    'notification' => get_class($notification),
                ]);
            }
            
            $notifiable->notify($notification);
            
            Log::info('[Notification] Queued successfully', [
                'notification' => get_class($notification),
                'notifiable_type' => get_class($notifiable),
                'notifiable_id' => $notifiable->id ?? null,
            ]);
            
            return true;
        } catch (Throwable $e) {
            Log::error('[Notification] Failed to queue', [
                'notification' => get_class($notification),
                'notifiable_type' => get_class($notifiable),
                'notifiable_id' => $notifiable->id ?? null,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return false;
        }
    }

    /**
     * Send notification to multiple notifiables.
     *
     * @param iterable $notifiables Collection of users/entities to notify
     * @param Notification $notification The notification instance
     * @return array Results array with 'success' count and 'failed' count
     */
    public static function sendToMany(iterable $notifiables, Notification $notification): array
    {
        $results = ['success' => 0, 'failed' => 0, 'failures' => []];
        
        try {
            // Use Laravel's bulk notification sending
            NotificationFacade::send($notifiables, $notification);
            
            $count = is_countable($notifiables) ? count($notifiables) : iterator_count($notifiables);
            $results['success'] = $count;
            
            Log::info('[Notification] Bulk notification sent', [
                'notification' => get_class($notification),
                'count' => $count,
            ]);
        } catch (Throwable $e) {
            // If bulk fails, try individual sending
            foreach ($notifiables as $notifiable) {
                if (self::sendAsync($notifiable, $notification)) {
                    $results['success']++;
                } else {
                    $results['failed']++;
                    $results['failures'][] = $notifiable->id ?? null;
                }
            }
            
            Log::warning('[Notification] Bulk notification failed, sent individually', [
                'notification' => get_class($notification),
                'success' => $results['success'],
                'failed' => $results['failed'],
                'error' => $e->getMessage(),
            ]);
        }
        
        return $results;
    }

    /**
     * Check if a notification type is enabled in global settings.
     *
     * @param string $type The notification type value
     * @return bool True if enabled, false otherwise
     */
    public static function isTypeEnabled(string $type): bool
    {
        $settings = setting('notifications');
        
        if (!$settings || !isset($settings['types'])) {
            return true; // Default to enabled if not configured
        }
        
        return $settings['types'][$type] ?? true;
    }

    /**
     * Check if a channel is enabled in global settings.
     *
     * @param string $channel The notification channel value
     * @return bool True if enabled, false otherwise
     */
    public static function isChannelEnabled(string $channel): bool
    {
        $settings = setting('notifications');
        
        if (!$settings || !isset($settings['channels'])) {
            return $channel === 'database'; // Default to database only
        }
        
        return $settings['channels'][$channel] ?? false;
    }

    /**
     * Send notification to all admins who have subscribed to this notification type.
     *
     * @param Notification $notification The notification instance
     * @param string $notificationType The notification type value (e.g., 'admin.user_registered')
     * @return array Results with success and failed counts
     */
    public static function sendToAdmins(Notification $notification, string $notificationType): array
    {
        // Check if globally enabled
        $globalKey = 'admin.notifications.' . str_replace('admin.', '', $notificationType);
        if (setting($globalKey) === false) {
            Log::info('[Notification] Admin notification globally disabled', [
                'type' => $notificationType,
            ]);
            return ['success' => 0, 'failed' => 0, 'skipped' => true];
        }

        // Get all admins
        $admins = \App\Models\User::role(['admin', 'superadmin'])->get();

        $results = ['success' => 0, 'failed' => 0, 'skipped' => false];

        foreach ($admins as $admin) {
            // Check individual admin preferences
            $preferences = $admin->notification_preferences ?? [];
            $isEnabled = $preferences[$notificationType] ?? true; // Default enabled

            if (!$isEnabled) {
                continue; // Skip this admin, they opted out
            }

            if (self::sendAsync($admin, $notification)) {
                $results['success']++;
            } else {
                $results['failed']++;
            }
        }

        Log::info('[Notification] Sent to admins', [
            'notification' => get_class($notification),
            'type' => $notificationType,
            'success' => $results['success'],
            'failed' => $results['failed'],
        ]);

        return $results;
    }
}


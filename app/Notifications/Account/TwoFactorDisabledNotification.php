<?php

namespace App\Notifications\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use NotificationChannels\WebPush\WebPushMessage;

/**
 * Notification sent when user disables Two-Factor Authentication.
 * This is a mandatory security notification (not affected by user settings).
 */
class TwoFactorDisabledNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct()
    {
        $this->afterCommit();
    }

    /**
     * Mandatory - always send via all channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('notifications.account.2fa_disabled.subject', ['app' => setting('main.name', config('app.name'))]))
            ->greeting(__('notifications.account.2fa_disabled.greeting', ['name' => $notifiable->name]))
            ->line(__('notifications.account.2fa_disabled.line1'))
            ->line(__('notifications.account.2fa_disabled.line2'))
            ->action(__('notifications.account.2fa_disabled.action'), route('app.account'))
            ->line(__('notifications.account.2fa_disabled.line3'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'account.2fa_disabled',
            'category' => 'account',
            'title' => __('notifications.account.2fa_disabled.title'),
            'message' => __('notifications.account.2fa_disabled.message'),
            'url' => route('app.account'),
        ];
    }

    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        $icon = Storage::url(setting('main.logo'));

        return (new WebPushMessage)
            ->title(__('notifications.account.2fa_disabled.title'))
            ->icon($icon)
            ->body(__('notifications.account.2fa_disabled.message'))
            ->badge($icon)
            ->options([
                'TTL' => 86400,
                'urgency' => 'high',
            ])
            ->data([
                'type' => 'account.2fa_disabled',
                'url' => route('app.account'),
            ]);
    }
}

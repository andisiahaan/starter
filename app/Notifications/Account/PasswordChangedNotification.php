<?php

namespace App\Notifications\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use NotificationChannels\WebPush\WebPushMessage;

/**
 * Notification sent when user changes their password.
 * This is a mandatory security notification (not affected by user settings).
 */
class PasswordChangedNotification extends Notification implements ShouldQueue
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
            ->subject(__('notifications.account.password_changed.subject', ['app' => setting('main.name', config('app.name'))]))
            ->greeting(__('notifications.account.password_changed.greeting', ['name' => $notifiable->name]))
            ->line(__('notifications.account.password_changed.line1'))
            ->line(__('notifications.account.password_changed.line2'))
            ->line(__('notifications.account.password_changed.line3'))
            ->action(__('notifications.account.password_changed.action'), route('app.account'))
            ->line(__('notifications.account.password_changed.line4'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'account.password_changed',
            'category' => 'account',
            'title' => __('notifications.account.password_changed.title'),
            'message' => __('notifications.account.password_changed.message'),
            'url' => route('app.account'),
        ];
    }

    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        $icon = Storage::url(setting('main.logo'));

        return (new WebPushMessage)
            ->title(__('notifications.account.password_changed.title'))
            ->icon($icon)
            ->body(__('notifications.account.password_changed.message'))
            ->action(__('notifications.account.password_changed.action'), route('app.account'))
            ->badge($icon)
            ->options([
                'TTL' => 86400,
                'urgency' => 'high',
            ])
            ->data([
                'type' => 'account.password_changed',
                'url' => route('app.account'),
            ]);
    }
}

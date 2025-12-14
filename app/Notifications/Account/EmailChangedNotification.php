<?php

namespace App\Notifications\Account;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use NotificationChannels\WebPush\WebPushMessage;

/**
 * Notification sent when user's email is successfully changed.
 * Sent to both old and new email addresses.
 * This is a mandatory security notification (not affected by user settings).
 */
class EmailChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $oldEmail,
        public string $newEmail,
        public bool $isNewEmail = false // true if sent to new email, false if sent to old email
    ) {
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
        // Handle AnonymousNotifiable (no name property) or User
        $name = $notifiable->name ?? 'User';
        
        if ($this->isNewEmail) {
            // Email to new address - welcome/confirmation
            return (new MailMessage)
                ->subject(__('notifications.account.email_changed_new.subject', ['app' => setting('main.name', config('app.name'))]))
                ->greeting(__('notifications.account.email_changed_new.greeting', ['name' => $name]))
                ->line(__('notifications.account.email_changed_new.line1'))
                ->line(__('notifications.account.email_changed_new.line2', ['email' => $this->newEmail]))
                ->action(__('notifications.account.email_changed_new.action'), route('app.account'))
                ->line(__('notifications.account.email_changed_new.line3'));
        } else {
            // Email to old address - security notice
            return (new MailMessage)
                ->subject(__('notifications.account.email_changed_old.subject', ['app' => setting('main.name', config('app.name'))]))
                ->greeting(__('notifications.account.email_changed_old.greeting', ['name' => $name]))
                ->line(__('notifications.account.email_changed_old.line1'))
                ->line(__('notifications.account.email_changed_old.line2', ['old' => $this->oldEmail, 'new' => $this->newEmail]))
                ->line(__('notifications.account.email_changed_old.line3'))
                ->action(__('notifications.account.email_changed_old.action'), route('app.account'))
                ->line(__('notifications.account.email_changed_old.line4'));
        }
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'account.email_changed',
            'category' => 'account',
            'title' => __('notifications.account.email_changed.title'),
            'message' => __('notifications.account.email_changed.message', [
                'old' => $this->oldEmail,
                'new' => $this->newEmail,
            ]),
            'url' => route('app.account'),
            'data' => [
                'old_email' => $this->oldEmail,
                'new_email' => $this->newEmail,
            ],
        ];
    }

    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        $icon = Storage::url(setting('main.logo'));

        return (new WebPushMessage)
            ->title(__('notifications.account.email_changed.title'))
            ->icon($icon)
            ->body(__('notifications.account.email_changed.message', [
                'old' => $this->oldEmail,
                'new' => $this->newEmail,
            ]))
            ->action(__('notifications.account.email_changed.action'), route('app.account'))
            ->badge($icon)
            ->options([
                'TTL' => 86400,
                'urgency' => 'high',
            ])
            ->data([
                'type' => 'account.email_changed',
                'url' => route('app.account'),
            ]);
    }
}

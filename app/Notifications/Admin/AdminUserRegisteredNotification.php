<?php

namespace App\Notifications\Admin;

use App\Enums\NotificationType;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;

class AdminUserRegisteredNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected User $newUser
    ) {
        $this->afterCommit = true;
    }

    public function via(object $notifiable): array
    {
        return $notifiable->getNotificationViaChannels(NotificationType::ADMIN_USER_REGISTERED);
    }

    public function toMail(object $notifiable): MailMessage
    {
        $appName = setting('main.name', config('app.name'));

        return (new MailMessage)
            ->subject("[{$appName}] " . __('admin.notifications.user_registered.subject'))
            ->greeting(__('admin.notifications.user_registered.greeting'))
            ->line(__('admin.notifications.user_registered.line1'))
            ->line(__('admin.notifications.user_registered.name', ['value' => $this->newUser->name]))
            ->line(__('admin.notifications.user_registered.email', ['value' => $this->newUser->email]))
            ->action(__('admin.notifications.user_registered.action'), url("/admin/users"));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => NotificationType::ADMIN_USER_REGISTERED->value,
            'title' => __('admin.notifications.user_registered.title'),
            'message' => __('admin.notifications.user_registered.message', [
                'name' => $this->newUser->name,
                'email' => $this->newUser->email,
            ]),
            'user_id' => $this->newUser->id,
            'user_name' => $this->newUser->name,
            'user_email' => $this->newUser->email,
            'url' => url("/admin/users"),
        ];
    }

    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        return (new WebPushMessage)
            ->title(__('admin.notifications.user_registered.title'))
            ->body(__('admin.notifications.user_registered.message', [
                'name' => $this->newUser->name,
                'email' => $this->newUser->email,
            ]))
            ->icon(asset('favicon.ico'))
            ->action(__('admin.notifications.user_registered.action'), url("/admin/users"))
            ->data(['url' => url("/admin/users")]);
    }
}

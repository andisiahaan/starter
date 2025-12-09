<?php

namespace App\Notifications\Admin;

use App\Enums\NotificationType;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class AdminUserRegisteredNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $afterCommit = true;

    public function __construct(
        protected User $newUser
    ) {}

    public function via(object $notifiable): array
    {
        return $notifiable->getNotificationViaChannels(NotificationType::ADMIN_USER_REGISTERED);
    }

    public function toMail(object $notifiable): MailMessage
    {
        $appName = config('app.name');

        return (new MailMessage)
            ->subject("[{$appName}] New User Registered")
            ->greeting('Hello Admin!')
            ->line("A new user has registered on your platform.")
            ->line("**Name:** {$this->newUser->name}")
            ->line("**Email:** {$this->newUser->email}")
            ->action('View User', url("/admin/users"))
            ->line('This notification was sent because you enabled Admin Alerts.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => NotificationType::ADMIN_USER_REGISTERED->value,
            'title' => 'New User Registered',
            'message' => "{$this->newUser->name} has registered.",
            'user_id' => $this->newUser->id,
            'user_name' => $this->newUser->name,
            'user_email' => $this->newUser->email,
            'url' => url("/admin/users"),
        ];
    }

    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        return (new WebPushMessage)
            ->title('New User Registered')
            ->body("{$this->newUser->name} has just registered.")
            ->icon(asset('favicon.ico'))
            ->action('View', url("/admin/users"))
            ->data(['url' => url("/admin/users")]);
    }
}

<?php

namespace App\Notifications;

use App\Enums\NotificationChannel;
use App\Enums\NotificationType;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use Illuminate\Support\Facades\Storage;

class TestNotification extends Notification
{
    protected NotificationType $type;

    /**
     * Create a new notification instance.
     */
    public function __construct(?NotificationType $type = null)
    {
        $this->type = $type ?? NotificationType::TEST;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        // Use the trait method which checks both global and user settings
        return $notifiable->getNotificationViaChannels($this->type);
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject($this->type->getLabel() . ' - ' . setting('main.name', config('app.name')))
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('This is a test notification to verify your email notification setup is working correctly.')
            ->line('Type: ' . $this->type->getLabel())
            ->line('Category: ' . $this->type->getCategoryLabel())
            ->action('Visit Dashboard', url('/app'))
            ->line('If you received this email, your email notifications are configured properly!');
    }

    /**
     * Get the array representation of the notification for database.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => $this->type->value,
            'category' => $this->type->getCategory(),
            'title' => $this->type->getLabel(),
            'message' => $this->type->getDescription(),
            'url' => route('app.index'),
        ];
    }

    /**
     * Get the web push representation of the notification.
     */
    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {   
        $icon = Storage::url(setting('main.logo'));
        return (new WebPushMessage)
            ->title($this->type->getLabel() . ' - ' . setting('main.name', config('app.name')))
            ->icon($icon)
            ->body($this->type->getDescription())
            ->action('View', route('app.index'))
            ->badge($icon)
            ->vibrate([200, 100, 200, 100, 200])
            ->options([
                'TTL' => 86400, // 1 day
                'urgency' => 'normal',
            ])
            ->data([
                'type' => $this->type->value,
                'url' => route('app.index'),
            ]);
    }
}

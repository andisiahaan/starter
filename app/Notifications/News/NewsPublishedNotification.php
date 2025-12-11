<?php

namespace App\Notifications\News;

use App\Enums\NotificationChannel;
use App\Enums\NotificationType;
use App\Models\News;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class NewsPublishedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected NotificationType $type;

    public function __construct(
        protected News $news
    ) {
        $this->type = NotificationType::NEWS_PUBLISHED;
        $this->afterCommit();
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return $notifiable->getNotificationViaChannels($this->type);
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $appName = config('app.name');
        $excerpt = Str::limit(strip_tags($this->news->content), 200);
        $typeLabel = News::types()[$this->news->type] ?? $this->news->type;

        return (new MailMessage)
            ->subject("[{$typeLabel}] {$this->news->title} - {$appName}")
            ->greeting("Hello {$notifiable->name}!")
            ->line("A new {$typeLabel} has been published:")
            ->line("**{$this->news->title}**")
            ->line($excerpt)
            ->action('Read More', url('/app/news/' . $this->news->slug))
            ->line('Stay updated with the latest news and announcements.');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => $this->type->value,
            'category' => $this->type->getCategory(),
            'title' => $this->news->title,
            'message' => Str::limit(strip_tags($this->news->content), 100),
            'news_id' => $this->news->id,
            'news_slug' => $this->news->slug,
            'news_type' => $this->news->type,
            'url' => '/app/news/' . $this->news->slug,
        ];
    }

    /**
     * Get the web push representation of the notification.
     */
    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        $typeLabel = News::types()[$this->news->type] ?? 'News';
        
        return (new WebPushMessage)
            ->title($typeLabel . ': ' . $this->news->title)
            ->icon(Storage::url(setting('main.logo')))
            ->body(Str::limit(strip_tags($this->news->content), 100))
            ->action('Read More', '/app/news/' . $this->news->slug)
            ->options([
                'urgency' => $this->news->type === 'warning' ? 'high' : 'normal',
                'TTL' => 86400,
            ]);
    }
}

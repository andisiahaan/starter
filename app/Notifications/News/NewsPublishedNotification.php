<?php

namespace App\Notifications\News;

use App\Enums\NotificationType;
use App\Models\News;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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

    public function via(object $notifiable): array
    {
        return $notifiable->getNotificationViaChannels($this->type);
    }

    public function toMail(object $notifiable): MailMessage
    {
        $appName = setting('main.name', config('app.name'));
        $excerpt = Str::limit(strip_tags($this->news->content), 200);
        $typeLabel = News::types()[$this->news->type] ?? $this->news->type;

        return (new MailMessage)
            ->subject(__('news.notifications.published.subject', ['app' => $appName, 'title' => $this->news->title]))
            ->greeting(__('news.notifications.published.greeting', ['name' => $notifiable->name]))
            ->line(__('news.notifications.published.line1'))
            ->line("**{$this->news->title}**")
            ->line($excerpt)
            ->action(__('news.notifications.published.action'), url('/app/news/' . $this->news->slug));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => $this->type->value,
            'category' => $this->type->getCategory(),
            'title' => __('news.notifications.published.title'),
            'message' => __('news.notifications.published.message', ['title' => $this->news->title]),
            'news_id' => $this->news->id,
            'news_slug' => $this->news->slug,
            'news_type' => $this->news->type,
            'url' => '/app/news/' . $this->news->slug,
        ];
    }

    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        $typeLabel = News::types()[$this->news->type] ?? 'News';
        
        return (new WebPushMessage)
            ->title(__('news.notifications.published.title') . ': ' . $this->news->title)
            ->icon(Storage::url(setting('main.logo')))
            ->body(Str::limit(strip_tags($this->news->content), 100))
            ->action(__('news.notifications.published.action'), '/app/news/' . $this->news->slug)
            ->options([
                'urgency' => $this->news->type === 'warning' ? 'high' : 'normal',
                'TTL' => 86400,
            ]);
    }
}

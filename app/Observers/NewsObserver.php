<?php

namespace App\Observers;

use App\Models\News;
use App\Models\User;
use App\Notifications\News\NewsPublishedNotification;
use App\Support\NotificationHelper;
use Illuminate\Support\Facades\Log;

class NewsObserver
{
    /**
     * Handle the News "created" event.
     */
    public function created(News $news): void
    {
        // If news is published immediately on create, broadcast
        if ($news->is_published && $news->isActive()) {
            //$this->broadcastNews($news);
        }
    }

    /**
     * Handle the News "updated" event.
     */
    public function updated(News $news): void
    {
        // Check if news just became published
        if ($news->isDirty('is_published') && $news->is_published && $news->isActive()) {
            //$this->broadcastNews($news);
        }
    }

    /**
     * Broadcast news to all users.
     */
    protected function broadcastNews(News $news): void
    {
        // Get all users to notify (you might want to add filters here)
        $users = User::where('email_verified_at', '!=', null)
            ->orWhereNull('email_verified_at') // Include all users if verification not required
            ->cursor();

        $notification = new NewsPublishedNotification($news);

        foreach ($users as $user) {
            NotificationHelper::sendAsync($user, $notification);
        }

        Log::info('News broadcast initiated', [
            'news_id' => $news->id,
            'title' => $news->title,
        ]);
    }
}

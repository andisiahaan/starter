<?php

namespace App\Providers;

use App\Models\News;
use App\Models\Order;
use App\Models\Ticket;
use App\Models\TicketReply;
use App\Models\User;
use App\Observers\NewsObserver;
use App\Observers\OrderObserver;
use App\Observers\TicketObserver;
use App\Observers\TicketReplyObserver;
use App\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register model observers for notifications
        User::observe(UserObserver::class);
        Order::observe(OrderObserver::class);
        Ticket::observe(TicketObserver::class);
        TicketReply::observe(TicketReplyObserver::class);
        News::observe(NewsObserver::class);
    }
}

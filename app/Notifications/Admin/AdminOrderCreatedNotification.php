<?php

namespace App\Notifications\Admin;

use App\Enums\NotificationType;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class AdminOrderCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected Order $order
    ) {
        $this->afterCommit();
    }

    public function via(object $notifiable): array
    {
        return $notifiable->getNotificationViaChannels(NotificationType::ADMIN_ORDER_CREATED);
    }

    public function toMail(object $notifiable): MailMessage
    {
        $appName = config('app.name');
        $amount = number_format($this->order->total_amount, 0, ',', '.');

        return (new MailMessage)
            ->subject("[{$appName}] New Order #{$this->order->order_number}")
            ->greeting('Hello Admin!')
            ->line("A new order has been placed.")
            ->line("**Order:** #{$this->order->order_number}")
            ->line("**Customer:** {$this->order->user?->name}")
            ->line("**Amount:** Rp {$amount}")
            ->line("**Credits:** {$this->order->credit_amount}")
            ->action('View Order', url("/admin/orders"))
            ->line('This notification was sent because you enabled Admin Alerts.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => NotificationType::ADMIN_ORDER_CREATED->value,
            'title' => 'New Order Created',
            'message' => "Order #{$this->order->order_number} - Rp " . number_format($this->order->total_amount, 0, ',', '.'),
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'total_amount' => $this->order->total_amount,
            'url' => url("/admin/orders"),
        ];
    }

    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        $amount = number_format($this->order->total_amount, 0, ',', '.');
        
        return (new WebPushMessage)
            ->title('New Order Created')
            ->body("#{$this->order->order_number} - Rp {$amount}")
            ->icon(asset('favicon.ico'))
            ->action('View', url("/admin/orders"))
            ->data(['url' => url("/admin/orders")]);
    }
}

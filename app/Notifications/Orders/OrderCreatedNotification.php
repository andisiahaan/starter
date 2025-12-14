<?php

namespace App\Notifications\Orders;

use App\Enums\NotificationType;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use NotificationChannels\WebPush\WebPushMessage;

/**
 * Notification sent when a new order is created.
 */
class OrderCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected NotificationType $type;

    public function __construct(
        public Order $order
    ) {
        $this->type = NotificationType::ORDER_CREATED;
        $this->afterCommit();
    }

    public function via(object $notifiable): array
    {
        return $notifiable->getNotificationViaChannels($this->type);
    }

    public function toMail(object $notifiable): MailMessage
    {
        $appName = setting('main.name', config('app.name'));
        
        return (new MailMessage)
            ->subject(__('orders.notifications.created.subject', ['app' => $appName]))
            ->greeting(__('orders.notifications.created.greeting', ['name' => $notifiable->name]))
            ->line(__('orders.notifications.created.line1'))
            ->line(__('orders.notifications.created.details_title'))
            ->line(__('orders.notifications.created.order_id', ['value' => $this->order->order_number]))
            ->line(__('orders.notifications.created.product', ['value' => $this->order->product_name]))
            ->line(__('orders.notifications.created.amount', ['value' => 'Rp ' . number_format($this->order->total_amount, 0, ',', '.')]))
            ->line(__('orders.notifications.created.credit', ['value' => number_format($this->order->credit_amount, 0, ',', '.')]))
            ->line(__('orders.notifications.created.status', ['value' => ucfirst($this->order->status)]))
            ->action(__('orders.notifications.created.action'), route('app.orders.show', $this->order->id))
            ->line(__('orders.notifications.created.thanks'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => $this->type->value,
            'category' => $this->type->getCategory(),
            'title' => __('orders.notifications.created.title'),
            'message' => __('orders.notifications.created.message', [
                'order_number' => $this->order->order_number,
                'product' => $this->order->product_name,
            ]),
            'url' => route('app.orders.show', $this->order->id),
            'data' => [
                'order_id' => $this->order->id,
                'order_number' => $this->order->order_number,
                'product_name' => $this->order->product_name,
                'total_amount' => $this->order->total_amount,
                'credit_amount' => $this->order->credit_amount,
                'status' => $this->order->status,
            ],
        ];
    }

    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        $icon = Storage::url(setting('main.logo'));
        $appName = setting('main.name', config('app.name'));
        
        return (new WebPushMessage)
            ->title(__('orders.notifications.created.title') . ' - ' . $appName)
            ->icon($icon)
            ->body(__('orders.notifications.created.message', [
                'order_number' => $this->order->order_number,
                'product' => $this->order->product_name,
            ]))
            ->action(__('orders.notifications.created.action'), route('app.orders.show', $this->order->id))
            ->badge($icon)
            ->vibrate([100, 50, 100])
            ->options([
                'TTL' => 86400,
                'urgency' => 'normal',
            ])
            ->data([
                'type' => $this->type->value,
                'url' => route('app.orders.show', $this->order->id),
                'order_id' => $this->order->id,
            ]);
    }
}

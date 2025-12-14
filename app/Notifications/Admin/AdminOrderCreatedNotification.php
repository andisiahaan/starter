<?php

namespace App\Notifications\Admin;

use App\Enums\NotificationType;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
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
        $appName = setting('main.name', config('app.name'));
        $amount = 'Rp ' . number_format($this->order->total_amount, 0, ',', '.');

        return (new MailMessage)
            ->subject("[{$appName}] " . __('admin.notifications.order_created.subject'))
            ->greeting(__('admin.notifications.order_created.greeting'))
            ->line(__('admin.notifications.order_created.line1'))
            ->line(__('admin.notifications.order_created.user', ['value' => $this->order->user?->name]))
            ->line(__('admin.notifications.order_created.product', ['value' => $this->order->product_name]))
            ->line(__('admin.notifications.order_created.amount', ['value' => $amount]))
            ->action(__('admin.notifications.order_created.action'), url("/admin/orders"));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => NotificationType::ADMIN_ORDER_CREATED->value,
            'title' => __('admin.notifications.order_created.title'),
            'message' => __('admin.notifications.order_created.message', [
                'user' => $this->order->user?->name,
                'product' => $this->order->product_name,
            ]),
            'order_id' => $this->order->id,
            'order_number' => $this->order->order_number,
            'total_amount' => $this->order->total_amount,
            'url' => url("/admin/orders"),
        ];
    }

    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        $amount = 'Rp ' . number_format($this->order->total_amount, 0, ',', '.');
        
        return (new WebPushMessage)
            ->title(__('admin.notifications.order_created.title'))
            ->body("#{$this->order->order_number} - {$amount}")
            ->icon(asset('favicon.ico'))
            ->action(__('admin.notifications.order_created.action'), url("/admin/orders"))
            ->data(['url' => url("/admin/orders")]);
    }
}

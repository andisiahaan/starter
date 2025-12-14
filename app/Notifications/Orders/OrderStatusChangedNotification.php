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
 * Notification sent when order status changes.
 */
class OrderStatusChangedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected NotificationType $type;

    public function __construct(
        public Order $order,
        public string $oldStatus,
        public string $newStatus
    ) {
        $this->type = $this->determineNotificationType($newStatus);
        $this->afterCommit();
    }

    protected function determineNotificationType(string $status): NotificationType
    {
        return match ($status) {
            'paid' => NotificationType::ORDER_PAID,
            'processing' => NotificationType::ORDER_PROCESSING,
            'completed' => NotificationType::ORDER_COMPLETED,
            'failed', 'cancelled' => NotificationType::ORDER_FAILED,
            'refunded' => NotificationType::ORDER_REFUNDED,
            default => NotificationType::ORDER_PROCESSING,
        };
    }

    protected function getStatusMessage(): string
    {
        $key = "orders.notifications.status_updated.statuses.{$this->newStatus}";
        $message = __($key);
        
        // If key not found, use default
        if ($message === $key) {
            return __('orders.notifications.status_updated.statuses.default', ['status' => $this->newStatus]);
        }
        
        return $message;
    }

    public function via(object $notifiable): array
    {
        return $notifiable->getNotificationViaChannels($this->type);
    }

    public function toMail(object $notifiable): MailMessage
    {
        $appName = setting('main.name', config('app.name'));
        
        return (new MailMessage)
            ->subject(__('orders.notifications.status_updated.subject', ['app' => $appName]))
            ->greeting(__('orders.notifications.status_updated.greeting', ['name' => $notifiable->name]))
            ->line(__('orders.notifications.status_updated.line1'))
            ->line(__('orders.notifications.status_updated.details_title'))
            ->line(__('orders.notifications.status_updated.order_id', ['value' => $this->order->order_number]))
            ->line(__('orders.notifications.status_updated.product', ['value' => $this->order->product_name]))
            ->line(__('orders.notifications.status_updated.previous_status', ['value' => ucfirst($this->oldStatus)]))
            ->line(__('orders.notifications.status_updated.new_status', ['value' => ucfirst($this->newStatus)]))
            ->line('')
            ->line($this->getStatusMessage())
            ->action(__('orders.notifications.status_updated.action'), route('app.orders.show', $this->order->id));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => $this->type->value,
            'category' => $this->type->getCategory(),
            'title' => __('orders.notifications.status_updated.title', ['status' => ucfirst($this->newStatus)]),
            'message' => $this->getStatusMessage(),
            'url' => route('app.orders.show', $this->order->id),
            'data' => [
                'order_id' => $this->order->id,
                'order_number' => $this->order->order_number,
                'product_name' => $this->order->product_name,
                'old_status' => $this->oldStatus,
                'new_status' => $this->newStatus,
            ],
        ];
    }

    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        $icon = Storage::url(setting('main.logo'));
        $urgency = in_array($this->newStatus, ['verified', 'completed', 'paid']) ? 'high' : 'normal';
        
        return (new WebPushMessage)
            ->title(__('orders.notifications.status_updated.title', ['status' => ucfirst($this->newStatus)]))
            ->icon($icon)
            ->body($this->getStatusMessage())
            ->action(__('orders.notifications.status_updated.action'), route('app.orders.show', $this->order->id))
            ->badge($icon)
            ->vibrate([100, 50, 100])
            ->options([
                'TTL' => 86400,
                'urgency' => $urgency,
            ])
            ->data([
                'type' => $this->type->value,
                'url' => route('app.orders.show', $this->order->id),
                'order_id' => $this->order->id,
                'status' => $this->newStatus,
            ]);
    }
}

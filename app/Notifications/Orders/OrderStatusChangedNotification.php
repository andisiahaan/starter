<?php

namespace App\Notifications\Orders;

use App\Enums\NotificationChannel;
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

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Order $order,
        public string $oldStatus,
        public string $newStatus
    ) {
        $this->type = $this->determineNotificationType($newStatus);
        $this->afterCommit();
    }

    /**
     * Determine notification type based on new status.
     */
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

    /**
     * Get status-specific message.
     */
    protected function getStatusMessage(): string
    {
        return match ($this->newStatus) {
            'verified' => '✅ Your order has been verified and credit will be added to your account.',
            'paid' => '✅ Your payment has been confirmed.',
            'processing' => '⏳ Your order is now being processed.',
            'completed' => '✅ Your order has been completed successfully!',
            'failed' => '❌ Your order has failed. Please contact support if you need assistance.',
            'cancelled' => '❌ Your order has been cancelled.',
            'refunded' => '💰 Your order has been refunded.',
            default => "Your order status has been updated to {$this->newStatus}.",
        };
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
        $mail = (new MailMessage)
            ->subject('Order Status Updated - ' . config('app.name'))
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your order status has been updated.')
            ->line('**Order Details:**')
            ->line('• Order ID: ' . $this->order->order_number)
            ->line('• Product: ' . $this->order->product_name)
            ->line('• Previous Status: ' . ucfirst($this->oldStatus))
            ->line('• New Status: ' . ucfirst($this->newStatus))
            ->line('')
            ->line($this->getStatusMessage())
            ->action('View Order', route('app.orders.show', $this->order->id));

        return $mail;
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
            'title' => 'Order Status Updated',
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

    /**
     * Get the web push representation of the notification.
     */
    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        $icon = Storage::url(setting('main.logo'));
        $urgency = in_array($this->newStatus, ['verified', 'completed', 'paid']) ? 'high' : 'normal';
        
        return (new WebPushMessage)
            ->title('Order Status: ' . ucfirst($this->newStatus))
            ->icon($icon)
            ->body($this->getStatusMessage())
            ->action('View Order', route('app.orders.show', $this->order->id))
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

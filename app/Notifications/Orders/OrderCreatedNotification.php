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
 * Notification sent when a new order is created.
 */
class OrderCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Send notification after database commit.
     */
    public $afterCommit = true;

    protected NotificationType $type;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Order $order
    ) {
        $this->type = NotificationType::ORDER_CREATED;
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
            ->subject('Order Created - ' . config('app.name'))
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Your order has been successfully created.')
            ->line('**Order Details:**')
            ->line('• Order ID: ' . $this->order->order_number)
            ->line('• Product: ' . $this->order->product_name)
            ->line('• Amount: Rp ' . number_format($this->order->total_amount, 0, ',', '.'))
            ->line('• Credit: ' . number_format($this->order->credit_amount, 0, ',', '.') . ' credits')
            ->line('• Status: ' . ucfirst($this->order->status))
            ->action('View Order', route('app.orders.show', $this->order->id))
            ->line('Thank you for your purchase!');
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
            'title' => 'Order Created',
            'message' => "Your order #{$this->order->order_number} for {$this->order->product_name} has been created.",
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

    /**
     * Get the web push representation of the notification.
     */
    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        $icon = Storage::url(setting('main.logo'));
        
        return (new WebPushMessage)
            ->title('Order Created - ' . config('app.name'))
            ->icon($icon)
            ->body("Order #{$this->order->order_number} created for {$this->order->product_name}")
            ->action('View Order', route('app.orders.show', $this->order->id))
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

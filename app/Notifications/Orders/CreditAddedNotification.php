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
 * Notification sent when credit is added to user account.
 */
class CreditAddedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected NotificationType $type;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Order $order,
        public float $creditAmount
    ) {
        $this->type = NotificationType::CREDIT_ADDED;
        $this->afterCommit();
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
        $newBalance = $notifiable->credit_balance ?? 0;
        
        return (new MailMessage)
            ->subject('💰 Credit Added to Your Account - ' . config('app.name'))
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Great news! Credit has been added to your account.')
            ->line('**Transaction Details:**')
            ->line('• Order ID: ' . $this->order->order_number)
            ->line('• Product: ' . $this->order->product_name)
            ->line('• Credit Added: ' . number_format($this->creditAmount, 0, ',', '.') . ' credits')
            ->line('• New Balance: ' . number_format($newBalance, 0, ',', '.') . ' credits')
            ->action('View Balance', route('app.credits.index'))
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
            'title' => '💰 Credit Added',
            'message' => number_format($this->creditAmount, 0, ',', '.') . " credits have been added to your account from order #{$this->order->order_number}.",
            'url' => route('app.credits.index'),
            'data' => [
                'order_id' => $this->order->id,
                'order_number' => $this->order->order_number,
                'product_name' => $this->order->product_name,
                'credit_amount' => $this->creditAmount,
                'new_balance' => $notifiable->credit_balance ?? 0,
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
            ->title('💰 Credit Added!')
            ->icon($icon)
            ->body(number_format($this->creditAmount, 0, ',', '.') . ' credits added from order #' . $this->order->order_number)
            ->action('View Balance', route('app.credits.index'))
            ->badge($icon)
            ->vibrate([200, 100, 200])
            ->options([
                'TTL' => 86400,
                'urgency' => 'high',
            ])
            ->data([
                'type' => $this->type->value,
                'url' => route('app.credits.index'),
                'order_id' => $this->order->id,
                'credit_amount' => $this->creditAmount,
            ]);
    }
}

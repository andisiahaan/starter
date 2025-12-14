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
 * Notification sent when credit is added to user account.
 */
class CreditAddedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected NotificationType $type;

    public function __construct(
        public Order $order,
        public float $creditAmount
    ) {
        $this->type = NotificationType::CREDIT_ADDED;
        $this->afterCommit();
    }

    public function via(object $notifiable): array
    {
        return $notifiable->getNotificationViaChannels($this->type);
    }

    public function toMail(object $notifiable): MailMessage
    {
        $appName = setting('main.name', config('app.name'));
        $newBalance = $notifiable->credit_balance ?? 0;
        
        return (new MailMessage)
            ->subject(__('orders.notifications.credit_added.subject', ['app' => $appName]))
            ->greeting(__('orders.notifications.credit_added.greeting', ['name' => $notifiable->name]))
            ->line(__('orders.notifications.credit_added.line1'))
            ->line(__('orders.notifications.credit_added.details_title'))
            ->line(__('orders.notifications.credit_added.order_id', ['value' => $this->order->order_number]))
            ->line(__('orders.notifications.credit_added.product', ['value' => $this->order->product_name]))
            ->line(__('orders.notifications.credit_added.credit_added', ['value' => number_format($this->creditAmount, 0, ',', '.')]))
            ->line(__('orders.notifications.credit_added.new_balance', ['value' => number_format($newBalance, 0, ',', '.')]))
            ->action(__('orders.notifications.credit_added.action'), route('app.credits.index'))
            ->line(__('orders.notifications.credit_added.thanks'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => $this->type->value,
            'category' => $this->type->getCategory(),
            'title' => __('orders.notifications.credit_added.title'),
            'message' => __('orders.notifications.credit_added.message', [
                'amount' => number_format($this->creditAmount, 0, ',', '.'),
                'order_number' => $this->order->order_number,
            ]),
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

    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        $icon = Storage::url(setting('main.logo'));
        
        return (new WebPushMessage)
            ->title(__('orders.notifications.credit_added.title'))
            ->icon($icon)
            ->body(__('orders.notifications.credit_added.message', [
                'amount' => number_format($this->creditAmount, 0, ',', '.'),
                'order_number' => $this->order->order_number,
            ]))
            ->action(__('orders.notifications.credit_added.action'), route('app.credits.index'))
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

<?php

namespace App\Notifications\Withdrawals;

use App\Models\Withdrawal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use NotificationChannels\WebPush\WebPushMessage;

/**
 * Notification sent to user when withdrawal is created.
 * This is a mandatory notification (not affected by user settings).
 */
class WithdrawalCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Withdrawal $withdrawal
    ) {
        $this->afterCommit();
    }

    /**
     * Always send via database and email (mandatory notification).
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $amount = number_format($this->withdrawal->amount, 0, ',', '.');

        return (new MailMessage)
            ->subject(__('notifications.withdrawal.created.subject', ['app' => setting('main.name', config('app.name'))]))
            ->greeting(__('notifications.withdrawal.created.greeting', ['name' => $notifiable->name]))
            ->line(__('notifications.withdrawal.created.line1'))
            ->line('**' . __('notifications.withdrawal.created.amount') . ':** Rp ' . $amount)
            ->line('**' . __('notifications.withdrawal.created.status') . ':** ' . ucfirst($this->withdrawal->status))
            ->line('**' . __('notifications.withdrawal.created.account') . ':** ' . $this->withdrawal->formatted_account_details)
            ->action(__('notifications.withdrawal.created.action'), route('app.referral.withdrawals'))
            ->line(__('notifications.withdrawal.created.line2'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'withdrawal.created',
            'category' => 'withdrawal',
            'title' => __('notifications.withdrawal.created.title'),
            'message' => __('notifications.withdrawal.created.message', [
                'amount' => 'Rp ' . number_format($this->withdrawal->amount, 0, ',', '.'),
            ]),
            'url' => route('app.referral.withdrawals'),
            'data' => [
                'withdrawal_id' => $this->withdrawal->id,
                'amount' => $this->withdrawal->amount,
                'status' => $this->withdrawal->status,
            ],
        ];
    }

    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        $icon = Storage::url(setting('main.logo'));
        $amount = number_format($this->withdrawal->amount, 0, ',', '.');

        return (new WebPushMessage)
            ->title(__('notifications.withdrawal.created.title'))
            ->icon($icon)
            ->body(__('notifications.withdrawal.created.message', ['amount' => 'Rp ' . $amount]))
            ->action(__('notifications.withdrawal.created.action'), route('app.referral.withdrawals'))
            ->badge($icon)
            ->vibrate([100, 50, 100])
            ->options([
                'TTL' => 86400,
                'urgency' => 'normal',
            ])
            ->data([
                'type' => 'withdrawal.created',
                'url' => route('app.referral.withdrawals'),
                'withdrawal_id' => $this->withdrawal->id,
            ]);
    }
}

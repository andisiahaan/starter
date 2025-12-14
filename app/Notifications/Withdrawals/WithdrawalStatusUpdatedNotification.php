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
 * Notification sent to user when withdrawal status is updated.
 */
class WithdrawalStatusUpdatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Withdrawal $withdrawal,
        public string $oldStatus
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
        $status = ucfirst($this->withdrawal->status);

        $mail = (new MailMessage)
            ->subject(__('notifications.withdrawal.status_updated.subject', ['app' => setting('main.name', config('app.name')), 'status' => $status]))
            ->greeting(__('notifications.withdrawal.status_updated.greeting', ['name' => $notifiable->name]))
            ->line(__('notifications.withdrawal.status_updated.line1', ['status' => $status]))
            ->line('**' . __('notifications.withdrawal.status_updated.amount') . ':** Rp ' . $amount)
            ->line('**' . __('notifications.withdrawal.status_updated.new_status') . ':** ' . $status);

        if ($this->withdrawal->status === 'completed') {
            $mail->line(__('notifications.withdrawal.status_updated.completed_message'));
        } elseif ($this->withdrawal->status === 'rejected') {
            $mail->line(__('notifications.withdrawal.status_updated.rejected_message'));
            if ($this->withdrawal->admin_notes) {
                $mail->line('**' . __('notifications.withdrawal.status_updated.reason') . ':** ' . $this->withdrawal->admin_notes);
            }
        }

        return $mail
            ->action(__('notifications.withdrawal.status_updated.action'), route('app.referral.withdrawals'))
            ->line(__('notifications.withdrawal.status_updated.line2'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => 'withdrawal.status_updated',
            'category' => 'withdrawal',
            'title' => __('notifications.withdrawal.status_updated.title'),
            'message' => __('notifications.withdrawal.status_updated.message', [
                'status' => ucfirst($this->withdrawal->status),
                'amount' => 'Rp ' . number_format($this->withdrawal->amount, 0, ',', '.'),
            ]),
            'url' => route('app.referral.withdrawals'),
            'data' => [
                'withdrawal_id' => $this->withdrawal->id,
                'amount' => $this->withdrawal->amount,
                'old_status' => $this->oldStatus,
                'new_status' => $this->withdrawal->status,
            ],
        ];
    }

    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        $icon = Storage::url(setting('main.logo'));
        $amount = number_format($this->withdrawal->amount, 0, ',', '.');

        return (new WebPushMessage)
            ->title(__('notifications.withdrawal.status_updated.title'))
            ->icon($icon)
            ->body(__('notifications.withdrawal.status_updated.message', [
                'status' => ucfirst($this->withdrawal->status),
                'amount' => 'Rp ' . $amount,
            ]))
            ->action(__('notifications.withdrawal.status_updated.action'), route('app.referral.withdrawals'))
            ->badge($icon)
            ->vibrate([100, 50, 100])
            ->options([
                'TTL' => 86400,
                'urgency' => 'normal',
            ])
            ->data([
                'type' => 'withdrawal.status_updated',
                'url' => route('app.referral.withdrawals'),
                'withdrawal_id' => $this->withdrawal->id,
            ]);
    }
}

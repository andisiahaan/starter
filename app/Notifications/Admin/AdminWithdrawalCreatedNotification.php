<?php

namespace App\Notifications\Admin;

use App\Enums\NotificationType;
use App\Models\Withdrawal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;

/**
 * Notification sent to admins when a new withdrawal is created.
 * This is a mandatory notification (not affected by individual settings).
 */
class AdminWithdrawalCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected Withdrawal $withdrawal
    ) {
        $this->afterCommit();
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $appName = setting('main.name', config('app.name'));
        $amount = 'Rp ' . number_format($this->withdrawal->amount, 0, ',', '.');
        $userName = $this->withdrawal->user?->name ?? 'Unknown';

        return (new MailMessage)
            ->subject("[{$appName}] " . __('admin.notifications.withdrawal_created.subject'))
            ->greeting(__('admin.notifications.withdrawal_created.greeting'))
            ->line(__('admin.notifications.withdrawal_created.line1'))
            ->line(__('admin.notifications.withdrawal_created.user', ['value' => $userName]))
            ->line(__('admin.notifications.withdrawal_created.amount', ['value' => $amount]))
            ->line(__('admin.notifications.withdrawal_created.account', ['value' => $this->withdrawal->formatted_account_details]))
            ->action(__('admin.notifications.withdrawal_created.action'), url('/admin/referral/withdrawals'))
            ->line(__('admin.notifications.withdrawal_created.line2'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => NotificationType::ADMIN_WITHDRAWAL_CREATED->value,
            'title' => __('admin.notifications.withdrawal_created.title'),
            'message' => __('admin.notifications.withdrawal_created.message', [
                'user' => $this->withdrawal->user?->name ?? 'Unknown',
                'amount' => 'Rp ' . number_format($this->withdrawal->amount, 0, ',', '.'),
            ]),
            'withdrawal_id' => $this->withdrawal->id,
            'user_id' => $this->withdrawal->user_id,
            'amount' => $this->withdrawal->amount,
            'url' => url('/admin/referral/withdrawals'),
        ];
    }

    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        $amount = 'Rp ' . number_format($this->withdrawal->amount, 0, ',', '.');
        $userName = $this->withdrawal->user?->name ?? 'Unknown';
        
        return (new WebPushMessage)
            ->title(__('admin.notifications.withdrawal_created.title'))
            ->body(__('admin.notifications.withdrawal_created.message', [
                'user' => $userName,
                'amount' => $amount,
            ]))
            ->icon(asset('favicon.ico'))
            ->action(__('common.actions.view'), url('/admin/referral/withdrawals'))
            ->data(['url' => url('/admin/referral/withdrawals')]);
    }
}

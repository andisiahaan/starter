<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Generic OTP notification for various verification purposes.
 * 
 * Usage:
 * $user->notify(new OtpNotification($otpCode, 'withdrawal'));
 * $user->notify(new OtpNotification($otpCode, 'transfer', ['amount' => 'Rp 100.000']));
 */
class OtpNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public string $otp,
        public string $purpose = 'verification',
        public array $context = []
    ) {
        $this->afterCommit();
    }

    /**
     * OTP should always be sent immediately via email.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $appName = setting('main.name', config('app.name'));
        $purposeLabel = $this->getPurposeLabel();

        $mail = (new MailMessage)
            ->subject(__('notifications.otp.subject', ['app' => $appName, 'purpose' => $purposeLabel]))
            ->greeting(__('notifications.otp.greeting', ['name' => $notifiable->name]))
            ->line(__('notifications.otp.line1', ['purpose' => strtolower($purposeLabel)]));

        // Add context-specific information
        foreach ($this->context as $key => $value) {
            $mail->line("**{$key}:** {$value}");
        }

        $mail->line('')
            ->line(__('notifications.otp.code_label'))
            ->line("# {$this->otp}")
            ->line('')
            ->line(__('notifications.otp.expiry'))
            ->line(__('notifications.otp.warning'));

        return $mail;
    }

    /**
     * Get human-readable purpose label.
     */
    protected function getPurposeLabel(): string
    {
        return match ($this->purpose) {
            'withdrawal' => __('notifications.otp.purposes.withdrawal'),
            'transfer' => __('notifications.otp.purposes.transfer'),
            'password_change' => __('notifications.otp.purposes.password_change'),
            'email_change' => __('notifications.otp.purposes.email_change'),
            'delete_account' => __('notifications.otp.purposes.delete_account'),
            default => __('notifications.otp.purposes.verification'),
        };
    }
}

<?php

namespace App\Notifications;

use App\Models\PendingEmailChange;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;

/**
 * Notification sent to verify email address change.
 * This notification is sent to the NEW email address for verification.
 */
class VerifyEmailChange extends Notification
{
    use Queueable;

    public function __construct(
        protected PendingEmailChange $pendingChange
    ) {}

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $verifyUrl = URL::signedRoute('email-change.verify', [
            'token' => $this->pendingChange->token,
        ]);

        return (new MailMessage)
            ->subject(__('Verify Email Change'))
            ->greeting(__('Hello!'))
            ->line(__('You have requested to change your email address to :email.', [
                'email' => $this->pendingChange->new_email,
            ]))
            ->action(__('Verify Email Address'), $verifyUrl)
            ->line(__('This link will expire in 24 hours.'))
            ->line(__('If you did not request this change, please ignore this email.'));
    }
}

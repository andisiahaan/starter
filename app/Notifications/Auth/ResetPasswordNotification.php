<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected string $token
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $appName = setting('main.name', config('app.name'));
        
        $resetUrl = url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->email,
        ], false));

        return (new MailMessage)
            ->subject(__('auth.notifications.reset_password.subject', ['app' => $appName]))
            ->greeting(__('auth.notifications.reset_password.greeting'))
            ->line(__('auth.notifications.reset_password.line1'))
            ->action(__('auth.notifications.reset_password.action'), $resetUrl)
            ->line(__('auth.notifications.reset_password.expire', ['count' => 60]))
            ->line(__('auth.notifications.reset_password.ignore'));
    }
}

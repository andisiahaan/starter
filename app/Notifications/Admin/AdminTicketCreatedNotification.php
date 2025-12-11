<?php

namespace App\Notifications\Admin;

use App\Enums\NotificationType;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class AdminTicketCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected Ticket $ticket
    ) {
        $this->afterCommit();
    }

    public function via(object $notifiable): array
    {
        return $notifiable->getNotificationViaChannels(NotificationType::ADMIN_TICKET_CREATED);
    }

    public function toMail(object $notifiable): MailMessage
    {
        $appName = config('app.name');

        return (new MailMessage)
            ->subject("[{$appName}] New Ticket: {$this->ticket->subject}")
            ->greeting('Hello Admin!')
            ->line("A new support ticket has been created.")
            ->line("**Subject:** {$this->ticket->subject}")
            ->line("**From:** {$this->ticket->user?->name}")
            ->line("**Priority:** " . ucfirst($this->ticket->priority))
            ->action('View Ticket', url("/admin/tickets/{$this->ticket->id}"))
            ->line('This notification was sent because you enabled Admin Alerts.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => NotificationType::ADMIN_TICKET_CREATED->value,
            'title' => 'New Ticket Created',
            'message' => $this->ticket->subject,
            'ticket_id' => $this->ticket->id,
            'subject' => $this->ticket->subject,
            'priority' => $this->ticket->priority,
            'url' => url("/admin/tickets/{$this->ticket->id}"),
        ];
    }

    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        return (new WebPushMessage)
            ->title('New Ticket: ' . $this->ticket->subject)
            ->body("From: {$this->ticket->user?->name}")
            ->icon(asset('favicon.ico'))
            ->action('View', url("/admin/tickets/{$this->ticket->id}"))
            ->data(['url' => url("/admin/tickets/{$this->ticket->id}")]);
    }
}

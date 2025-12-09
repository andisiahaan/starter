<?php

namespace App\Notifications\Tickets;

use App\Enums\NotificationChannel;
use App\Enums\NotificationType;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class TicketCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $afterCommit = true;

    protected NotificationType $type;

    public function __construct(
        protected Ticket $ticket
    ) {
        $this->type = NotificationType::TICKET_CREATED;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return $notifiable->getNotificationViaChannels($this->type);
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $appName = config('app.name');

        return (new MailMessage)
            ->subject("[{$this->ticket->ticket_number}] Ticket Created - {$appName}")
            ->greeting("Hello {$notifiable->name}!")
            ->line("Your support ticket has been created successfully.")
            ->line("**Ticket Number:** {$this->ticket->ticket_number}")
            ->line("**Subject:** {$this->ticket->subject}")
            ->line("**Category:** " . (Ticket::categories()[$this->ticket->category] ?? $this->ticket->category))
            ->line("**Priority:** " . (Ticket::priorities()[$this->ticket->priority] ?? $this->ticket->priority))
            ->action('View Ticket', url('/app/tickets/' . $this->ticket->id))
            ->line('Our team will respond to your ticket as soon as possible.');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => $this->type->value,
            'category' => $this->type->getCategory(),
            'title' => 'Ticket Created',
            'message' => "Your ticket #{$this->ticket->ticket_number} has been created.",
            'ticket_id' => $this->ticket->id,
            'ticket_number' => $this->ticket->ticket_number,
            'subject' => $this->ticket->subject,
            'url' => '/app/tickets/' . $this->ticket->id,
        ];
    }

    /**
     * Get the web push representation of the notification.
     */
    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        return (new WebPushMessage)
            ->title('Ticket Created')
            ->icon(Storage::url(setting('main.logo')))
            ->body("Your ticket #{$this->ticket->ticket_number} has been created successfully.")
            ->action('View Ticket', '/app/tickets/' . $this->ticket->id)
            ->options([
                'urgency' => 'normal',
                'TTL' => 86400,
            ]);
    }
}

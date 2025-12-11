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

class TicketClosedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected NotificationType $type;

    public function __construct(
        protected Ticket $ticket
    ) {
        $this->type = NotificationType::TICKET_CLOSED;
        $this->afterCommit();
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
            ->subject("[{$this->ticket->ticket_number}] Ticket Closed - {$appName}")
            ->greeting("Hello {$notifiable->name}!")
            ->line("Your support ticket has been closed.")
            ->line("**Ticket Number:** {$this->ticket->ticket_number}")
            ->line("**Subject:** {$this->ticket->subject}")
            ->line("**Status:** Closed")
            ->action('View Ticket', url('/app/tickets/' . $this->ticket->id))
            ->line('If you have any further questions, feel free to open a new ticket.');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => $this->type->value,
            'category' => $this->type->getCategory(),
            'title' => 'Ticket Closed',
            'message' => "Your ticket #{$this->ticket->ticket_number} has been closed.",
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
            ->title('Ticket Closed')
            ->icon(Storage::url(setting('main.logo')))
            ->body("Ticket #{$this->ticket->ticket_number} has been closed.")
            ->action('View Ticket', '/app/tickets/' . $this->ticket->id)
            ->options([
                'urgency' => 'normal',
                'TTL' => 86400,
            ]);
    }
}

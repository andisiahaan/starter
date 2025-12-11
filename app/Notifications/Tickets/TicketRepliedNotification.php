<?php

namespace App\Notifications\Tickets;

use App\Enums\NotificationChannel;
use App\Enums\NotificationType;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use NotificationChannels\WebPush\WebPushChannel;
use NotificationChannels\WebPush\WebPushMessage;

class TicketRepliedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected NotificationType $type;

    public function __construct(
        protected Ticket $ticket,
        protected TicketReply $reply
    ) {
        $this->type = NotificationType::TICKET_REPLIED;
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
        $preview = Str::limit(strip_tags($this->reply->content), 150);

        return (new MailMessage)
            ->subject("[{$this->ticket->ticket_number}] New Reply - {$appName}")
            ->greeting("Hello {$notifiable->name}!")
            ->line("You have received a new reply on your support ticket.")
            ->line("**Ticket:** {$this->ticket->ticket_number}")
            ->line("**Subject:** {$this->ticket->subject}")
            ->line("---")
            ->line("**Reply:**")
            ->line($preview)
            ->action('View Full Reply', url('/app/tickets/' . $this->ticket->id))
            ->line('Thank you for using our support system.');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'type' => $this->type->value,
            'category' => $this->type->getCategory(),
            'title' => 'New Ticket Reply',
            'message' => "Staff replied to ticket #{$this->ticket->ticket_number}",
            'ticket_id' => $this->ticket->id,
            'ticket_number' => $this->ticket->ticket_number,
            'reply_id' => $this->reply->id,
            'reply_preview' => Str::limit(strip_tags($this->reply->content), 100),
            'url' => '/app/tickets/' . $this->ticket->id,
        ];
    }

    /**
     * Get the web push representation of the notification.
     */
    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        return (new WebPushMessage)
            ->title("Reply on #{$this->ticket->ticket_number}")
            ->icon(Storage::url(setting('main.logo')))
            ->body(Str::limit(strip_tags($this->reply->content), 100))
            ->action('View Reply', '/app/tickets/' . $this->ticket->id)
            ->options([
                'urgency' => 'high',
                'TTL' => 86400,
            ]);
    }
}

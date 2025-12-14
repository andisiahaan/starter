<?php

namespace App\Notifications\Tickets;

use App\Enums\NotificationType;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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

    public function via(object $notifiable): array
    {
        return $notifiable->getNotificationViaChannels($this->type);
    }

    public function toMail(object $notifiable): MailMessage
    {
        $appName = setting('main.name', config('app.name'));
        $preview = Str::limit(strip_tags($this->reply->content), 150);

        return (new MailMessage)
            ->subject(__('tickets.notifications.replied.subject', ['app' => $appName, 'ticket_id' => $this->ticket->ticket_number]))
            ->greeting(__('tickets.notifications.replied.greeting', ['name' => $notifiable->name]))
            ->line(__('tickets.notifications.replied.line1'))
            ->line(__('tickets.notifications.replied.ticket_id', ['value' => $this->ticket->ticket_number]))
            ->line($preview)
            ->action(__('tickets.notifications.replied.action'), url('/app/tickets/' . $this->ticket->id));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => $this->type->value,
            'category' => $this->type->getCategory(),
            'title' => __('tickets.notifications.replied.title'),
            'message' => __('tickets.notifications.replied.message', ['ticket_id' => $this->ticket->ticket_number]),
            'ticket_id' => $this->ticket->id,
            'ticket_number' => $this->ticket->ticket_number,
            'reply_id' => $this->reply->id,
            'reply_preview' => Str::limit(strip_tags($this->reply->content), 100),
            'url' => '/app/tickets/' . $this->ticket->id,
        ];
    }

    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        return (new WebPushMessage)
            ->title(__('tickets.notifications.replied.title'))
            ->icon(Storage::url(setting('main.logo')))
            ->body(__('tickets.notifications.replied.message', ['ticket_id' => $this->ticket->ticket_number]))
            ->action(__('tickets.notifications.replied.action'), '/app/tickets/' . $this->ticket->id)
            ->options([
                'urgency' => 'high',
                'TTL' => 86400,
            ]);
    }
}

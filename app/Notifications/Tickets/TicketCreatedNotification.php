<?php

namespace App\Notifications\Tickets;

use App\Enums\NotificationType;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use NotificationChannels\WebPush\WebPushMessage;

class TicketCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected NotificationType $type;

    public function __construct(
        protected Ticket $ticket
    ) {
        $this->type = NotificationType::TICKET_CREATED;
        $this->afterCommit();
    }

    public function via(object $notifiable): array
    {
        return $notifiable->getNotificationViaChannels($this->type);
    }

    public function toMail(object $notifiable): MailMessage
    {
        $appName = setting('main.name', config('app.name'));

        return (new MailMessage)
            ->subject(__('tickets.notifications.created.subject', ['app' => $appName, 'ticket_id' => $this->ticket->ticket_number]))
            ->greeting(__('tickets.notifications.created.greeting', ['name' => $notifiable->name]))
            ->line(__('tickets.notifications.created.line1'))
            ->line(__('tickets.notifications.created.ticket_id', ['value' => $this->ticket->ticket_number]))
            ->line(__('tickets.notifications.created.subject_label', ['value' => $this->ticket->subject]))
            ->line(__('tickets.notifications.created.priority', ['value' => __('tickets.priority.' . $this->ticket->priority)]))
            ->action(__('tickets.notifications.created.action'), url('/app/tickets/' . $this->ticket->id))
            ->line(__('tickets.notifications.created.line2'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => $this->type->value,
            'category' => $this->type->getCategory(),
            'title' => __('tickets.notifications.created.title'),
            'message' => __('tickets.notifications.created.message', ['ticket_id' => $this->ticket->ticket_number]),
            'ticket_id' => $this->ticket->id,
            'ticket_number' => $this->ticket->ticket_number,
            'subject' => $this->ticket->subject,
            'url' => '/app/tickets/' . $this->ticket->id,
        ];
    }

    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        return (new WebPushMessage)
            ->title(__('tickets.notifications.created.title'))
            ->icon(Storage::url(setting('main.logo')))
            ->body(__('tickets.notifications.created.message', ['ticket_id' => $this->ticket->ticket_number]))
            ->action(__('tickets.notifications.created.action'), '/app/tickets/' . $this->ticket->id)
            ->options([
                'urgency' => 'normal',
                'TTL' => 86400,
            ]);
    }
}

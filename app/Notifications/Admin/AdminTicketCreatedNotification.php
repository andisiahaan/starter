<?php

namespace App\Notifications\Admin;

use App\Enums\NotificationType;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
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
        $appName = setting('main.name', config('app.name'));

        return (new MailMessage)
            ->subject("[{$appName}] " . __('admin.notifications.ticket_created.subject'))
            ->greeting(__('admin.notifications.ticket_created.greeting'))
            ->line(__('admin.notifications.ticket_created.line1'))
            ->line(__('admin.notifications.ticket_created.user', ['value' => $this->ticket->user?->name]))
            ->line(__('admin.notifications.ticket_created.subject_label', ['value' => $this->ticket->subject]))
            ->line(__('admin.notifications.ticket_created.priority', ['value' => ucfirst($this->ticket->priority)]))
            ->action(__('admin.notifications.ticket_created.action'), url("/admin/tickets/{$this->ticket->id}"));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => NotificationType::ADMIN_TICKET_CREATED->value,
            'title' => __('admin.notifications.ticket_created.title'),
            'message' => __('admin.notifications.ticket_created.message', [
                'user' => $this->ticket->user?->name,
                'subject' => $this->ticket->subject,
            ]),
            'ticket_id' => $this->ticket->id,
            'subject' => $this->ticket->subject,
            'priority' => $this->ticket->priority,
            'url' => url("/admin/tickets/{$this->ticket->id}"),
        ];
    }

    public function toWebPush(object $notifiable, $notification): WebPushMessage
    {
        return (new WebPushMessage)
            ->title(__('admin.notifications.ticket_created.title'))
            ->body($this->ticket->subject)
            ->icon(asset('favicon.ico'))
            ->action(__('admin.notifications.ticket_created.action'), url("/admin/tickets/{$this->ticket->id}"))
            ->data(['url' => url("/admin/tickets/{$this->ticket->id}")]);
    }
}

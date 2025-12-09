<?php

namespace App\Observers;

use App\Enums\NotificationType;
use App\Models\Ticket;
use App\Notifications\Admin\AdminTicketCreatedNotification;
use App\Notifications\Tickets\TicketCreatedNotification;
use App\Notifications\Tickets\TicketClosedNotification;
use App\Support\NotificationHelper;
use Illuminate\Support\Facades\Log;

class TicketObserver
{
    /**
     * Handle the Ticket "created" event.
     */
    public function created(Ticket $ticket): void
    {
        // Send notification to user who created the ticket
        if ($ticket->user) {
            NotificationHelper::sendAsync(
                $ticket->user,
                new TicketCreatedNotification($ticket)
            );
        }
        
        // Notify admins about new ticket
        NotificationHelper::sendToAdmins(
            new AdminTicketCreatedNotification($ticket),
            NotificationType::ADMIN_TICKET_CREATED->value
        );
    }

    /**
     * Handle the Ticket "updated" event.
     */
    public function updated(Ticket $ticket): void
    {
        // Check if status changed to closed
        if ($ticket->isDirty('status') && $ticket->status === 'closed') {
            $this->handleTicketClosed($ticket);
        }
    }

    /**
     * Handle ticket closed event.
     */
    protected function handleTicketClosed(Ticket $ticket): void
    {
        // Notify ticket owner
        if ($ticket->user) {
            NotificationHelper::sendAsync(
                $ticket->user,
                new TicketClosedNotification($ticket)
            );
        }
    }
}

<?php

namespace App\Observers;

use App\Models\Ticket;
use App\Models\TicketReply;
use App\Notifications\Tickets\TicketRepliedNotification;
use App\Support\NotificationHelper;
use Illuminate\Support\Facades\Log;

class TicketReplyObserver
{
    /**
     * Handle the TicketReply "created" event.
     */
    public function created(TicketReply $reply): void
    {
        $ticket = $reply->ticket;
        
        if (!$ticket) {
            return;
        }

        // Only notify if staff replied (not the user themselves)
        if ($reply->user_id !== $ticket->user_id) {
            // Notify ticket owner about the reply
            if ($ticket->user) {
                NotificationHelper::sendAsync(
                    $ticket->user,
                    new TicketRepliedNotification($ticket, $reply)
                );
            }
        }
    }
}

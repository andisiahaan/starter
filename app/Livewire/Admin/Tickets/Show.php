<?php

namespace App\Livewire\Admin\Tickets;

use App\Helpers\Toast;
use App\Models\Ticket;
use App\Models\TicketReply;
use Livewire\Component;

class Show extends Component
{
    public Ticket $ticket;
    public string $replyMessage = '';

    public function mount(Ticket $ticket)
    {
        $this->ticket = $ticket->load(['user', 'assignee', 'replies.user']);
    }

    public function sendReply()
    {
        $this->validate([
            'replyMessage' => 'required|string|min:1',
        ]);

        $this->ticket->replies()->create([
            'user_id' => auth()->id(),
            'message' => $this->replyMessage,
            'is_staff_reply' => true,
        ]);

        // Update status to waiting if was open
        if ($this->ticket->status === 'open') {
            $this->ticket->update(['status' => 'waiting']);
        }

        $this->replyMessage = '';
        $this->ticket->refresh();
        $this->ticket->load('replies.user');

        Toast::success('Reply sent.');
    }

    public function updateStatus(string $status)
    {
        $data = ['status' => $status];
        if (in_array($status, ['resolved', 'closed'])) {
            $data['closed_at'] = now();
        }
        $this->ticket->update($data);
        Toast::success('Status updated.');
    }

    public function render()
    {
        return view('admin.livewire.tickets.show', [
            'statuses' => Ticket::statuses(),
            'priorities' => Ticket::priorities(),
        ])->layout('admin.layouts.app', ['title' => 'Ticket: ' . $this->ticket->ticket_number]);
    }
}

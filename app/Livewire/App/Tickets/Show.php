<?php

namespace App\Livewire\App\Tickets;

use App\Helpers\Toast;
use App\Models\Ticket;
use Livewire\Component;

class Show extends Component
{
    public Ticket $ticket;
    public string $replyMessage = '';

    public function mount(Ticket $ticket)
    {
        // Ensure user owns this ticket
        if ($ticket->user_id !== auth()->id()) {
            abort(403);
        }
        $this->ticket = $ticket->load(['replies.user']);
    }

    public function sendReply()
    {
        $this->validate([
            'replyMessage' => 'required|string|min:1',
        ]);

        $this->ticket->replies()->create([
            'user_id' => auth()->id(),
            'message' => $this->replyMessage,
            'is_staff_reply' => false,
        ]);

        // Update ticket status if was waiting
        if ($this->ticket->status === 'waiting') {
            $this->ticket->update(['status' => 'open']);
        }

        $this->replyMessage = '';
        $this->ticket->refresh();
        $this->ticket->load('replies.user');

        Toast::success('Reply sent.');
    }

    public function render()
    {
        return view('livewire.app.tickets.show', [
            'statuses' => Ticket::statuses(),
        ])->layout('layouts.app', ['title' => 'Ticket: ' . $this->ticket->ticket_number]);
    }
}

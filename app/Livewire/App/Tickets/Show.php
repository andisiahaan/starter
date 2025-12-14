<?php

namespace App\Livewire\App\Tickets;

use App\Helpers\Toast;
use App\Models\Ticket;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Show extends Component
{
    use WithFileUploads;

    public Ticket $ticket;
    public string $replyMessage = '';
    public array $replyAttachments = [];

    public function mount(Ticket $ticket)
    {
        Gate::authorize('view', $ticket);
        $this->ticket = $ticket->load(['replies.user', 'media']);
    }

    public function updatedReplyAttachments()
    {
        $this->validate([
            'replyAttachments.*' => 'file|max:5120|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,txt',
        ]);
    }

    public function removeReplyAttachment($index)
    {
        unset($this->replyAttachments[$index]);
        $this->replyAttachments = array_values($this->replyAttachments);
    }

    public function sendReply()
    {
        $this->validate([
            'replyMessage' => 'required|string|min:1',
            'replyAttachments' => 'array|max:5',
            'replyAttachments.*' => 'file|max:5120|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,txt',
        ]);

        $reply = $this->ticket->replies()->create([
            'user_id' => auth()->id(),
            'message' => $this->replyMessage,
            'is_staff_reply' => false,
        ]);

        // Handle attachments
        foreach ($this->replyAttachments as $attachment) {
            $reply->addMedia($attachment->getRealPath())
                ->usingFileName($attachment->getClientOriginalName())
                ->toMediaCollection('attachments');
        }

        // Update ticket status if was waiting
        if ($this->ticket->status === 'waiting') {
            $this->ticket->update(['status' => 'open']);
        }

        $this->replyMessage = '';
        $this->replyAttachments = [];
        $this->ticket->refresh();
        $this->ticket->load(['replies.user', 'replies.media', 'media']);

        Toast::success('Reply sent.');
    }

    public function render()
    {
        return view('livewire.app.tickets.show', [
            'statuses' => Ticket::statuses(),
        ])->layout('layouts.app', ['title' => 'Ticket: ' . $this->ticket->ticket_number]);
    }
}


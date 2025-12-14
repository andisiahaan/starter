<?php

namespace App\Livewire\Admin\Tickets;

use App\Helpers\Toast;
use App\Models\Ticket;
use App\Models\TicketReply;
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
        $this->ticket = $ticket->load(['user', 'assignee', 'replies.user', 'replies.media', 'media']);
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
            'is_staff_reply' => true,
        ]);

        // Handle attachments
        foreach ($this->replyAttachments as $attachment) {
            $reply->addMedia($attachment->getRealPath())
                ->usingFileName($attachment->getClientOriginalName())
                ->toMediaCollection('attachments');
        }

        // Update status to waiting if was open
        if ($this->ticket->status === 'open') {
            $this->ticket->update(['status' => 'waiting']);
        }

        $this->replyMessage = '';
        $this->replyAttachments = [];
        $this->ticket->refresh();
        $this->ticket->load(['replies.user', 'replies.media', 'media']);

        // Send notification to user
        if ($this->ticket->user) {
            $this->ticket->user->notify(new \App\Notifications\Tickets\TicketRepliedNotification($this->ticket, $reply));
        }

        Toast::success('Reply sent.');
    }

    public function updateStatus(string $status)
    {
        $data = ['status' => $status];
        if (in_array($status, ['resolved', 'closed'])) {
            $data['closed_at'] = now();
        }
        $this->ticket->update($data);

        // Notify user about ticket closure
        if (in_array($status, ['resolved', 'closed']) && $this->ticket->user) {
            $this->ticket->user->notify(new \App\Notifications\Tickets\TicketClosedNotification($this->ticket));
        }

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

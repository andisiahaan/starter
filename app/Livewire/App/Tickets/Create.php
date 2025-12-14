<?php

namespace App\Livewire\App\Tickets;

use App\Helpers\Alert;
use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public string $subject = '';
    public string $description = '';
    public string $category = 'general';
    public string $priority = 'medium';
    public array $attachments = [];

    public function updatedAttachments()
    {
        $this->validate([
            'attachments.*' => 'file|max:5120|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,txt',
        ]);
    }

    public function removeAttachment($index)
    {
        unset($this->attachments[$index]);
        $this->attachments = array_values($this->attachments);
    }

    public function submit()
    {
        $this->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'category' => 'required|in:general,billing,technical,bug',
            'priority' => 'required|in:low,medium,high,urgent',
            'attachments' => 'array|max:5',
            'attachments.*' => 'file|max:5120|mimes:jpg,jpeg,png,gif,webp,pdf,doc,docx,txt',
        ]);

        $ticket = Ticket::create([
            'user_id' => auth()->id(),
            'subject' => $this->subject,
            'description' => $this->description,
            'category' => $this->category,
            'priority' => $this->priority,
        ]);

        // Handle attachments
        foreach ($this->attachments as $attachment) {
            $ticket->addMedia($attachment->getRealPath())
                ->usingFileName($attachment->getClientOriginalName())
                ->toMediaCollection('attachments');
        }

        Alert::success('Ticket submitted successfully.');
        return redirect()->route('app.tickets.show', $ticket);
    }

    public function render()
    {
        return view('livewire.app.tickets.create', [
            'categories' => Ticket::categories(),
            'priorities' => Ticket::priorities(),
        ])->layout('layouts.app', ['title' => 'Create Ticket']);
    }
}


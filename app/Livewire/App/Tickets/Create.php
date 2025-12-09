<?php

namespace App\Livewire\App\Tickets;

use App\Helpers\Alert;
use App\Models\Ticket;
use Livewire\Component;

class Create extends Component
{
    public string $subject = '';
    public string $description = '';
    public string $category = 'general';
    public string $priority = 'medium';

    public function submit()
    {
        $this->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'category' => 'required|in:general,billing,technical,bug',
            'priority' => 'required|in:low,medium,high,urgent',
        ]);

        $ticket = Ticket::create([
            'user_id' => auth()->id(),
            'subject' => $this->subject,
            'description' => $this->description,
            'category' => $this->category,
            'priority' => $this->priority,
        ]);

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

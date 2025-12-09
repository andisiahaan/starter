<?php

namespace App\Livewire\App\Tickets;

use App\Models\Ticket;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $statusFilter = '';

    protected $queryString = ['statusFilter'];

    public function render()
    {
        $tickets = Ticket::where('user_id', auth()->id())
            ->when($this->statusFilter, fn($q) => $q->where('status', $this->statusFilter))
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('livewire.app.tickets.index', [
            'tickets' => $tickets,
            'statuses' => Ticket::statuses(),
        ])->layout('layouts.app', ['title' => 'My Tickets']);
    }
}

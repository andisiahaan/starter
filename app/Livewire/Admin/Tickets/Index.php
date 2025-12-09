<?php

namespace App\Livewire\Admin\Tickets;

use App\Helpers\Toast;
use App\Models\Ticket;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';
    public string $priorityFilter = '';

    protected $queryString = ['search', 'statusFilter', 'priorityFilter'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updateStatus(int $ticketId, string $status)
    {
        $ticket = Ticket::findOrFail($ticketId);
        $data = ['status' => $status];

        if (in_array($status, ['resolved', 'closed'])) {
            $data['closed_at'] = now();
        } else {
            $data['closed_at'] = null;
        }

        $ticket->update($data);
        Toast::success('Ticket status updated.');
    }

    public function assignToMe(int $ticketId)
    {
        Ticket::findOrFail($ticketId)->update([
            'assigned_to' => auth()->id(),
            'status' => 'in_progress',
        ]);
        Toast::success('Ticket assigned to you.');
    }

    public function render()
    {
        $tickets = Ticket::with(['user', 'assignee'])
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('ticket_number', 'like', '%' . $this->search . '%')
                        ->orWhere('subject', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter, fn($q) => $q->where('status', $this->statusFilter))
            ->when($this->priorityFilter, fn($q) => $q->where('priority', $this->priorityFilter))
            ->orderByRaw("FIELD(priority, 'urgent', 'high', 'medium', 'low')")
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.livewire.tickets.index', [
            'tickets' => $tickets,
            'statuses' => Ticket::statuses(),
            'priorities' => Ticket::priorities(),
        ])->layout('admin.layouts.app', ['title' => 'Support Tickets']);
    }
}

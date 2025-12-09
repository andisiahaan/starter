<div>
    <div class="max-w-4xl mx-auto">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-white">My Tickets</h1>
                <p class="mt-1 text-sm text-slate-400">View and manage your support requests</p>
            </div>
            <a href="{{ route('app.tickets.create') }}" class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                New Ticket
            </a>
        </div>

        <div class="mt-6">
            <select wire:model.live="statusFilter" class="rounded-md border-dark-border bg-dark-elevated text-white text-sm py-2 px-3">
                <option value="">All Status</option>
                @foreach($statuses as $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-6 space-y-4">
            @forelse($tickets as $ticket)
            <a href="{{ route('app.tickets.show', $ticket) }}" class="block bg-dark-elevated rounded-lg border border-dark-border p-4 hover:border-primary-500/50 transition">
                <div class="flex items-start justify-between">
                    <div class="flex-1 min-w-0">
                        <h3 class="text-white font-medium truncate">{{ $ticket->subject }}</h3>
                        <p class="text-sm text-slate-500 mt-1">{{ $ticket->ticket_number }} · {{ $ticket->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="flex items-center gap-2 ml-4">
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                            @if($ticket->priority === 'urgent') bg-red-900/30 text-red-400
                            @elseif($ticket->priority === 'high') bg-orange-900/30 text-orange-400
                            @else bg-slate-700 text-slate-300
                            @endif">
                            {{ $ticket->priority }}
                        </span>
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                            @if(in_array($ticket->status, ['open', 'in_progress'])) bg-green-900/30 text-green-400
                            @elseif($ticket->status === 'waiting') bg-yellow-900/30 text-yellow-400
                            @else bg-slate-700 text-slate-300
                            @endif">
                            {{ $statuses[$ticket->status] }}
                        </span>
                    </div>
                </div>
                <p class="text-sm text-slate-400 mt-2 line-clamp-2">{{ Str::limit($ticket->description, 120) }}</p>
            </a>
            @empty
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-white">No tickets</h3>
                <p class="mt-1 text-sm text-slate-400">Create a new ticket to get support.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-6">{{ $tickets->links() }}</div>
    </div>
</div>
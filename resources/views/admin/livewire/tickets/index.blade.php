<div>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-slate-900 dark:text-white">Support Tickets</h1>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Manage customer support tickets and inquiries.</p>
        </div>
    </div>

    <div class="mt-4 flex flex-col sm:flex-row gap-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search ticket # or subject..." class="block w-full sm:w-64 rounded-md border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm">
        <select wire:model.live="statusFilter" class="block w-full sm:w-40 rounded-md border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm">
            <option value="">All Status</option>
            @foreach($statuses as $key => $label)
            <option value="{{ $key }}">{{ $label }}</option>
            @endforeach
        </select>
        <select wire:model.live="priorityFilter" class="block w-full sm:w-40 rounded-md border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm">
            <option value="">All Priority</option>
            @foreach($priorities as $key => $label)
            <option value="{{ $key }}">{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-6 overflow-hidden shadow ring-1 ring-slate-200 dark:ring-dark-border md:rounded-lg">
        <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
            <thead class="bg-slate-50 dark:bg-dark-soft">
                <tr>
                    <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 dark:text-white sm:pl-6">Ticket</th>
                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">User</th>
                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">Priority</th>
                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">Status</th>
                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">Assigned</th>
                    <th class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-dark-border bg-white dark:bg-dark-base">
                @forelse($tickets as $ticket)
                <tr class="hover:bg-slate-50 dark:hover:bg-dark-elevated transition-colors">
                    <td class="py-4 pl-4 pr-3 sm:pl-6">
                        <div>
                            <a href="{{ route('admin.tickets.show', $ticket) }}" class="font-medium text-slate-900 dark:text-white hover:text-primary-600 dark:hover:text-primary-400">{{ $ticket->subject }}</a>
                            <p class="text-xs text-slate-500 dark:text-slate-500">{{ $ticket->ticket_number }} · {{ $ticket->created_at->diffForHumans() }}</p>
                        </div>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-600 dark:text-slate-300">{{ $ticket->user?->name ?? 'Guest' }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                            @if($ticket->priority === 'urgent') bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400
                            @elseif($ticket->priority === 'high') bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400
                            @elseif($ticket->priority === 'medium') bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400
                            @else bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300
                            @endif">
                            {{ $priorities[$ticket->priority] }}
                        </span>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                        <select wire:change="updateStatus({{ $ticket->id }}, $event.target.value)" class="text-xs rounded border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white py-1 px-2">
                            @foreach($statuses as $key => $label)
                            <option value="{{ $key }}" {{ $ticket->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-600 dark:text-slate-300">
                        @if($ticket->assignee)
                        {{ $ticket->assignee->name }}
                        @else
                        <button wire:click="assignToMe({{ $ticket->id }})" class="text-primary-600 dark:text-primary-400 hover:underline text-xs">Assign to me</button>
                        @endif
                    </td>
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                        <a href="{{ route('admin.tickets.show', $ticket) }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-500 dark:text-slate-400">No tickets found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $tickets->links() }}</div>
</div>
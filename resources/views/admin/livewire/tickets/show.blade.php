<div>
    <div class="mb-6">
        <a href="{{ route('admin.tickets.index') }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300 text-sm flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            Back to Tickets
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Ticket Info -->
            <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <h1 class="text-xl font-semibold text-slate-900 dark:text-white">{{ $ticket->subject }}</h1>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ $ticket->ticket_number }} · Created {{ $ticket->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium
                        @if($ticket->priority === 'urgent') bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400
                        @elseif($ticket->priority === 'high') bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400
                        @elseif($ticket->priority === 'medium') bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400
                        @else bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300
                        @endif">
                        {{ $priorities[$ticket->priority] }} Priority
                    </span>
                </div>
                <div class="mt-4 prose prose-slate dark:prose-invert max-w-none">
                    <p class="text-slate-700 dark:text-slate-300 whitespace-pre-wrap">{{ $ticket->description }}</p>
                </div>
            </div>

            <!-- Replies -->
            <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border p-6">
                <h2 class="text-lg font-medium text-slate-900 dark:text-white mb-4">Conversation</h2>
                <div class="space-y-4">
                    @foreach($ticket->replies as $reply)
                    <div class="flex gap-3 {{ $reply->is_staff_reply ? 'flex-row-reverse' : '' }}">
                        <div class="flex-shrink-0 h-8 w-8 rounded-full flex items-center justify-center {{ $reply->is_staff_reply ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400' : 'bg-slate-200 dark:bg-slate-700 text-slate-600 dark:text-slate-300' }}">
                            {{ strtoupper(substr($reply->user?->name ?? 'U', 0, 1)) }}
                        </div>
                        <div class="flex-1 max-w-[80%] {{ $reply->is_staff_reply ? 'text-right' : '' }}">
                            <div class="inline-block rounded-lg px-4 py-2 {{ $reply->is_staff_reply ? 'bg-primary-100 dark:bg-primary-900/30 text-slate-900 dark:text-white' : 'bg-slate-100 dark:bg-dark-soft text-slate-700 dark:text-slate-300' }}">
                                <p class="text-sm whitespace-pre-wrap">{{ $reply->message }}</p>
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-500 mt-1">{{ $reply->user?->name ?? 'Unknown' }} · {{ $reply->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Reply Form -->
                @if($ticket->status !== 'closed')
                <form wire:submit="sendReply" class="mt-6 pt-4 border-t border-slate-200 dark:border-dark-border">
                    <textarea wire:model="replyMessage" rows="3" placeholder="Type your reply..." class="block w-full rounded-md border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm"></textarea>
                    @error('replyMessage')<span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span>@enderror
                    <div class="mt-3 flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700">Send Reply</button>
                    </div>
                </form>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border p-6">
                <h3 class="text-sm font-medium text-slate-900 dark:text-white mb-4">Ticket Details</h3>
                <dl class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Status</dt>
                        <dd>
                            <select wire:change="updateStatus($event.target.value)" class="text-xs rounded border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white py-1 px-2">
                                @foreach($statuses as $key => $label)
                                <option value="{{ $key }}" {{ $ticket->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Category</dt>
                        <dd class="text-slate-900 dark:text-white capitalize">{{ $ticket->category }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">User</dt>
                        <dd class="text-slate-900 dark:text-white">{{ $ticket->user?->name ?? 'Guest' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Email</dt>
                        <dd class="text-slate-900 dark:text-white">{{ $ticket->user?->email ?? '-' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">Assigned To</dt>
                        <dd class="text-slate-900 dark:text-white">{{ $ticket->assignee?->name ?? 'Unassigned' }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
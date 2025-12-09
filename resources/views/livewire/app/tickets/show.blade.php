<div>
    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('app.tickets.index') }}" class="text-primary-400 hover:text-primary-300 text-sm flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Tickets
            </a>
        </div>

        @if(session('message'))
        <div class="mb-4 p-4 rounded-lg bg-green-900/30 border border-green-700/50 text-green-400">{{ session('message') }}</div>
        @endif

        <!-- Ticket Info -->
        <div class="bg-dark-elevated rounded-lg border border-dark-border p-6 mb-6">
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-xl font-semibold text-white">{{ $ticket->subject }}</h1>
                    <p class="text-sm text-slate-400 mt-1">{{ $ticket->ticket_number }} · Created {{ $ticket->created_at->format('M d, Y') }}</p>
                </div>
                <span class="inline-flex items-center rounded-full px-3 py-1 text-sm font-medium
                    @if(in_array($ticket->status, ['open', 'in_progress'])) bg-green-900/30 text-green-400
                    @elseif($ticket->status === 'waiting') bg-yellow-900/30 text-yellow-400
                    @elseif($ticket->status === 'resolved') bg-blue-900/30 text-blue-400
                    @else bg-slate-700 text-slate-300
                    @endif">
                    {{ $statuses[$ticket->status] }}
                </span>
            </div>
            <div class="mt-4 p-4 bg-dark-soft rounded-lg">
                <p class="text-slate-300 whitespace-pre-wrap">{{ $ticket->description }}</p>
            </div>
        </div>

        <!-- Conversation -->
        <div class="bg-dark-elevated rounded-lg border border-dark-border p-6">
            <h2 class="text-lg font-medium text-white mb-4">Conversation</h2>

            @if($ticket->replies->isEmpty())
            <p class="text-slate-400 text-sm text-center py-6">Waiting for staff response...</p>
            @else
            <div class="space-y-4 mb-6">
                @foreach($ticket->replies as $reply)
                <div class="flex gap-3 {{ $reply->is_staff_reply ? '' : 'flex-row-reverse' }}">
                    <div class="flex-shrink-0 h-8 w-8 rounded-full flex items-center justify-center {{ $reply->is_staff_reply ? 'bg-primary-900/30 text-primary-400' : 'bg-slate-700 text-slate-300' }}">
                        {{ strtoupper(substr($reply->user?->name ?? 'S', 0, 1)) }}
                    </div>
                    <div class="flex-1 max-w-[80%] {{ $reply->is_staff_reply ? '' : 'text-right' }}">
                        <div class="inline-block rounded-lg px-4 py-2 {{ $reply->is_staff_reply ? 'bg-primary-900/30' : 'bg-dark-soft' }} text-white">
                            <p class="text-sm whitespace-pre-wrap">{{ $reply->message }}</p>
                        </div>
                        <p class="text-xs text-slate-500 mt-1">
                            {{ $reply->is_staff_reply ? 'Support Team' : 'You' }} · {{ $reply->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            @if($ticket->isOpen())
            <form wire:submit="sendReply" class="pt-4 border-t border-dark-border">
                <textarea wire:model="replyMessage" rows="3" placeholder="Type your reply..." class="w-full rounded-md border-dark-border bg-dark-soft text-white placeholder-slate-500"></textarea>
                @error('replyMessage')<span class="text-red-400 text-xs">{{ $message }}</span>@enderror
                <div class="mt-3 flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition">
                        Send Reply
                    </button>
                </div>
            </form>
            @else
            <p class="text-center text-slate-400 text-sm pt-4 border-t border-dark-border">This ticket is closed.</p>
            @endif
        </div>
    </div>
</div>
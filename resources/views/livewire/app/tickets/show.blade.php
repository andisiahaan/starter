<div>
    <div class="max-w-3xl mx-auto">
        <div class="mb-6">
            <a href="{{ route('app.tickets.index') }}" class="text-primary-400 hover:text-primary-300 text-sm flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                {{ __('tickets.show.back') }}
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
                    <p class="text-sm text-slate-400 mt-1">{{ $ticket->ticket_number }} · {{ __('tickets.show.created', ['date' => $ticket->created_at->format('M d, Y')]) }}</p>
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

            <!-- Ticket Attachments -->
            @if($ticket->getMedia('attachments')->count() > 0)
            <div class="mt-4 pt-4 border-t border-dark-border">
                <h3 class="text-sm font-medium text-slate-400 mb-2">{{ __('tickets.show.attachments') }}</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($ticket->getMedia('attachments') as $media)
                    <a href="{{ $media->getUrl() }}" target="_blank" class="inline-flex items-center gap-2 px-3 py-2 bg-dark-soft rounded-lg text-sm text-slate-300 hover:bg-slate-700 transition">
                        @if(str_starts_with($media->mime_type, 'image/'))
                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        @else
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                        @endif
                        {{ $media->file_name }}
                        <span class="text-xs text-slate-500">({{ number_format($media->size / 1024) }} KB)</span>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        <!-- Conversation -->
        <div class="bg-dark-elevated rounded-lg border border-dark-border p-6">
            <h2 class="text-lg font-medium text-white mb-4">{{ __('tickets.show.conversation') }}</h2>

            @if($ticket->replies->isEmpty())
            <p class="text-slate-400 text-sm text-center py-6">{{ __('tickets.show.waiting_response') }}</p>
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

                        <!-- Reply Attachments -->
                        @if($reply->getMedia('attachments')->count() > 0)
                        <div class="mt-2 flex flex-wrap gap-1 {{ $reply->is_staff_reply ? '' : 'justify-end' }}">
                            @foreach($reply->getMedia('attachments') as $media)
                            <a href="{{ $media->getUrl() }}" target="_blank" class="inline-flex items-center gap-1 px-2 py-1 bg-dark-soft/50 rounded text-xs text-slate-400 hover:text-slate-300 transition">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                {{ $media->file_name }}
                            </a>
                            @endforeach
                        </div>
                        @endif

                        <p class="text-xs text-slate-500 mt-1">
                            {{ $reply->is_staff_reply ? __('tickets.show.support_team') : __('tickets.show.you') }} · {{ $reply->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            @if($ticket->isOpen())
            <form wire:submit="sendReply" class="pt-4 border-t border-dark-border">
                <textarea wire:model="replyMessage" rows="3" placeholder="{{ __('tickets.show.reply_placeholder') }}" class="w-full rounded-md border-dark-border bg-dark-soft text-white placeholder-slate-500"></textarea>
                @error('replyMessage')<span class="text-red-400 text-xs">{{ $message }}</span>@enderror

                <!-- Attachment Upload -->
                <div class="mt-3">
                    <label class="block">
                        <span class="sr-only">{{ __('tickets.create.attachments') }}</span>
                        <input type="file" wire:model="replyAttachments" multiple accept=".jpg,.jpeg,.png,.gif,.webp,.pdf,.doc,.docx,.txt" class="block w-full text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-dark-soft file:text-slate-300 hover:file:bg-slate-700 file:cursor-pointer">
                    </label>
                    <p class="text-xs text-slate-500 mt-1">{{ __('tickets.create.attachments_note') }}</p>
                    @error('replyAttachments.*')<span class="text-red-400 text-xs">{{ $message }}</span>@enderror
                </div>

                <!-- Pending Attachments Preview -->
                @if(count($replyAttachments) > 0)
                <div class="mt-2 flex flex-wrap gap-2">
                    @foreach($replyAttachments as $index => $file)
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-dark-soft rounded-lg text-sm text-slate-300">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                        {{ $file->getClientOriginalName() }}
                        <button type="button" wire:click="removeReplyAttachment({{ $index }})" class="text-red-400 hover:text-red-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                    @endforeach
                </div>
                @endif

                <div class="mt-3 flex justify-end">
                    <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700 transition" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="sendReply">{{ __('tickets.show.send_reply') }}</span>
                        <span wire:loading wire:target="sendReply">{{ __('common.actions.sending') }}...</span>
                    </button>
                </div>
            </form>
            @else
            <p class="text-center text-slate-400 text-sm pt-4 border-t border-dark-border">{{ __('tickets.show.ticket_closed') }}</p>
            @endif
        </div>
    </div>
</div>
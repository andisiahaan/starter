<div>
    <div class="mb-6">
        <a href="{{ route('admin.tickets.index') }}" class="text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300 text-sm flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
            {{ __('admin.tickets_show.back') }}
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
                        {{ $priorities[$ticket->priority] }} {{ __('admin.tickets_show.priority') }}
                    </span>
                </div>
                <div class="mt-4 prose prose-slate dark:prose-invert max-w-none">
                    <p class="text-slate-700 dark:text-slate-300 whitespace-pre-wrap">{{ $ticket->description }}</p>
                </div>

                <!-- Ticket Attachments -->
                @if($ticket->getMedia('attachments')->count() > 0)
                <div class="mt-4 pt-4 border-t border-slate-200 dark:border-dark-border">
                    <h3 class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-2">{{ __('admin.tickets_show.attachments') }}</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($ticket->getMedia('attachments') as $media)
                        <a href="{{ $media->getUrl() }}" target="_blank" class="inline-flex items-center gap-2 px-3 py-2 bg-slate-100 dark:bg-dark-soft rounded-lg text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition">
                            @if(str_starts_with($media->mime_type, 'image/'))
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            @else
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                            @endif
                            {{ $media->file_name }}
                            <span class="text-xs text-slate-400">({{ number_format($media->size / 1024) }} KB)</span>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Replies -->
            <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border p-6">
                <h2 class="text-lg font-medium text-slate-900 dark:text-white mb-4">{{ __('admin.tickets_show.conversation') }}</h2>
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

                            <!-- Reply Attachments -->
                            @if($reply->getMedia('attachments')->count() > 0)
                            <div class="mt-2 flex flex-wrap gap-1 {{ $reply->is_staff_reply ? 'justify-end' : '' }}">
                                @foreach($reply->getMedia('attachments') as $media)
                                <a href="{{ $media->getUrl() }}" target="_blank" class="inline-flex items-center gap-1 px-2 py-1 bg-slate-100/50 dark:bg-dark-soft/50 rounded text-xs text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 transition">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                    {{ $media->file_name }}
                                </a>
                                @endforeach
                            </div>
                            @endif

                            <p class="text-xs text-slate-500 dark:text-slate-500 mt-1">{{ $reply->user?->name ?? __('admin.tickets_show.unknown') }} · {{ $reply->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Reply Form -->
                @if($ticket->status !== 'closed')
                <form wire:submit="sendReply" class="mt-6 pt-4 border-t border-slate-200 dark:border-dark-border">
                    <textarea wire:model="replyMessage" rows="3" placeholder="{{ __('admin.tickets_show.reply_placeholder') }}" class="block w-full rounded-md border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm"></textarea>
                    @error('replyMessage')<span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span>@enderror

                    <!-- Attachment Upload -->
                    <div class="mt-3">
                        <label class="block">
                            <span class="sr-only">{{ __('admin.tickets_show.attach_files') }}</span>
                            <input type="file" wire:model="replyAttachments" multiple accept=".jpg,.jpeg,.png,.gif,.webp,.pdf,.doc,.docx,.txt" class="block w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-slate-100 dark:file:bg-dark-soft file:text-slate-700 dark:file:text-slate-300 hover:file:bg-slate-200 dark:hover:file:bg-slate-700 file:cursor-pointer">
                        </label>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">{{ __('admin.tickets_show.attachments_note') }}</p>
                        @error('replyAttachments.*')<span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span>@enderror
                    </div>

                    <!-- Pending Attachments Preview -->
                    @if(count($replyAttachments) > 0)
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach($replyAttachments as $index => $file)
                        <div class="inline-flex items-center gap-2 px-3 py-1 bg-slate-100 dark:bg-dark-soft rounded-lg text-sm text-slate-700 dark:text-slate-300">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                            {{ $file->getClientOriginalName() }}
                            <button type="button" wire:click="removeReplyAttachment({{ $index }})" class="text-red-500 hover:text-red-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <div class="mt-3 flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-700" wire:loading.attr="disabled">
                            <span wire:loading.remove wire:target="sendReply">{{ __('admin.tickets_show.send_reply') }}</span>
                            <span wire:loading wire:target="sendReply">{{ __('common.actions.sending') }}...</span>
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border p-6">
                <h3 class="text-sm font-medium text-slate-900 dark:text-white mb-4">{{ __('admin.tickets_show.details.title') }}</h3>
                <dl class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">{{ __('admin.tickets_show.details.status') }}</dt>
                        <dd>
                            <select wire:change="updateStatus($event.target.value)" class="text-xs rounded border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white py-1 px-2">
                                @foreach($statuses as $key => $label)
                                <option value="{{ $key }}" {{ $ticket->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">{{ __('admin.tickets_show.details.category') }}</dt>
                        <dd class="text-slate-900 dark:text-white capitalize">{{ $ticket->category }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">{{ __('admin.tickets_show.details.user') }}</dt>
                        <dd class="text-slate-900 dark:text-white">{{ $ticket->user?->name ?? __('admin.tickets_show.details.guest') }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">{{ __('admin.tickets_show.details.email') }}</dt>
                        <dd class="text-slate-900 dark:text-white">{{ $ticket->user?->email ?? '-' }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-slate-500 dark:text-slate-400">{{ __('admin.tickets_show.details.assigned') }}</dt>
                        <dd class="text-slate-900 dark:text-white">{{ $ticket->assignee?->name ?? __('admin.tickets_show.details.unassigned') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
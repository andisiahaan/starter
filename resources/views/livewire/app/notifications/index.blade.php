<div>
    {{-- Page Header --}}
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('notifications.title') }}</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('notifications.description') }}</p>
            </div>
            
            {{-- Quick Actions --}}
            @if($unreadCount > 0)
                <div class="flex items-center gap-2">
                    <button wire:click="markAllAsRead" 
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20 hover:bg-primary-100 dark:hover:bg-primary-900/30 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ __('notifications.mark_all_read') }}
                    </button>
                </div>
            @endif
        </div>
    </div>

    {{-- Filters & Bulk Actions Bar --}}
    <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border mb-4">
        <div class="p-4 flex flex-col sm:flex-row sm:items-center gap-4">
            {{-- Filters --}}
            <div class="flex items-center gap-2">
                <button wire:click="$set('filter', '')" 
                        class="px-3 py-1.5 text-sm font-medium rounded-lg transition-colors {{ !$filter ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-white/5' }}">
                    {{ __('notifications.filter_all') }}
                </button>
                <button wire:click="$set('filter', 'unread')"
                        class="px-3 py-1.5 text-sm font-medium rounded-lg transition-colors {{ $filter === 'unread' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-white/5' }}">
                    {{ __('notifications.filter_unread') }}
                    @if($unreadCount > 0)
                        <span class="ml-1.5 inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 text-xs font-bold bg-red-500 text-white rounded-full">
                            {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                        </span>
                    @endif
                </button>
                <button wire:click="$set('filter', 'read')"
                        class="px-3 py-1.5 text-sm font-medium rounded-lg transition-colors {{ $filter === 'read' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-white/5' }}">
                    {{ __('notifications.filter_read') }}
                </button>
            </div>

            {{-- Bulk Actions (shown when items selected) --}}
            @if(count($selected) > 0)
                <div class="flex items-center gap-2 sm:ml-auto">
                    <span class="text-sm text-slate-500 dark:text-slate-400">
                        {{ __('notifications.selected_count', ['count' => count($selected)]) }}
                    </span>
                    <div class="flex items-center gap-1">
                        <button wire:click="markSelectedAsRead" 
                                class="p-2 text-slate-500 hover:text-green-600 dark:text-slate-400 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 rounded-lg transition-colors"
                                title="{{ __('notifications.mark_read') }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </button>
                        <button wire:click="markSelectedAsUnread" 
                                class="p-2 text-slate-500 hover:text-amber-600 dark:text-slate-400 dark:hover:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 rounded-lg transition-colors"
                                title="{{ __('notifications.mark_unread') }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                        <button wire:click="deleteSelected" 
                                wire:confirm="{{ __('notifications.confirm_delete_selected') }}"
                                class="p-2 text-slate-500 hover:text-red-600 dark:text-slate-400 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors"
                                title="{{ __('notifications.delete') }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            @else
                {{-- Delete All Read Button --}}
                @if($filter === 'read' || (!$filter && $notifications->count() > 0))
                    <div class="sm:ml-auto">
                        <button wire:click="deleteAllRead"
                                wire:confirm="{{ __('notifications.confirm_delete_all_read') }}"
                                class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            {{ __('notifications.delete_all_read') }}
                        </button>
                    </div>
                @endif
            @endif
        </div>
    </div>

    {{-- Notifications List --}}
    <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border overflow-hidden">
        @if($notifications->count() > 0)
            {{-- Select All Header --}}
            <div class="px-4 py-3 bg-slate-50 dark:bg-dark-soft/50 border-b border-slate-200 dark:border-dark-border">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" 
                           wire:model.live="selectAll"
                           class="w-4 h-4 rounded border-slate-300 dark:border-slate-600 text-primary-600 focus:ring-primary-500 dark:bg-dark-soft">
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">
                        {{ __('notifications.select_all') }}
                    </span>
                </label>
            </div>

            {{-- Notification Items --}}
            <div class="divide-y divide-slate-100 dark:divide-dark-border">
                @foreach($notifications as $notification)
                    <div wire:key="notification-{{ $notification['id'] }}"
                         class="group relative hover:bg-slate-50 dark:hover:bg-white/5 transition-colors {{ !$notification['read_at'] ? 'bg-primary-50/50 dark:bg-primary-900/10' : '' }}">
                        <div class="flex items-start gap-4 p-4">
                            {{-- Checkbox --}}
                            <div class="shrink-0 pt-1">
                                <input type="checkbox" 
                                       wire:model.live="selected"
                                       value="{{ $notification['id'] }}"
                                       class="w-4 h-4 rounded border-slate-300 dark:border-slate-600 text-primary-600 focus:ring-primary-500 dark:bg-dark-soft">
                            </div>
                            
                            {{-- Icon --}}
                            <div class="shrink-0">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $notification['color']['bg'] }}">
                                    <svg class="w-5 h-5 {{ $notification['color']['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $notification['icon'] }}" />
                                    </svg>
                                </div>
                            </div>
                            
                            {{-- Content --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2">
                                            <p class="text-sm font-semibold text-slate-900 dark:text-white">
                                                {{ $notification['title'] }}
                                            </p>
                                            @if(!$notification['read_at'])
                                                <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 rounded-full">
                                                    {{ __('notifications.new') }}
                                                </span>
                                            @endif
                                        </div>
                                        @if($notification['message'])
                                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                                                {{ $notification['message'] }}
                                            </p>
                                        @endif
                                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-2" title="{{ $notification['created_at_full'] }}">
                                            {{ $notification['created_at'] }}
                                        </p>
                                    </div>
                                    
                                    {{-- Actions --}}
                                    <div class="shrink-0 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                        @if($notification['url'])
                                            <a href="{{ $notification['url'] }}" 
                                               wire:click="markAsRead('{{ $notification['id'] }}')"
                                               class="p-2 text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20 rounded-lg transition-colors"
                                               title="{{ __('notifications.view') }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                            </a>
                                        @endif
                                        
                                        @if(!$notification['read_at'])
                                            <button wire:click="markAsRead('{{ $notification['id'] }}')"
                                                    class="p-2 text-slate-400 hover:text-green-600 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 rounded-lg transition-colors"
                                                    title="{{ __('notifications.mark_read') }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        @else
                                            <button wire:click="markAsUnread('{{ $notification['id'] }}')"
                                                    class="p-2 text-slate-400 hover:text-amber-600 dark:hover:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 rounded-lg transition-colors"
                                                    title="{{ __('notifications.mark_unread') }}">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>
                                        @endif
                                        
                                        <button wire:click="delete('{{ $notification['id'] }}')"
                                                wire:confirm="{{ __('notifications.confirm_delete') }}"
                                                class="p-2 text-slate-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors"
                                                title="{{ __('notifications.delete') }}">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($notifications->hasPages())
                <div class="px-4 py-4 border-t border-slate-200 dark:border-dark-border">
                    {{ $notifications->links() }}
                </div>
            @endif
        @else
            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center py-16 px-6">
                <div class="w-20 h-20 rounded-full bg-slate-100 dark:bg-dark-soft flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-slate-900 dark:text-white mb-2">
                    @if($filter === 'unread')
                        {{ __('notifications.empty_unread_title') }}
                    @elseif($filter === 'read')
                        {{ __('notifications.empty_read_title') }}
                    @else
                        {{ __('notifications.empty_title') }}
                    @endif
                </h4>
                <p class="text-sm text-slate-500 dark:text-slate-400 text-center max-w-sm">
                    @if($filter === 'unread')
                        {{ __('notifications.empty_unread_description') }}
                    @elseif($filter === 'read')
                        {{ __('notifications.empty_read_description') }}
                    @else
                        {{ __('notifications.empty_description') }}
                    @endif
                </p>
            </div>
        @endif
    </div>
</div>

<div>
    {{-- Notification Bell Button --}}
    <button x-data
            @click="$dispatch('open-notification-panel')" 
            type="button" 
            class="relative p-2 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 dark:text-slate-400 dark:hover:text-white dark:hover:bg-white/5 transition-colors">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        
        {{-- Badge Count --}}
        @if($unreadCount > 0)
            <span class="absolute -top-0.5 -right-0.5 inline-flex items-center justify-center min-w-[18px] h-[18px] px-1 text-[10px] font-bold text-white bg-red-500 rounded-full ring-2 ring-white dark:ring-dark-base">
                {{ $unreadCount > 99 ? '99+' : $unreadCount }}
            </span>
        @endif
    </button>

    {{-- Side Panel (Teleported to body with its own Alpine scope) --}}
    <template x-teleport="body">
        <div x-data="{ 
                open: false,
                init() {
                    window.addEventListener('open-notification-panel', () => {
                        this.open = true;
                        document.body.style.overflow = 'hidden';
                    });
                },
                close() {
                    this.open = false;
                    document.body.style.overflow = '';
                }
             }"
             x-cloak>
             
            {{-- Backdrop --}}
            <div x-show="open"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 @click="close()"
                 class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-[60]">
            </div>
            
            {{-- Panel --}}
            <div x-show="open"
                 x-transition:enter="transform transition ease-out duration-300"
                 x-transition:enter-start="translate-x-full"
                 x-transition:enter-end="translate-x-0"
                 x-transition:leave="transform transition ease-in duration-200"
                 x-transition:leave-start="translate-x-0"
                 x-transition:leave-end="translate-x-full"
                 class="fixed inset-y-0 right-0 w-full sm:w-[420px] bg-white dark:bg-dark-elevated shadow-2xl z-[61] flex flex-col">
                
                {{-- Header --}}
                <div class="flex items-center justify-between h-16 px-4 sm:px-6 border-b border-slate-200 dark:border-dark-border bg-white dark:bg-dark-elevated shrink-0">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                            <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-base font-semibold text-slate-900 dark:text-white">Notifications</h3>
                            @if($unreadCount > 0)
                                <p class="text-xs text-slate-500 dark:text-slate-400">{{ $unreadCount }} unread</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-2">
                        @if($unreadCount > 0)
                            <button wire:click="markAllAsRead" 
                                    class="text-xs font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 px-2 py-1 rounded hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors">
                                Mark all read
                            </button>
                        @endif
                        <button @click="close()" 
                                class="p-2 rounded-lg text-slate-400 hover:text-slate-600 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-white/10 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                {{-- Scrollable Content --}}
                <div class="flex-1 overflow-y-auto">
                    @forelse($notifications as $notification)
                        <div wire:key="notification-{{ $notification['id'] }}"
                             class="group px-4 sm:px-6 py-4 border-b border-slate-100 dark:border-dark-border hover:bg-slate-50 dark:hover:bg-white/5 transition-colors {{ !$notification['read_at'] ? 'bg-primary-50/50 dark:bg-primary-900/10' : '' }}">
                            
                            <div class="flex gap-4">
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
                                    <div class="flex items-start justify-between gap-2">
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-semibold text-slate-900 dark:text-white leading-snug">
                                                {{ $notification['title'] }}
                                            </p>
                                            @if($notification['message'])
                                                <p class="text-sm text-slate-600 dark:text-slate-400 mt-1 line-clamp-2">
                                                    {{ $notification['message'] }}
                                                </p>
                                            @endif
                                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-2">
                                                {{ $notification['created_at'] }}
                                            </p>
                                        </div>
                                        
                                        {{-- Unread indicator --}}
                                        @if(!$notification['read_at'])
                                            <div class="shrink-0 mt-1">
                                                <div class="w-2.5 h-2.5 bg-primary-500 rounded-full animate-pulse"></div>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    {{-- Actions --}}
                                    <div class="flex items-center gap-3 mt-3">
                                        @if($notification['url'])
                                            <a href="{{ $notification['url'] }}" 
                                               wire:click="markAsRead('{{ $notification['id'] }}')"
                                               @click="close()"
                                               class="inline-flex items-center gap-1.5 text-xs font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
                                                <span>View Details</span>
                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                </svg>
                                            </a>
                                        @endif
                                        
                                        @if(!$notification['read_at'])
                                            <button wire:click="markAsRead('{{ $notification['id'] }}')"
                                                    class="text-xs text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-300 transition-colors">
                                                Mark as read
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="flex flex-col items-center justify-center py-16 px-6">
                            <div class="w-20 h-20 rounded-full bg-slate-100 dark:bg-dark-soft flex items-center justify-center mb-4">
                                <svg class="w-10 h-10 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </div>
                            <h4 class="text-base font-medium text-slate-900 dark:text-white mb-1">No notifications yet</h4>
                            <p class="text-sm text-slate-500 dark:text-slate-400 text-center">When you receive notifications, they'll appear here.</p>
                        </div>
                    @endforelse
                </div>
                
                {{-- Footer --}}
                @if(count($notifications) > 0)
                    <div class="shrink-0 px-4 sm:px-6 py-4 border-t border-slate-200 dark:border-dark-border bg-slate-50 dark:bg-dark-soft/50">
                        <a href="#" 
                           @click="close()"
                           class="flex items-center justify-center gap-2 w-full py-2.5 text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 rounded-lg hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors">
                            <span>View All Notifications</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </template>
</div>

<div class="space-y-6">
    {{-- Page Header --}}
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('Activity Logs') }}</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('View your recent account activity.') }}</p>
    </div>

    {{-- Search --}}
    <div class="flex items-center gap-4">
        <div class="relative flex-1 max-w-sm">
            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            <input
                type="text"
                wire:model.live.debounce.300ms="search"
                placeholder="{{ __('Search activity...') }}"
                class="w-full pl-10 pr-4 py-2 border border-slate-300 dark:border-dark-border rounded-lg bg-white dark:bg-dark-elevated text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
        </div>
    </div>

    {{-- Activity List --}}
    <div class="bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border shadow-sm overflow-hidden">
        @forelse($activities as $activity)
        <div class="flex items-start gap-4 p-4 border-b border-slate-100 dark:border-dark-border last:border-0 hover:bg-slate-50 dark:hover:bg-dark-soft transition-colors">
            {{-- Icon --}}
            <div class="w-9 h-9 rounded-full bg-slate-100 dark:bg-dark-muted flex items-center justify-center shrink-0">
                @if(str_contains($activity->description, 'Logged in'))
                <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
                @elseif(str_contains($activity->description, 'Logged out'))
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                @elseif(str_contains($activity->description, 'password'))
                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
                @elseif(str_contains($activity->description, 'two-factor'))
                <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                @elseif(str_contains($activity->description, 'email'))
                <svg class="w-4 h-4 text-sky-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                @else
                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                @endif
            </div>

            {{-- Content --}}
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-slate-900 dark:text-white">
                    {{ $activity->description }}
                </p>
                @if($activity->properties && count($activity->properties) > 0)
                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400 truncate">
                    {{ json_encode($activity->properties) }}
                </p>
                @endif
            </div>

            {{-- Time --}}
            <div class="text-xs text-slate-500 dark:text-slate-400 shrink-0">
                {{ $activity->created_at->diffForHumans() }}
            </div>
        </div>
        @empty
        <div class="p-8 text-center">
            <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-dark-muted flex items-center justify-center mx-auto mb-3">
                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <p class="text-slate-500 dark:text-slate-400">{{ __('No activity logs found.') }}</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div>
        {{ $activities->links() }}
    </div>
</div>
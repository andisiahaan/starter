<div x-data="{ open: false }" class="relative">
    <button @click="open = !open"
        @click.away="open = false"
        class="flex items-center gap-1.5 px-2 py-2 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 dark:text-slate-400 dark:hover:text-white dark:hover:bg-white/10 transition-colors"
        aria-label="Select Language">

        <!-- Current Language Flag -->
        @if(app()->getLocale() === 'en')
        <span class="text-base">🇺🇸</span>
        @else
        <span class="text-base">🇮🇩</span>
        @endif

        <span class="text-sm font-medium uppercase hidden sm:inline">{{ app()->getLocale() }}</span>

        <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <!-- Dropdown -->
    <div x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-1"
        class="absolute right-0 mt-2 w-40 bg-white dark:bg-dark-elevated rounded-xl shadow-lg shadow-slate-200/50 dark:shadow-none border border-slate-200 dark:border-dark-border overflow-hidden z-50"
        style="display: none;">
        <div class="py-1">
            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm hover:bg-slate-50 dark:hover:bg-white/5 transition-colors {{ app()->getLocale() === 'en' ? 'text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' : 'text-slate-700 dark:text-slate-200' }}">
                <span class="text-lg">🇺🇸</span>
                <span class="font-medium">English</span>
                @if(app()->getLocale() === 'en')
                <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                @endif
            </a>
            <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm hover:bg-slate-50 dark:hover:bg-white/5 transition-colors {{ app()->getLocale() === 'id' ? 'text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' : 'text-slate-700 dark:text-slate-200' }}">
                <span class="text-lg">🇮🇩</span>
                <span class="font-medium">Indonesia</span>
                @if(app()->getLocale() === 'id')
                <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                @endif
            </a>
        </div>
    </div>
</div>
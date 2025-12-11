<!-- Mobile Overlay -->
<div x-show="sidebarOpen"
    x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click="sidebarOpen = false"
    class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 md:hidden"
    style="display: none;">
</div>

<!-- Sidebar -->
<aside x-data="{ activeMenu: '{{ request()->routeIs('app.index') ? 'dashboard' : '' }}' }"
    :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
    class="fixed inset-y-0 left-0 z-50 w-64 flex flex-col bg-white dark:bg-dark-base border-r border-slate-200 dark:border-dark-border transform transition-transform duration-300 ease-in-out md:translate-x-0">

    <!-- Logo -->
    <div class="flex items-center h-16 px-4 border-b border-slate-200 dark:border-dark-border shrink-0">
        <a href="{{ route('app.index') }}" class="flex items-center gap-2">
            @if(setting('main.logo'))
            <img src="{{ Storage::url(setting('main.logo')) }}" alt="{{ setting('main.name', config('app.name')) }}" class="h-8 w-auto">
            @else
            <span class="text-xl font-bold text-gradient-primary">
                {{ setting('main.name', config('app.name')) }}
            </span>
            @endif
        </a>

        <!-- Close button (mobile) -->
        <button @click="sidebarOpen = false" class="ml-auto md:hidden p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:text-white dark:hover:bg-white/5">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto custom-scrollbar px-3 py-4 space-y-1">

        <!-- Dashboard -->
        <a href="{{ route('app.index') }}"
            class="sidebar-link {{ request()->routeIs('app.index') ? 'sidebar-link-active' : 'sidebar-link-default' }}">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            {{ __('common.nav.dashboard') }}
        </a>

        <!-- Section: Billing -->
        <div class="pt-4">
            <p class="px-3 mb-2 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                {{ __('common.nav.billing') }}
            </p>

            <!-- Credits -->
            <a href="{{ route('app.credits.index') }}"
                class="sidebar-link {{ request()->routeIs('app.credits.*') ? 'sidebar-link-active' : 'sidebar-link-default' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ __('common.nav.credits') }}
                @if(Auth::user() && Auth::user()->credit > 0)
                <span class="ml-auto px-2 py-0.5 text-xs font-medium rounded-full bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-400">
                    {{ number_format(Auth::user()->credit, 0, ',', '.') }}
                </span>
                @endif
            </a>

            <!-- My Orders -->
            <a href="{{ route('app.orders.index') }}"
                class="sidebar-link {{ request()->routeIs('app.orders.*') ? 'sidebar-link-active' : 'sidebar-link-default' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
                {{ __('common.nav.my_orders') }}
            </a>
        </div>

        <!-- Section: Support -->
        <div class="pt-4">
            <p class="px-3 mb-2 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                {{ __('common.nav.support') }}
            </p>

            <!-- Tickets -->
            <a href="{{ route('app.tickets.index') }}"
                class="sidebar-link {{ request()->routeIs('app.tickets.*') ? 'sidebar-link-active' : 'sidebar-link-default' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                </svg>
                {{ __('common.nav.support_tickets') }}
            </a>

            <!-- News -->
            <a href="{{ route('app.news.index') }}"
                class="sidebar-link {{ request()->routeIs('app.news.*') ? 'sidebar-link-active' : 'sidebar-link-default' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                {{ __('common.nav.news_updates') }}
            </a>
        </div>

        @if(setting('referral.is_enabled', false))
        <!-- Section: Referral -->
        <div class="pt-4">
            <p class="px-3 mb-2 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                {{ __('common.nav.referral') }}
            </p>

            <!-- Referral Program -->
            <a href="{{ route('app.referral.index') }}"
                class="sidebar-link {{ request()->routeIs('app.referral.*') ? 'sidebar-link-active' : 'sidebar-link-default' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                {{ __('common.nav.referral_program') }}
                @if(Auth::user() && Auth::user()->available_commission > 0)
                <span class="ml-auto px-2 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                    Rp {{ number_format(Auth::user()->available_commission, 0, ',', '.') }}
                </span>
                @endif
            </a>
        </div>
        @endif

        <!-- Section: Developer -->
        <div class="pt-4">
            <p class="px-3 mb-2 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                {{ __('common.nav.developer') }}
            </p>

            <!-- API Tokens -->
            <a href="{{ route('app.api-tokens.index') }}"
                class="sidebar-link {{ request()->routeIs('app.api-tokens.*') ? 'sidebar-link-active' : 'sidebar-link-default' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
                {{ __('common.nav.api_tokens') }}
            </a>

            <!-- API Docs -->
            <a href="{{ route('docs.api') }}"
                class="sidebar-link sidebar-link-default">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                {{ __('common.nav.api_docs') }}
            </a>
        </div>

        @if(Auth::user() && (Auth::user()->hasRole('admin') || Auth::user()->hasRole('superadmin')))
        <!-- Section: Admin -->
        <div class="pt-4">
            <p class="px-3 mb-2 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                {{ __('common.nav.administration') }}
            </p>

            <a href="{{ route('admin.index') }}"
                class="sidebar-link sidebar-link-default">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                </svg>
                {{ __('common.nav.admin_panel') }}
            </a>
        </div>
        @endif
    </nav>

    <!-- User Profile Section -->
    <div class="p-3 border-t border-slate-200 dark:border-dark-border shrink-0">
        <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer"
            x-data="{ open: false }" @click="open = !open" @click.away="open = false">
            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white font-semibold text-sm shrink-0">
                {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-slate-900 dark:text-white truncate">
                    {{ Auth::user()->name ?? 'User' }}
                </p>
                <p class="text-xs text-slate-500 dark:text-slate-400 truncate">
                    {{ Auth::user()->email ?? '' }}
                </p>
            </div>
            <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
            </svg>
        </div>
    </div>
</aside>
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
<aside x-data="{ 
           activeMenu: '<?php echo e(request()->routeIs('dashboard') ? 'dashboard' : (request()->routeIs('orders.*') ? 'orders' : '')); ?>'
       }"
    :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
    class="fixed inset-y-0 left-0 z-50 w-64 flex flex-col bg-white dark:bg-dark-base border-r border-slate-200 dark:border-dark-border transform transition-transform duration-300 ease-in-out md:translate-x-0">

    <!-- Logo -->
    <div class="flex items-center h-16 px-4 border-b border-slate-200 dark:border-dark-border shrink-0">
        <a href="<?php echo e(url('/dashboard')); ?>" class="flex items-center gap-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(setting('main.logo')): ?>
            <img src="<?php echo e(Storage::url(setting('main.logo'))); ?>" alt="<?php echo e(setting('main.name', config('app.name'))); ?>" class="h-8 w-auto">
            <?php else: ?>
            <span class="text-xl font-bold text-gradient-primary">
                <?php echo e(setting('main.name', config('app.name'))); ?>

            </span>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
        <a href="<?php echo e(url('/dashboard')); ?>"
            class="sidebar-link <?php echo e(request()->routeIs('dashboard') ? 'sidebar-link-active' : 'sidebar-link-default'); ?>">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <?php echo e(__('ui.dashboard')); ?>

        </a>

        <!-- Section: Services -->
        <div class="pt-4">
            <p class="px-3 mb-2 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                Services
            </p>

            <!-- Orders with Submenu -->
            <div x-data="{ open: <?php echo e(request()->routeIs('orders.*') ? 'true' : 'false'); ?> }">
                <button @click="open = !open"
                    class="sidebar-link sidebar-link-default w-full justify-between <?php echo e(request()->routeIs('orders.*') ? 'text-primary-600 dark:text-primary-400' : ''); ?>">
                    <span class="flex items-center gap-3">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>
                        Orders
                    </span>
                    <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" x-collapse class="mt-1 ml-4 pl-4 border-l border-slate-200 dark:border-dark-border space-y-1">
                    <a href="#" class="sidebar-link sidebar-link-default text-sm py-2">
                        All Orders
                    </a>
                    <a href="#" class="sidebar-link sidebar-link-default text-sm py-2">
                        Pending
                        <span class="ml-auto px-2 py-0.5 text-xs font-medium rounded-full bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400">3</span>
                    </a>
                    <a href="#" class="sidebar-link sidebar-link-default text-sm py-2">
                        Completed
                    </a>
                </div>
            </div>

            <!-- Transactions -->
            <a href="#" class="sidebar-link sidebar-link-default">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                Transactions
            </a>

            <!-- API -->
            <a href="#" class="sidebar-link sidebar-link-default">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                </svg>
                API Access
            </a>
        </div>

        <!-- Section: Account -->
        <div class="pt-4">
            <p class="px-3 mb-2 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                Account
            </p>

            <!-- Credits -->
            <a href="<?php echo e(route('app.credits.index')); ?>"
                class="sidebar-link <?php echo e(request()->routeIs('app.credits.*') ? 'sidebar-link-active' : 'sidebar-link-default'); ?>">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Credits
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Auth::user() && Auth::user()->credit > 0): ?>
                <span class="ml-auto px-2 py-0.5 text-xs font-medium rounded-full bg-primary-100 text-primary-700 dark:bg-primary-900/30 dark:text-primary-400">
                    <?php echo e(number_format(Auth::user()->credit, 0, ',', '.')); ?>

                </span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </a>

            <!-- My Orders -->
            <a href="<?php echo e(route('app.orders.index')); ?>"
                class="sidebar-link <?php echo e(request()->routeIs('app.orders.*') ? 'sidebar-link-active' : 'sidebar-link-default'); ?>">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                </svg>
                My Orders
            </a>

            <!-- Account Settings -->
            <a href="<?php echo e(route('app.account')); ?>"
                class="sidebar-link <?php echo e(request()->routeIs('app.account*') ? 'sidebar-link-active' : 'sidebar-link-default'); ?>">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <?php echo e(__('Account Settings')); ?>

            </a>

            <!-- Activity Logs -->
            <a href="<?php echo e(route('app.activity-logs')); ?>"
                class="sidebar-link <?php echo e(request()->routeIs('app.activity-logs') ? 'sidebar-link-active' : 'sidebar-link-default'); ?>">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <?php echo e(__('Activity Logs')); ?>

            </a>
        </div>

        <!-- Section: Support -->
        <div class="pt-4">
            <p class="px-3 mb-2 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                Support
            </p>

            <!-- Tickets -->
            <a href="<?php echo e(route('app.tickets.index')); ?>"
                class="sidebar-link <?php echo e(request()->routeIs('app.tickets.*') ? 'sidebar-link-active' : 'sidebar-link-default'); ?>">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                </svg>
                Support Tickets
            </a>

            <!-- News -->
            <a href="<?php echo e(route('app.news.index')); ?>"
                class="sidebar-link <?php echo e(request()->routeIs('app.news.*') ? 'sidebar-link-active' : 'sidebar-link-default'); ?>">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                News & Updates
            </a>
        </div>

        <!-- Section: Developer -->
        <div class="pt-4">
            <p class="px-3 mb-2 text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                Developer
            </p>

            <!-- API Tokens -->
            <a href="<?php echo e(route('app.api-tokens.index')); ?>"
                class="sidebar-link <?php echo e(request()->routeIs('app.api-tokens.*') ? 'sidebar-link-active' : 'sidebar-link-default'); ?>">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
                API Tokens
            </a>
        </div>
    </nav>

    <!-- User Profile Section -->
    <div class="p-3 border-t border-slate-200 dark:border-dark-border shrink-0">
        <div class="flex items-center gap-3 p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors cursor-pointer"
            x-data="{ open: false }" @click="open = !open" @click.away="open = false">
            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white font-semibold text-sm shrink-0">
                <?php echo e(substr(Auth::user()->name ?? 'U', 0, 1)); ?>

            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-slate-900 dark:text-white truncate">
                    <?php echo e(Auth::user()->name ?? 'User'); ?>

                </p>
                <p class="text-xs text-slate-500 dark:text-slate-400 truncate">
                    <?php echo e(Auth::user()->email ?? ''); ?>

                </p>
            </div>
            <svg class="w-4 h-4 text-slate-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
            </svg>
        </div>
    </div>
</aside><?php /**PATH D:\Installed\Apps\laragon\www\gramsea\resources\views/layouts/partials/sidebar.blade.php ENDPATH**/ ?>
<header class="sticky top-0 z-30 bg-white/80 dark:bg-dark-base/80 backdrop-blur-lg border-b border-slate-200 dark:border-dark-border">
    <div class="flex items-center justify-between h-16 px-4 md:px-6 lg:px-8">

        <!-- Left: Mobile Menu Toggle + Search -->
        <div class="flex items-center gap-3">
            <!-- Sidebar Toggle (Mobile) -->
            <button @click="sidebarOpen = !sidebarOpen"
                class="md:hidden p-2 -ml-2 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 dark:text-slate-400 dark:hover:text-white dark:hover:bg-white/5 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <!-- Search Bar (Desktop) -->
            <div class="hidden md:flex items-center">
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <input type="text"
                        placeholder="<?php echo e(__('common.form.search_placeholder')); ?>"
                        class="w-64 lg:w-80 pl-10 pr-4 py-2 text-sm bg-slate-100 dark:bg-dark-elevated border-0 rounded-lg text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:ring-2 focus:ring-primary-500/50 focus:bg-white dark:focus:bg-dark-muted transition-colors">
                </div>
            </div>
        </div>

        <!-- Right: Actions -->
        <div class="flex items-center gap-2 sm:gap-3">

            <!-- Search Toggle (Mobile) -->
            <button x-data="{ searchOpen: false }"
                @click="searchOpen = !searchOpen"
                class="md:hidden p-2 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 dark:text-slate-400 dark:hover:text-white dark:hover:bg-white/5 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </button>

            
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('app.components.notification-dropdown');

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-3405191946-0', $key);

$__html = app('livewire')->mount($__name, $__params, $key, $__componentSlots);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
if (isset($__slots)) unset($__slots);
?>

            <?php echo $__env->make('layouts.partials.theme-toggler', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('layouts.partials.language-switcher', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Profile Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="flex items-center gap-2 p-1.5 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white font-semibold text-sm">
                        <?php echo e(substr(Auth::user()->name ?? 'U', 0, 1)); ?>

                    </div>
                    <svg class="w-4 h-4 text-slate-400 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="open"
                    @click.away="open = false"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-1"
                    class="absolute right-0 mt-2 w-56 bg-white dark:bg-dark-elevated rounded-xl shadow-lg shadow-slate-200/50 dark:shadow-none border border-slate-200 dark:border-dark-border overflow-hidden"
                    style="display: none;">

                    <!-- User Info -->
                    <div class="px-4 py-3 border-b border-slate-100 dark:border-dark-border">
                        <p class="text-sm font-medium text-slate-900 dark:text-white"><?php echo e(Auth::user()->name ?? 'User'); ?></p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 truncate"><?php echo e(Auth::user()->email ?? ''); ?></p>
                    </div>

                    <div class="py-1">
                        <!-- Account Settings -->
                        <a href="<?php echo e(route('app.account')); ?>" class="flex items-center gap-3 px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <?php echo e(__('common.nav.account_settings')); ?>

                        </a>

                        <!-- Activity Log -->
                        <a href="<?php echo e(route('app.activity-logs')); ?>" class="flex items-center gap-3 px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-white/5 transition-colors">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <?php echo e(__('common.nav.activity_log')); ?>

                        </a>
                    </div>

                    <div class="border-t border-slate-100 dark:border-dark-border py-1">
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="flex items-center gap-3 w-full px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/10 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                                <?php echo e(__('common.nav.logout')); ?>

                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header><?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/layouts/partials/topbar.blade.php ENDPATH**/ ?>
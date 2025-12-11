<nav x-data="{ 
        mobileMenuOpen: false,
        servicesOpen: false,
        scrolled: false
     }"
    @scroll.window="scrolled = window.scrollY > 20"
    :class="{ 'bg-white/80 dark:bg-dark-base/80 backdrop-blur-lg shadow-sm': scrolled, 'bg-white dark:bg-dark-base': !scrolled }"
    class="sticky top-0 z-50 border-b border-slate-200/80 dark:border-dark-border transition-all duration-300">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 lg:h-18">

            <!-- Logo & Desktop Nav -->
            <div class="flex items-center">
                <!-- Logo -->
                <a href="<?php echo e(url('/')); ?>" class="flex items-center gap-2 shrink-0">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(setting('main.logo')): ?>
                    <img src="<?php echo e(Storage::url(setting('main.logo'))); ?>" alt="<?php echo e(setting('main.name', config('app.name'))); ?>" class="h-8 lg:h-9 w-auto">
                    <?php else: ?>
                    <span class="text-xl lg:text-2xl font-bold text-gradient-primary">
                        <?php echo e(setting('main.name', config('app.name'))); ?>

                    </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </a>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex lg:items-center lg:ml-10 lg:gap-1">
                    <a href="<?php echo e(url('/')); ?>" class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-200 dark:hover:text-primary-400 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors">
                        <?php echo e(__('common.nav.home')); ?>

                    </a>

                    <!-- Services Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            @click.away="open = false"
                            class="flex items-center gap-1 px-3 py-2 text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-200 dark:hover:text-primary-400 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors">
                            <?php echo e(__('common.nav.services')); ?>

                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            class="absolute left-0 mt-2 w-64 bg-white dark:bg-dark-elevated rounded-xl shadow-lg shadow-slate-200/50 dark:shadow-none border border-slate-200 dark:border-dark-border overflow-hidden"
                            style="display: none;">
                            <div class="p-2">
                                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-slate-50 dark:hover:bg-white/5 transition-colors group">
                                    <div class="w-10 h-10 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center text-primary-600 dark:text-primary-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900 dark:text-white">SMM Panel</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">Social media marketing services</p>
                                    </div>
                                </a>
                                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-slate-50 dark:hover:bg-white/5 transition-colors group">
                                    <div class="w-10 h-10 rounded-lg bg-secondary-100 dark:bg-secondary-900/30 flex items-center justify-center text-secondary-600 dark:text-secondary-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900 dark:text-white">Verification</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">Account verification services</p>
                                    </div>
                                </a>
                                <a href="#" class="flex items-center gap-3 px-3 py-2.5 rounded-lg hover:bg-slate-50 dark:hover:bg-white/5 transition-colors group">
                                    <div class="w-10 h-10 rounded-lg bg-violet-100 dark:bg-violet-900/30 flex items-center justify-center text-violet-600 dark:text-violet-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900 dark:text-white">Bot Services</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">Telegram & Discord bots</p>
                                    </div>
                                </a>
                            </div>
                            <div class="px-4 py-3 bg-slate-50 dark:bg-white/5 border-t border-slate-100 dark:border-dark-border">
                                <a href="#" class="flex items-center gap-2 text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
                                    <?php echo e(__('common.nav.view_all_services')); ?>

                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-200 dark:hover:text-primary-400 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors">
                        <?php echo e(__('common.nav.pricing')); ?>

                    </a>
                    <a href="#" class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-200 dark:hover:text-primary-400 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors">
                        <?php echo e(__('common.nav.about')); ?>

                    </a>
                    <a href="#" class="px-3 py-2 text-sm font-medium text-slate-700 hover:text-primary-600 dark:text-slate-200 dark:hover:text-primary-400 rounded-lg hover:bg-slate-100 dark:hover:bg-white/5 transition-colors">
                        <?php echo e(__('common.nav.contact')); ?>

                    </a>
                </div>
            </div>

            <!-- Right Side -->
            <div class="flex items-center gap-2 sm:gap-3">
                <?php echo $__env->make('layouts.partials.theme-toggler', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php echo $__env->make('layouts.partials.language-switcher', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <!-- Auth Links -->
                <div class="hidden sm:flex sm:items-center sm:gap-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(url('/dashboard')); ?>" class="btn btn-ghost text-sm">
                        <?php echo e(__('common.nav.dashboard')); ?>

                    </a>
                    <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="btn btn-ghost text-sm">
                        <?php echo e(__('common.nav.login')); ?>

                    </a>
                    <a href="<?php echo e(route('register')); ?>" class="btn btn-primary text-sm">
                        <?php echo e(__('common.nav.register')); ?>

                    </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="lg:hidden inline-flex items-center justify-center p-2 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 dark:text-slate-400 dark:hover:text-white dark:hover:bg-white/5 transition-colors"
                    aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg x-show="!mobileMenuOpen" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="mobileMenuOpen" x-cloak class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="mobileMenuOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-1"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-1"
        class="lg:hidden border-t border-slate-200 dark:border-dark-border bg-white dark:bg-dark-base"
        style="display: none;">
        <div class="px-4 py-3 space-y-1">
            <a href="<?php echo e(url('/')); ?>" class="block px-3 py-2.5 rounded-lg text-base font-medium text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-white/5">
                <?php echo e(__('common.nav.home')); ?>

            </a>

            <!-- Mobile Services Dropdown -->
            <div x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center justify-between w-full px-3 py-2.5 rounded-lg text-base font-medium text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-white/5">
                    <?php echo e(__('common.nav.services')); ?>

                    <svg class="w-5 h-5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div x-show="open" x-collapse class="mt-1 ml-4 space-y-1">
                    <a href="#" class="block px-3 py-2 rounded-lg text-sm text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5">
                        SMM Panel
                    </a>
                    <a href="#" class="block px-3 py-2 rounded-lg text-sm text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5">
                        Verification
                    </a>
                    <a href="#" class="block px-3 py-2 rounded-lg text-sm text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/5">
                        Bot Services
                    </a>
                </div>
            </div>

            <a href="#" class="block px-3 py-2.5 rounded-lg text-base font-medium text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-white/5">
                <?php echo e(__('common.nav.pricing')); ?>

            </a>
            <a href="#" class="block px-3 py-2.5 rounded-lg text-base font-medium text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-white/5">
                <?php echo e(__('common.nav.about')); ?>

            </a>
            <a href="#" class="block px-3 py-2.5 rounded-lg text-base font-medium text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-white/5">
                <?php echo e(__('common.nav.contact')); ?>

            </a>
        </div>

        <!-- Mobile Auth -->
        <div class="px-4 py-4 border-t border-slate-200 dark:border-dark-border space-y-2">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(url('/dashboard')); ?>" class="block w-full btn btn-primary text-center">
                <?php echo e(__('common.nav.dashboard')); ?>

            </a>
            <?php else: ?>
            <a href="<?php echo e(route('login')); ?>" class="block w-full btn btn-outline text-center">
                <?php echo e(__('common.nav.login')); ?>

            </a>
            <a href="<?php echo e(route('register')); ?>" class="block w-full btn btn-primary text-center">
                <?php echo e(__('common.nav.register')); ?>

            </a>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</nav><?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/layouts/partials/navigation.blade.php ENDPATH**/ ?>
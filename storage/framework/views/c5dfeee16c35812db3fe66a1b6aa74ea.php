<?php
    $languages = \App\Services\LanguageService::getAvailableLanguages();
    $currentLocale = app()->getLocale();
    $currentLanguage = $languages[$currentLocale] ?? null;
?>

<div x-data="{ open: false }" class="relative">
    <button @click="open = !open"
        @click.away="open = false"
        class="flex items-center gap-1.5 px-2 py-2 rounded-lg text-slate-500 hover:text-slate-700 hover:bg-slate-100 dark:text-slate-400 dark:hover:text-white dark:hover:bg-white/10 transition-colors"
        aria-label="Select Language">

        <!-- Current Language Flag -->
        <span class="text-base"><img src="https://cdn.jsdelivr.net/gh/hampusborgos/country-flags@main/svg/<?php echo e($currentLanguage['flag']); ?>.svg" alt="<?php echo e($currentLanguage['native_name']); ?>" class="w-6 h-6"></span>
        <span class="text-sm font-medium uppercase hidden sm:inline"><?php echo e($currentLocale); ?></span>

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
        class="absolute right-0 mt-2 w-44 bg-white dark:bg-dark-elevated rounded-xl shadow-lg shadow-slate-200/50 dark:shadow-none border border-slate-200 dark:border-dark-border overflow-hidden z-50"
        style="display: none;">
        <div class="py-1">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $locale => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <a href="<?php echo e(route('language.switch', $locale)); ?>" 
                class="flex items-center gap-3 px-4 py-2.5 text-sm hover:bg-slate-50 dark:hover:bg-white/5 transition-colors <?php echo e($currentLocale === $locale ? 'text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20' : 'text-slate-700 dark:text-slate-200'); ?>">
                <span class="text-lg"><img src="https://cdn.jsdelivr.net/gh/hampusborgos/country-flags@main/svg/<?php echo e($lang['flag']); ?>.svg" alt="<?php echo e($lang['native_name']); ?>" class="w-6 h-6"></span>
                <span class="font-medium"><?php echo e($lang['native_name']); ?></span>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($currentLocale === $locale): ?>
                <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>
</div><?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/layouts/partials/language-switcher.blade.php ENDPATH**/ ?>
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($title ?? 'Untitled'); ?> - <?php echo e(setting('main.name', config('app.name'))); ?></title>
    <meta name="description" content="<?php echo e(setting('main.description', '')); ?>">

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(setting('main.favicon')): ?>
    <link rel="icon" href="<?php echo e(Storage::url(setting('main.favicon'))); ?>" type="image/x-icon">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>

<body class="font-sans antialiased h-full bg-slate-50 text-slate-900 dark:bg-dark-base dark:text-white"
    x-data="{ 
          sidebarOpen: false,
          init() {
              // Initialize theme from settings or localStorage
              const defaultTheme = '<?php echo e(setting('main.default_theme', 'system')); ?>';
              const savedTheme = localStorage.getItem('theme');
              
              if (savedTheme === 'dark' || (!savedTheme && defaultTheme === 'dark') || 
                  (!savedTheme && defaultTheme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                  document.documentElement.classList.add('dark');
              }
          }
      }"
    x-cloak>

    
    <?php echo $__env->make('layouts.partials.toast', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="min-h-full flex">
        <!-- Sidebar -->
        <?php echo $__env->make('layouts.partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <!-- Main Content Column -->
        <div class="flex-1 flex flex-col min-w-0 md:pl-64">
            <!-- Topbar -->
            <?php echo $__env->make('layouts.partials.topbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Optional Header -->
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($header)): ?>
            <header class="bg-white dark:bg-dark-elevated border-b border-slate-200 dark:border-dark-border">
                <div class="px-4 py-4 sm:px-6 md:px-8">
                    <?php echo e($header); ?>

                </div>
            </header>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <!-- Main Content -->
            <main class="flex-1 overflow-y-auto focus:outline-none p-4 md:p-6 lg:p-8">
                <?php echo $__env->make('layouts.partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php echo e($slot); ?>

            </main>
        </div>
    </div>
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('livewire-modal');

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2928940688-0', $key);

$__html = app('livewire')->mount($__name, $__params, $key, $__componentSlots);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    
    
    <script>
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then((registration) => {
                        console.log('[App] ServiceWorker registered:', registration.scope);
                    })
                    .catch((error) => {
                        console.error('[App] ServiceWorker registration failed:', error);
                    });
            });
        }
    </script>
</body>

</html><?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/layouts/app.blade.php ENDPATH**/ ?>
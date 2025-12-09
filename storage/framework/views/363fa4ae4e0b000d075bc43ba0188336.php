<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="h-full">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($title ?? 'Untitled'); ?> - <?php echo e(setting('main.name', config('app.name'))); ?></title>
    <meta name="description" content="<?php echo e($description ?? setting('main.description', '')); ?>">
    <meta name="keywords" content="<?php echo e($keywords ?? ''); ?>">

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(setting('main.favicon')): ?>
    <link rel="icon" href="<?php echo e(Storage::url(setting('main.favicon'))); ?>" type="image/x-icon">
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts & Styles -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>

<body class="font-sans antialiased text-slate-900 dark:text-white min-h-screen flex items-center justify-center relative overflow-hidden"
    x-data="{ 
          init() {
              const defaultTheme = '<?php echo e(setting('main.default_theme', 'system')); ?>';
              const savedTheme = localStorage.getItem('theme');
              
              if (savedTheme === 'dark' || (!savedTheme && defaultTheme === 'dark') || 
                  (!savedTheme && defaultTheme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                  document.documentElement.classList.add('dark');
              }
          }
      }"
    x-cloak>

    <!-- Background with gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-slate-50 via-white to-primary-50 dark:from-dark-base dark:via-dark-soft dark:to-dark-muted -z-10"></div>

    <!-- Decorative blobs -->
    <div class="absolute top-0 left-0 w-96 h-96 bg-primary-400/20 dark:bg-primary-500/10 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-secondary-400/20 dark:bg-secondary-500/10 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>

    <?php echo $__env->make('layouts.partials.toast', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="w-full max-w-md mx-4 sm:mx-auto">
        <!-- Logo -->
        <div class="text-center mb-6 sm:mb-8">
            <a href="<?php echo e(url('/')); ?>" class="inline-flex items-center gap-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(setting('main.logo')): ?>
                <img src="<?php echo e(Storage::url(setting('main.logo'))); ?>" alt="<?php echo e(setting('main.name', config('app.name'))); ?>" class="h-10 sm:h-12 w-auto">
                <?php else: ?>
                <span class="text-2xl sm:text-3xl font-bold text-gradient-primary">
                    <?php echo e(setting('main.name', config('app.name'))); ?>

                </span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </a>
        </div>

        <!-- Card -->
        <div class="bg-white/80 dark:bg-dark-elevated/80 backdrop-blur-xl shadow-xl shadow-slate-200/50 dark:shadow-none rounded-2xl border border-slate-200/50 dark:border-dark-border overflow-hidden">
            <div class="p-4">
                <?php echo $__env->make('layouts.partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
                
            <?php echo e($slot); ?>

        </div>

        <!-- Theme Toggle -->
        <div class="flex justify-center mt-6">
            <?php echo $__env->make('layouts.partials.theme-toggler', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
</body>

</html><?php /**PATH D:\Installed\Apps\laragon\www\gramsea\resources\views/layouts/plain.blade.php ENDPATH**/ ?>
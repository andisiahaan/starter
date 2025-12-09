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

<body class="font-sans antialiased text-slate-900 bg-white dark:bg-dark-base dark:text-white flex flex-col min-h-screen"
    x-data="{ 
          mobileMenuOpen: false,
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

    <?php echo $__env->make('layouts.partials.toast', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php echo $__env->make('layouts.partials.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Optional Header -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($header)): ?>
    <header class="bg-gradient-to-r from-primary-600 to-primary-700 dark:from-dark-elevated dark:to-dark-muted">
        <div class="max-w-7xl mx-auto px-4 py-8 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
            <?php echo e($header); ?>

        </div>
    </header>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    <main class="flex-grow">
        <?php echo $__env->make('layouts.partials.alert', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo e($slot); ?>

    </main>

    <?php echo $__env->make('layouts.partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <script src="//unpkg.com/alpinejs" defer></script>
</body>

</html><?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/layouts/main.blade.php ENDPATH**/ ?>
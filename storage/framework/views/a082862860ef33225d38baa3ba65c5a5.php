<footer class="bg-white dark:bg-dark-soft border-t border-slate-200 dark:border-dark-border mt-auto">
    <div class="px-4 py-4 md:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 text-center sm:text-left">
            <p class="text-sm text-slate-500 dark:text-slate-400">
                &copy; <?php echo e(date('Y')); ?> <?php echo e(setting('main.name', config('app.name'))); ?>. All rights reserved.
            </p>
            <div class="flex items-center justify-center sm:justify-end gap-4">
                <span class="text-xs text-slate-400 dark:text-slate-500">
                    v<?php echo e(config('app.version', '1.0.0')); ?>

                </span>
                <a href="#" class="text-sm text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
                    Documentation
                </a>
                <a href="#" class="text-sm text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition-colors">
                    Support
                </a>
            </div>
        </div>
    </div>
</footer><?php /**PATH D:\Installed\Apps\laragon\www\gramsea\resources\views/admin/layouts/partials/footer.blade.php ENDPATH**/ ?>
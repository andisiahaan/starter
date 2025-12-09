<?php if (isset($component)) { $__componentOriginal58d4f08fcba9bdce9e2c67f691ab9981 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal58d4f08fcba9bdce9e2c67f691ab9981 = $attributes; } ?>
<?php $component = App\View\Components\Layouts\Main::resolve(['title' => $page->title,'description' => $page->meta_description ?? ''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.main'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Layouts\Main::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="py-12 lg:py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <article class="bg-white dark:bg-dark-elevated rounded-2xl shadow-lg border border-slate-200 dark:border-dark-border overflow-hidden">
                <div class="px-6 py-8 sm:px-8 sm:py-10 lg:px-12 lg:py-12">
                    <!-- Page Title -->
                    <h1 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-8">
                        <?php echo e($page->title); ?>

                    </h1>
                    
                    <!-- Page Content -->
                    <div class="prose prose-lg prose-slate dark:prose-invert max-w-none
                        prose-headings:font-semibold prose-headings:text-slate-900 dark:prose-headings:text-white
                        prose-h2:text-xl prose-h2:mt-8 prose-h2:mb-4
                        prose-h3:text-lg prose-h3:mt-6 prose-h3:mb-3
                        prose-p:text-slate-600 dark:prose-p:text-slate-300 prose-p:leading-relaxed
                        prose-a:text-primary-600 dark:prose-a:text-primary-400 prose-a:no-underline hover:prose-a:underline
                        prose-li:text-slate-600 dark:prose-li:text-slate-300
                        prose-strong:text-slate-900 dark:prose-strong:text-white">
                        <?php echo $page->content; ?>

                    </div>
                </div>
                
                <!-- Last Updated -->
                <div class="px-6 py-4 sm:px-8 lg:px-12 bg-slate-50 dark:bg-dark-soft border-t border-slate-200 dark:border-dark-border">
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        <span class="font-medium">Last updated:</span> 
                        <?php echo e($page->updated_at->format('F j, Y')); ?>

                    </p>
                </div>
            </article>

            <!-- Back to Home -->
            <div class="mt-8 text-center">
                <a href="<?php echo e(url('/')); ?>" class="inline-flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal58d4f08fcba9bdce9e2c67f691ab9981)): ?>
<?php $attributes = $__attributesOriginal58d4f08fcba9bdce9e2c67f691ab9981; ?>
<?php unset($__attributesOriginal58d4f08fcba9bdce9e2c67f691ab9981); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal58d4f08fcba9bdce9e2c67f691ab9981)): ?>
<?php $component = $__componentOriginal58d4f08fcba9bdce9e2c67f691ab9981; ?>
<?php unset($__componentOriginal58d4f08fcba9bdce9e2c67f691ab9981); ?>
<?php endif; ?><?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/pages/show.blade.php ENDPATH**/ ?>
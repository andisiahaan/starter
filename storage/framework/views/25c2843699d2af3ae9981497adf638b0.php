<?php if (isset($component)) { $__componentOriginal58d4f08fcba9bdce9e2c67f691ab9981 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal58d4f08fcba9bdce9e2c67f691ab9981 = $attributes; } ?>
<?php $component = App\View\Components\Layouts\Main::resolve(['title' => __('blog.title')] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.main'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Layouts\Main::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-slate-900 dark:text-white mb-4"><?php echo e(__('blog.title')); ?></h1>
            <p class="text-lg text-slate-600 dark:text-slate-400 max-w-2xl mx-auto"><?php echo e(__('blog.subtitle')); ?></p>
        </div>

        <!-- Featured Posts -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($featuredPosts->isNotEmpty()): ?>
        <div class="mb-16">
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white mb-6"><?php echo e(__('blog.featured_posts')); ?></h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $featuredPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <a href="<?php echo e(route('blog.show', $post->slug)); ?>" class="group block bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border overflow-hidden hover:shadow-lg transition">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->featured_image): ?>
                    <img src="<?php echo e(Storage::url($post->featured_image)); ?>" alt="<?php echo e($post->title); ?>" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                    <?php else: ?>
                    <div class="w-full h-48 bg-gradient-to-br from-primary-500 to-primary-700 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-3">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->primary_category): ?>
                            <span class="px-2 py-1 text-xs font-medium bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 rounded"><?php echo e($post->primary_category->name); ?></span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <span class="text-xs text-slate-500 dark:text-slate-400"><?php echo e($post->published_at->format('M d, Y')); ?></span>
                        </div>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition"><?php echo e($post->title); ?></h3>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->excerpt): ?>
                        <p class="mt-2 text-sm text-slate-600 dark:text-slate-400 line-clamp-2"><?php echo e($post->excerpt); ?></p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </a>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-slate-900 dark:text-white"><?php echo e(__('blog.latest_posts')); ?></h2>
                    <form action="<?php echo e(route('blog.index')); ?>" method="GET" class="relative">
                        <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="<?php echo e(__('blog.public.search')); ?>" class="pl-10 pr-4 py-2 rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 text-sm">
                        <svg class="w-5 h-5 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </form>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <a href="<?php echo e(route('blog.show', $post->slug)); ?>" class="group block bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border overflow-hidden hover:shadow-lg hover:border-primary-500/30 transition">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->featured_image): ?>
                        <img src="<?php echo e(Storage::url($post->featured_image)); ?>" alt="<?php echo e($post->title); ?>" class="w-full h-40 object-cover">
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <div class="p-5">
                            <div class="flex items-center gap-2 mb-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->primary_category): ?>
                                <span class="px-2 py-0.5 text-xs font-medium bg-slate-100 dark:bg-dark-soft text-slate-600 dark:text-slate-400 rounded"><?php echo e($post->primary_category->name); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <span class="text-xs text-slate-500 dark:text-slate-400"><?php echo e(__('blog.public.reading_time', ['count' => $post->reading_time])); ?></span>
                            </div>
                            <h3 class="font-semibold text-slate-900 dark:text-white group-hover:text-primary-600 dark:group-hover:text-primary-400 transition line-clamp-2"><?php echo e($post->title); ?></h3>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($post->excerpt): ?>
                            <p class="mt-2 text-sm text-slate-600 dark:text-slate-400 line-clamp-2"><?php echo e($post->excerpt); ?></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <div class="flex items-center gap-2 mt-4 pt-4 border-t border-slate-100 dark:border-dark-border">
                                <span class="text-xs text-slate-500 dark:text-slate-400"><?php echo e($post->author->name ?? 'Unknown'); ?></span>
                                <span class="text-slate-300 dark:text-slate-600">•</span>
                                <span class="text-xs text-slate-500 dark:text-slate-400"><?php echo e($post->published_at->format('M d, Y')); ?></span>
                            </div>
                        </div>
                    </a>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="col-span-2 text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        <p class="text-slate-500 dark:text-slate-400"><?php echo e(__('blog.public.no_posts')); ?></p>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="mt-8">
                    <?php echo e($posts->links()); ?>

                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Categories -->
                <div class="bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border p-5">
                    <h3 class="font-semibold text-slate-900 dark:text-white mb-4"><?php echo e(__('blog.public.categories')); ?></h3>
                    <ul class="space-y-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <li>
                            <a href="<?php echo e(route('blog.category', $category->slug)); ?>" class="flex items-center justify-between text-sm text-slate-600 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 transition">
                                <span><?php echo e($category->name); ?></span>
                                <span class="px-2 py-0.5 bg-slate-100 dark:bg-dark-soft rounded text-xs"><?php echo e($category->posts_count); ?></span>
                            </a>
                        </li>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </ul>
                </div>

                <!-- Tags -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($tags->isNotEmpty()): ?>
                <div class="bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border p-5">
                    <h3 class="font-semibold text-slate-900 dark:text-white mb-4"><?php echo e(__('blog.public.tags')); ?></h3>
                    <div class="flex flex-wrap gap-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <a href="<?php echo e(route('blog.tag', $tag->slug)); ?>" class="px-3 py-1 text-xs bg-slate-100 dark:bg-dark-soft text-slate-600 dark:text-slate-400 rounded-full hover:bg-primary-100 hover:text-primary-700 dark:hover:bg-primary-900/30 dark:hover:text-primary-400 transition">
                            <?php echo e($tag->name); ?>

                        </a>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
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
<?php endif; ?>
<?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/blog/index.blade.php ENDPATH**/ ?>
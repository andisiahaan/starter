<div>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.product_categories.title')); ?></h1>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400"><?php echo e(__('admin.product_categories.description')); ?></p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <button wire:click="$dispatch('openModal', { component: 'admin.product-categories.modals.create-edit-category-modal' })" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                <?php echo e(__('admin.product_categories.add')); ?>

            </button>
        </div>
    </div>

    <!-- Search -->
    <div class="mt-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="<?php echo e(__('admin.product_categories.filters.search')); ?>"
            class="block w-full sm:w-64 rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm">
    </div>

    <!-- Table -->
    <div class="mt-6 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-slate-200 dark:ring-dark-border md:rounded-lg">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
                        <thead class="bg-slate-50 dark:bg-dark-soft">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 dark:text-white sm:pl-6"><?php echo e(__('admin.product_categories.table.name')); ?></th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.product_categories.table.slug')); ?></th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.product_categories.table.products')); ?></th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.product_categories.table.status')); ?></th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only"><?php echo e(__('common.table.actions')); ?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-dark-border bg-white dark:bg-dark-base">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <tr class="hover:bg-slate-50 dark:hover:bg-dark-elevated transition-colors">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-slate-900 dark:text-white sm:pl-6">
                                    <?php echo e($category->name); ?>

                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-600 dark:text-slate-300">
                                    <code class="text-xs bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 px-2 py-1 rounded"><?php echo e($category->slug); ?></code>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-600 dark:text-slate-300">
                                    <?php echo e($category->products_count ?? $category->products()->count()); ?>

                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <button wire:click="toggleActive(<?php echo e($category->id); ?>)" class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium <?php echo e($category->is_active ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300'); ?>">
                                        <?php echo e($category->is_active ? __('admin.product_categories.status.active') : __('admin.product_categories.status.inactive')); ?>

                                    </button>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <button wire:click="$dispatch('openModal', { component: 'admin.product-categories.modals.create-edit-category-modal', arguments: { categoryId: <?php echo e($category->id); ?> } })" class="text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300 mr-3"><?php echo e(__('common.actions.edit')); ?></button>
                                    <button wire:click="delete(<?php echo e($category->id); ?>)" wire:confirm="<?php echo e(__('admin.product_categories.confirm_delete')); ?>" class="text-red-600 dark:text-red-400 hover:text-red-500 dark:hover:text-red-300"><?php echo e(__('common.actions.delete')); ?></button>
                                </td>
                            </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-500 dark:text-slate-400">
                                    <?php echo e(__('admin.product_categories.empty')); ?>

                                </td>
                            </tr>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <?php echo e($categories->links()); ?>

    </div>
</div><?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/admin/livewire/product-categories/index.blade.php ENDPATH**/ ?>
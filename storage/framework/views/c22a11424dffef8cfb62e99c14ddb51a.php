<div>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.payment_methods_index.title')); ?></h1>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400"><?php echo e(__('admin.payment_methods_index.description')); ?></p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <button wire:click="$dispatch('openModal', { component: 'admin.payment-methods.modals.create-edit-payment-method-modal' })" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2">
                <?php echo e(__('admin.payment_methods_index.add')); ?>

            </button>
        </div>
    </div>

    <!-- Filters -->
    <div class="mt-4 flex flex-col sm:flex-row gap-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="<?php echo e(__('admin.payment_methods_index.filters.search')); ?>"
            class="block w-full sm:w-64 rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm">
        <select wire:model.live="providerFilter" class="block w-full sm:w-40 rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm">
            <option value=""><?php echo e(__('admin.payment_methods_index.filters.all_providers')); ?></option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $providers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <option value="<?php echo e($key); ?>"><?php echo e($label); ?></option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </select>
        <select wire:model.live="typeFilter" class="block w-full sm:w-48 rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm">
            <option value=""><?php echo e(__('admin.payment_methods_index.filters.all_types')); ?></option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <option value="<?php echo e($key); ?>"><?php echo e($label); ?></option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </select>
    </div>

    <!-- Table -->
    <div class="mt-6 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-slate-200 dark:ring-dark-border md:rounded-lg">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
                        <thead class="bg-slate-50 dark:bg-dark-soft">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 dark:text-white sm:pl-6"><?php echo e(__('admin.payment_methods_index.table.payment_method')); ?></th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.payment_methods_index.table.provider')); ?></th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.payment_methods_index.table.type')); ?></th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.payment_methods_index.table.limits')); ?></th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.payment_methods_index.table.fees')); ?></th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.payment_methods_index.table.status')); ?></th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only"><?php echo e(__('common.table.actions')); ?></span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-dark-border bg-white dark:bg-dark-base">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <tr class="hover:bg-slate-50 dark:hover:bg-dark-elevated transition-colors">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 sm:pl-6">
                                    <div class="text-sm font-medium text-slate-900 dark:text-white"><?php echo e($method->name); ?></div>
                                    <div class="text-xs text-slate-500 dark:text-slate-400">
                                        <code class="bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 px-1 rounded"><?php echo e($method->code); ?></code>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium <?php echo e($method->provider === 'TRIPAY' ? 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400' : 'bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400'); ?>">
                                        <?php echo e($providers[$method->provider] ?? $method->provider); ?>

                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400">
                                        <?php echo e($types[$method->type] ?? $method->type); ?>

                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-600 dark:text-slate-300">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($method->min_amount || $method->max_amount): ?>
                                    <div class="text-xs">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($method->min_amount): ?>
                                        <?php echo e(__('admin.payment_methods_index.limits.min')); ?>: Rp <?php echo e(number_format($method->min_amount, 0, ',', '.')); ?>

                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($method->max_amount): ?>
                                        <br><?php echo e(__('admin.payment_methods_index.limits.max')); ?>: Rp <?php echo e(number_format($method->max_amount, 0, ',', '.')); ?>

                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <?php else: ?>
                                    <span class="text-slate-400 dark:text-slate-500">-</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-600 dark:text-slate-300">
                                    <div class="text-xs">
                                        <?php if($method->fee_flat > 0): ?>
                                        <?php echo e(__('admin.payment_methods_index.fees.flat')); ?>: Rp <?php echo e(number_format($method->fee_flat, 0, ',', '.')); ?>

                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($method->fee_percent > 0): ?>
                                        <br><?php echo e($method->fee_percent); ?>%
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$method->fee_flat && !$method->fee_percent): ?>
                                        <span class="text-slate-400 dark:text-slate-500">-</span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <button wire:click="toggleActive(<?php echo e($method->id); ?>)" class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium <?php echo e($method->is_active ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300'); ?>">
                                        <?php echo e($method->is_active ? __('admin.payment_methods_index.status.active') : __('admin.payment_methods_index.status.inactive')); ?>

                                    </button>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <button wire:click="$dispatch('openModal', { component: 'admin.payment-methods.modals.create-edit-payment-method-modal', arguments: { paymentMethodId: <?php echo e($method->id); ?> } })" class="text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300 mr-3"><?php echo e(__('common.actions.edit')); ?></button>
                                    <button wire:click="delete(<?php echo e($method->id); ?>)" wire:confirm="<?php echo e(__('admin.payment_methods_index.confirm_delete')); ?>" class="text-red-600 dark:text-red-400 hover:text-red-500 dark:hover:text-red-300"><?php echo e(__('common.actions.delete')); ?></button>
                                </td>
                            </tr>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-sm text-slate-500 dark:text-slate-400">
                                    <?php echo e(__('admin.payment_methods_index.empty')); ?>

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
        <?php echo e($methods->links()); ?>

    </div>
</div><?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/admin/livewire/payment-methods/index.blade.php ENDPATH**/ ?>
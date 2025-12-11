<div>
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white"><?php echo e(__('orders.title')); ?></h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400"><?php echo e(__('orders.subtitle')); ?></p>
        </div>
        <a href="<?php echo e(route('app.credits.index')); ?>" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
            <?php echo e(__('orders.buy_credits')); ?>

        </a>
    </div>

    <!-- Filter -->
    <div class="mb-4">
        <select wire:model.live="statusFilter" class="block w-full sm:w-48 rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-dark-elevated dark:border-dark-border dark:text-white sm:text-sm">
            <option value=""><?php echo e(__('orders.filter.all_status')); ?></option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <option value="<?php echo e($key); ?>"><?php echo e($label); ?></option>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </select>
    </div>

    <!-- Orders List -->
    <div class="space-y-4">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-gray-200 dark:border-dark-border overflow-hidden">
            <div class="p-4 sm:p-5">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 flex-wrap">
                            <span class="text-sm font-medium text-gray-900 dark:text-white"><?php echo e($order->order_number); ?></span>
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium <?php echo e($statusColors[$order->status] ?? ''); ?>">
                                <?php echo e($statuses[$order->status] ?? ucfirst($order->status)); ?>

                            </span>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->credit_given_at): ?>
                            <span class="inline-flex items-center text-xs text-green-600 dark:text-green-400">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <?php echo e(__('orders.list.credit_added')); ?>

                            </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <div class="mt-2">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white"><?php echo e($order->product_name); ?></h3>
                            <p class="text-sm text-primary-600 dark:text-primary-400"><?php echo e(__('orders.list.credits', ['amount' => number_format($order->credit_amount, 0, ',', '.')])); ?></p>
                        </div>
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400"><?php echo e($order->created_at->format('M d, Y H:i')); ?></p>
                    </div>
                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <p class="text-sm text-gray-500 dark:text-gray-400"><?php echo e(__('orders.list.total')); ?></p>
                            <p class="text-xl font-bold text-gray-900 dark:text-white">Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></p>
                        </div>
                        <button wire:click="showDetail(<?php echo e($order->id); ?>)" class="px-4 py-2 text-sm font-medium text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 border border-primary-600 dark:border-primary-400 rounded-lg hover:bg-primary-50 dark:hover:bg-primary-900/20 transition-colors">
                            <?php echo e(__('orders.list.details')); ?>

                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-gray-200 dark:border-dark-border p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white"><?php echo e(__('orders.empty.title')); ?></h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400"><?php echo e(__('orders.empty.description')); ?></p>
            <a href="<?php echo e(route('app.credits.index')); ?>" class="mt-4 inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                <?php echo e(__('orders.buy_credits')); ?>

            </a>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <div class="mt-4">
        <?php echo e($orders->links()); ?>

    </div>

    <!-- Detail Modal -->
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($showDetailModal && $selectedOrder): ?>
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-gray-500/75 dark:bg-black/75 transition-opacity" wire:click="closeModal"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div class="relative inline-block align-bottom bg-white dark:bg-dark-elevated rounded-xl px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full sm:p-6">
                <div class="absolute top-0 right-0 pt-4 pr-4">
                    <button wire:click="closeModal" type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white"><?php echo e(__('orders.detail.title')); ?></h3>
                    <div class="mt-4 space-y-4">
                        <div class="flex justify-between items-start pb-3 border-b border-gray-100 dark:border-dark-border">
                            <div>
                                <p class="text-sm text-gray-500 dark:text-gray-400"><?php echo e(__('orders.detail.order_number')); ?></p>
                                <p class="font-medium text-gray-900 dark:text-white"><?php echo e($selectedOrder->order_number); ?></p>
                            </div>
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium <?php echo e($statusColors[$selectedOrder->status] ?? ''); ?>">
                                <?php echo e($statuses[$selectedOrder->status] ?? ucfirst($selectedOrder->status)); ?>

                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-gray-500 dark:text-gray-400"><?php echo e(__('orders.detail.product')); ?></p>
                                <p class="font-medium text-gray-900 dark:text-white"><?php echo e($selectedOrder->product_name); ?></p>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400"><?php echo e(__('orders.detail.credits')); ?></p>
                                <p class="font-medium text-primary-600 dark:text-primary-400"><?php echo e(number_format($selectedOrder->credit_amount, 0, ',', '.')); ?></p>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400"><?php echo e(__('orders.detail.payment_method')); ?></p>
                                <p class="font-medium text-gray-900 dark:text-white"><?php echo e($selectedOrder->paymentMethod?->name ?? $selectedOrder->payment_method_code ?? 'N/A'); ?></p>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400"><?php echo e(__('orders.detail.total')); ?></p>
                                <p class="font-bold text-gray-900 dark:text-white">Rp <?php echo e(number_format($selectedOrder->total_amount, 0, ',', '.')); ?></p>
                            </div>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400"><?php echo e(__('orders.detail.created')); ?></p>
                                <p class="font-medium text-gray-900 dark:text-white"><?php echo e($selectedOrder->created_at->format('M d, Y H:i')); ?></p>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedOrder->verified_at): ?>
                            <div>
                                <p class="text-gray-500 dark:text-gray-400"><?php echo e(__('orders.detail.verified')); ?></p>
                                <p class="font-medium text-green-600 dark:text-green-400"><?php echo e($selectedOrder->verified_at->format('M d, Y H:i')); ?></p>
                            </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedOrder->credit_given_at): ?>
                        <div class="mt-4 p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <div class="flex items-center text-green-700 dark:text-green-300">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <span class="font-medium"><?php echo e(__('orders.detail.credits_added_on', ['date' => $selectedOrder->credit_given_at->format('M d, Y H:i')])); ?></span>
                            </div>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <div class="mt-6 pt-4 border-t border-gray-100 dark:border-dark-border">
                            <a href="<?php echo e(route('app.orders.show', $selectedOrder)); ?>" class="w-full inline-flex justify-center items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <?php echo e(__('orders.detail.view_full')); ?>

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div><?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/livewire/app/orders/index.blade.php ENDPATH**/ ?>
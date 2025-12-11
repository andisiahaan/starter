<div>
    <!-- Credit Balance Card -->
    <div class="bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl shadow-lg overflow-hidden mb-8">
        <div class="px-6 py-8 sm:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-primary-100 text-sm font-medium"><?php echo e(__('credits.user.balance.label')); ?></p>
                    <p class="text-4xl font-bold text-white mt-1"><?php echo e(number_format($user->credit, 0, ',', '.')); ?></p>
                    <p class="text-primary-200 text-sm mt-1"><?php echo e(__('credits.user.balance.available')); ?></p>
                </div>
                <div class="bg-white/10 rounded-full p-4">
                    <svg class="w-10 h-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <a href="<?php echo e(route('app.credits.history')); ?>" class="inline-flex items-center px-4 py-2 bg-white/20 text-white text-sm font-medium rounded-lg hover:bg-white/30 transition-colors">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <?php echo e(__('credits.user.actions.view_history')); ?>

                </a>
                <a href="<?php echo e(route('app.orders.index')); ?>" class="inline-flex items-center px-4 py-2 bg-white/20 text-white text-sm font-medium rounded-lg hover:bg-white/30 transition-colors">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <?php echo e(__('credits.user.actions.my_orders')); ?>

                </a>
            </div>
        </div>
    </div>

    <!-- Available Credit Packages -->
    <div>
        <h2 class="text-xl font-semibold text-slate-900 dark:text-white mb-4"><?php echo e(__('credits.user.products.title')); ?></h2>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($products->count() > 0): ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-5">
                    <div class="flex items-start justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-white"><?php echo e($product->name); ?></h3>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->category): ?>
                            <span class="inline-flex items-center rounded-full bg-primary-50 dark:bg-primary-900/30 px-2 py-0.5 text-xs font-medium text-primary-700 dark:text-primary-300 mt-1">
                                <?php echo e($product->category->name); ?>

                            </span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->bonus_credit > 0): ?>
                        <span class="inline-flex items-center rounded-full bg-green-100 dark:bg-green-900/30 px-2.5 py-1 text-xs font-medium text-green-700 dark:text-green-400">
                            <?php echo e(__('credits.user.products.bonus', ['amount' => number_format($product->bonus_credit, 0, ',', '.')])); ?>

                        </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->description): ?>
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400"><?php echo e(Str::limit($product->description, 80)); ?></p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="mt-4 flex items-baseline gap-2">
                        <span class="text-3xl font-bold text-primary-600 dark:text-primary-400"><?php echo e(number_format($product->credit_amount, 0, ',', '.')); ?></span>
                        <span class="text-slate-500 dark:text-slate-400 text-sm"><?php echo e(__('credits.user.products.credits')); ?></span>
                    </div>

                    <div class="mt-4 pt-4 border-t border-slate-100 dark:border-dark-border flex items-center justify-between">
                        <div>
                            <span class="text-2xl font-bold text-slate-900 dark:text-white">Rp <?php echo e(number_format($product->price, 0, ',', '.')); ?></span>
                        </div>
                        <button
                            wire:click="$dispatch('openPurchaseModal', { productId: <?php echo e($product->id); ?> })"
                            class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                            <?php echo e(__('credits.user.products.buy_now')); ?>

                        </button>
                    </div>
                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
        <?php else: ?>
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-slate-900 dark:text-white"><?php echo e(__('credits.user.products.empty_title')); ?></h3>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400"><?php echo e(__('credits.user.products.empty_desc')); ?></p>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <!-- Purchase Modal Component -->
    <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('app.credits.modals.purchase-confirm');

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2299830242-0', $key);

$__html = app('livewire')->mount($__name, $__params, $key, $__componentSlots);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
</div><?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/livewire/app/credits/index.blade.php ENDPATH**/ ?>
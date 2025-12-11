<div>
    <!-- Purchase Modal -->
    <div x-data="{ open: false }"
        x-on:show-purchase-modal.window="open = true"
        x-on:close-purchase-modal.window="open = false"
        x-show="open"
        x-cloak
        class="fixed inset-0 z-50 overflow-y-auto"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true">

        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/75 transition-opacity"
                @click="$wire.closeModal()"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <!-- Modal Content -->
            <div x-show="open"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative inline-block align-bottom bg-dark-elevated rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-dark-border">

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product): ?>
                <!-- Header -->
                <div class="px-6 py-4 border-b border-dark-border bg-dark-soft">
                    <h3 class="text-lg font-semibold text-white"><?php echo e(__('credits.user.purchase.title')); ?></h3>
                    <p class="mt-1 text-sm text-slate-400"><?php echo e(__('credits.user.purchase.subtitle')); ?></p>
                </div>

                <!-- Body -->
                <div class="px-6 py-5 space-y-5">
                    <!-- Product Info -->
                    <div class="bg-dark-soft rounded-xl p-4 border border-dark-border">
                        <div class="flex items-start justify-between">
                            <div>
                                <h4 class="font-semibold text-white"><?php echo e($product->name); ?></h4>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->description): ?>
                                <p class="mt-1 text-sm text-slate-400 line-clamp-2"><?php echo e($product->description); ?></p>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <div class="text-right">
                                <p class="text-2xl font-bold text-primary-400"><?php echo e(number_format($product->total_credit, 0, ',', '.')); ?></p>
                                <p class="text-xs text-slate-500"><?php echo e(__('credits.user.purchase.credits_label')); ?></p>
                            </div>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->bonus_credit > 0): ?>
                        <div class="mt-3 inline-flex items-center px-2.5 py-1 rounded-full bg-green-900/30 text-green-400 text-xs font-medium">
                            <svg class="w-3.5 h-3.5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                            <?php echo e(__('credits.user.purchase.bonus', ['amount' => number_format($product->bonus_credit, 0, ',', '.')])); ?>

                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <!-- Payment Method Selection -->
                    <div>
                        <label class="block text-sm font-medium text-slate-300 mb-3"><?php echo e(__('credits.user.purchase.select_payment')); ?></label>
                        <div class="space-y-2 max-h-60 overflow-y-auto custom-scrollbar">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $paymentMethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <label class="flex items-center p-3 rounded-xl border cursor-pointer transition-all <?php echo e($paymentMethodId == $method->id ? 'border-primary-500 bg-primary-500/10' : 'border-dark-border hover:border-primary-500/50 hover:bg-dark-soft'); ?>">
                                <input type="radio" wire:model.live="paymentMethodId" value="<?php echo e($method->id); ?>" class="sr-only">
                                <div class="flex-1 flex items-center gap-3">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($method->logo): ?>
                                    <img src="<?php echo e(Storage::url($method->logo)); ?>" alt="<?php echo e($method->name); ?>" class="w-10 h-10 object-contain rounded-lg bg-white p-1">
                                    <?php else: ?>
                                    <div class="w-10 h-10 rounded-lg bg-primary-900/30 flex items-center justify-center">
                                        <svg class="w-5 h-5 text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                        </svg>
                                    </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2">
                                            <p class="font-medium text-white text-sm"><?php echo e($method->name); ?></p>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($method->isTripay()): ?>
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-blue-900/30 text-blue-400"><?php echo e(__('credits.user.purchase.auto')); ?></span>
                                            <?php else: ?>
                                            <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs font-medium bg-amber-900/30 text-amber-400"><?php echo e(__('credits.user.purchase.manual')); ?></span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                        <p class="text-xs text-slate-500">
                                            <?php if($method->fee_flat > 0 || $method->fee_percent > 0): ?>
                                            <?php echo e(__('credits.user.purchase.fee')); ?>

                                            <?php if($method->fee_flat > 0): ?>
                                            Rp <?php echo e(number_format($method->fee_flat, 0, ',', '.')); ?>

                                            <?php endif; ?>
                                            <?php if($method->fee_percent > 0): ?>
                                            <?php echo e($method->fee_flat > 0 ? ' + ' : ''); ?><?php echo e($method->fee_percent); ?>%
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                            <?php else: ?>
                                            <?php echo e(__('credits.user.purchase.no_fee')); ?>

                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center <?php echo e($paymentMethodId == $method->id ? 'border-primary-500 bg-primary-500' : 'border-slate-600'); ?>">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paymentMethodId == $method->id): ?>
                                    <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </label>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>

                    <!-- Pricing Summary -->
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($paymentMethodId): ?>
                    <div class="bg-dark-soft rounded-xl p-4 border border-dark-border space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-400"><?php echo e(__('credits.user.purchase.subtotal')); ?></span>
                            <span class="text-white">Rp <?php echo e(number_format($pricing['subtotal'], 0, ',', '.')); ?></span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-400"><?php echo e(__('credits.user.purchase.payment_fee')); ?></span>
                            <span class="text-white">Rp <?php echo e(number_format($pricing['fee'], 0, ',', '.')); ?></span>
                        </div>
                        <div class="border-t border-dark-border pt-3 flex justify-between">
                            <span class="font-medium text-white"><?php echo e(__('credits.user.purchase.total')); ?></span>
                            <span class="text-xl font-bold text-primary-400">Rp <?php echo e(number_format($pricing['total'], 0, ',', '.')); ?></span>
                        </div>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <!-- Error Message -->
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errorMessage): ?>
                    <div class="p-3 rounded-lg bg-red-900/20 border border-red-700/50">
                        <p class="text-sm text-red-400"><?php echo e($errorMessage); ?></p>
                    </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 border-t border-dark-border bg-dark-soft flex gap-3">
                    <button wire:click="closeModal" type="button" class="flex-1 px-4 py-2.5 rounded-lg border border-dark-border text-slate-300 font-medium hover:bg-dark-muted transition-colors">
                        <?php echo e(__('credits.user.purchase.cancel')); ?>

                    </button>
                    <button
                        wire:click="purchase"
                        wire:loading.attr="disabled"
                        :disabled="!<?php echo e($paymentMethodId ? 'true' : 'false'); ?>"
                        class="flex-1 px-4 py-2.5 rounded-lg bg-primary-600 text-white font-medium hover:bg-primary-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                        <span wire:loading.remove wire:target="purchase">
                            <?php echo e(__('credits.user.purchase.pay_now')); ?>

                        </span>
                        <span wire:loading wire:target="purchase" class="flex items-center gap-2">
                            <svg class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <?php echo e(__('credits.user.purchase.processing')); ?>

                        </span>
                    </button>
                </div>
                <?php else: ?>
                <div class="px-6 py-12 text-center">
                    <p class="text-slate-400"><?php echo e(__('credits.user.purchase.loading')); ?></p>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/livewire/app/credits/modals/purchase-confirm.blade.php ENDPATH**/ ?>
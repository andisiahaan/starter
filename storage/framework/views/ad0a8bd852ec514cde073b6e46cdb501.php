<div>
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <a href="<?php echo e(route('app.orders.index')); ?>" class="inline-flex items-center text-sm text-slate-400 hover:text-white transition-colors mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <?php echo e(__('orders.show.back')); ?>

            </a>
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white"><?php echo e(__('orders.show.title', ['number' => $order->order_number])); ?></h1>
                    <p class="mt-1 text-sm text-slate-400"><?php echo e(__('orders.show.created_at', ['date' => $order->created_at->format('M d, Y H:i')])); ?></p>
                </div>
                <span class="px-3 py-1.5 rounded-full text-sm font-medium 
                    <?php if($order->status === 'verified'): ?> bg-green-900/30 text-green-400
                    <?php elseif($order->status === 'pending'): ?> bg-yellow-900/30 text-yellow-400
                    <?php elseif($order->status === 'failed'): ?> bg-red-900/30 text-red-400
                    <?php else: ?> bg-slate-700 text-slate-300
                    <?php endif; ?>">
                    <?php echo e(__('orders.status.' . $order->status)); ?>

                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Payment Section (2 columns) -->
            <div class="lg:col-span-2 space-y-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->status === 'pending'): ?>
                <!-- Payment Info Card -->
                <div class="bg-dark-elevated rounded-2xl border border-dark-border overflow-hidden">
                    <div class="px-6 py-4 border-b border-dark-border bg-dark-soft">
                        <h2 class="text-lg font-semibold text-white"><?php echo e(__('orders.show.payment.complete')); ?></h2>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->expires_at): ?>
                        <p class="mt-1 text-sm text-slate-400">
                            <?php echo e(__('orders.show.payment.expires')); ?>

                            <span class="text-yellow-400 font-medium"><?php echo e($order->expires_at->format('M d, Y H:i')); ?></span>
                            <span class="text-slate-500">(<?php echo e($order->expires_at->diffForHumans()); ?>)</span>
                        </p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <div class="p-6 space-y-6">
                        <!-- QR Code Section -->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasQrUrl): ?>
                        <div class="text-center">
                            <p class="text-sm text-slate-400 mb-4"><?php echo e(__('orders.show.payment.scan_qr')); ?></p>
                            <div class="inline-block p-4 bg-white rounded-2xl shadow-lg">
                                <img src="<?php echo e($paymentDetails['qr_url']); ?>" alt="QR Payment" class="w-64 h-64 object-contain">
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($paymentDetails['qr_string'])): ?>
                            <p class="mt-3 text-xs text-slate-500"><?php echo e($paymentDetails['qr_string']); ?></p>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <!-- Pay URL Button -->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPayUrl): ?>
                        <div class="text-center">
                            <a href="<?php echo e($paymentDetails['pay_url']); ?>" target="_blank" rel="noopener noreferrer"
                                class="inline-flex items-center justify-center gap-2 px-8 py-4 bg-gradient-to-r from-primary-600 to-primary-700 text-white font-semibold rounded-xl hover:from-primary-700 hover:to-primary-800 transition-all shadow-lg shadow-primary-500/25">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                                <?php echo e(__('orders.show.payment.pay_now')); ?>

                            </a>
                            <p class="mt-2 text-xs text-slate-500"><?php echo e(__('orders.show.payment.redirect_notice')); ?></p>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <!-- Pay Code Section -->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasPayCode): ?>
                        <div class="bg-dark-soft rounded-xl p-5 border border-dark-border">
                            <p class="text-sm text-slate-400 mb-2 text-center"><?php echo e(__('orders.show.payment.code')); ?></p>
                            <div class="flex items-center justify-center gap-3">
                                <code class="px-6 py-3 bg-dark-base rounded-lg text-2xl font-mono font-bold text-primary-400 tracking-wider border border-dark-border">
                                    <?php echo e($paymentDetails['pay_code']); ?>

                                </code>
                                <button
                                    onclick="navigator.clipboard.writeText('<?php echo e($paymentDetails['pay_code']); ?>'); this.querySelector('span').textContent = '<?php echo e(__('orders.show.payment.copied')); ?>'; setTimeout(() => this.querySelector('span').textContent = '<?php echo e(__('orders.show.payment.copy')); ?>', 2000)"
                                    class="px-4 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg font-medium transition-colors">
                                    <span><?php echo e(__('orders.show.payment.copy')); ?></span>
                                </button>
                            </div>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <!-- Manual Payment Instructions -->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$hasQrUrl && !$hasPayUrl && !$hasPayCode && !empty($paymentDetails['instructions'])): ?>
                        <div class="bg-dark-soft rounded-xl p-5 border border-dark-border">
                            <h3 class="font-semibold text-white mb-3"><?php echo e(__('orders.show.payment.instructions')); ?></h3>
                            <div class="prose prose-sm prose-invert max-w-none">
                                <?php echo nl2br(e($paymentDetails['instructions'])); ?>

                            </div>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <!-- Payment Method Instructions -->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!empty($instructions)): ?>
                        <div class="space-y-4">
                            <h3 class="font-semibold text-white"><?php echo e(__('orders.show.payment.how_to_pay')); ?></h3>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $instructions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $instruction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <div class="bg-dark-soft rounded-xl p-4 border border-dark-border">
                                <h4 class="font-medium text-white mb-3"><?php echo e($instruction['title'] ?? __('orders.show.payment.instructions')); ?></h4>
                                <ol class="space-y-2">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $instruction['steps'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                                    <li class="flex gap-3 text-sm text-slate-300">
                                        <span class="flex-shrink-0 w-6 h-6 rounded-full bg-primary-900/30 text-primary-400 flex items-center justify-center text-xs font-medium">
                                            <?php echo e($index + 1); ?>

                                        </span>
                                        <span><?php echo e($step); ?></span>
                                    </li>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                </ol>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>

                    <!-- Refresh Button -->
                    <div class="px-6 py-4 border-t border-dark-border bg-dark-soft">
                        <button wire:click="checkPaymentStatus" wire:loading.attr="disabled"
                            class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-dark-muted hover:bg-dark-base text-slate-300 rounded-lg transition-colors">
                            <svg wire:loading wire:target="checkPaymentStatus" class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <svg wire:loading.remove wire:target="checkPaymentStatus" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                            <span wire:loading.remove wire:target="checkPaymentStatus"><?php echo e(__('orders.show.payment.check_status')); ?></span>
                            <span wire:loading wire:target="checkPaymentStatus"><?php echo e(__('orders.show.payment.checking')); ?></span>
                        </button>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Verified Success -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->status === 'verified'): ?>
                <div class="bg-gradient-to-br from-green-900/30 to-green-800/10 rounded-2xl border border-green-700/50 p-8 text-center">
                    <div class="w-16 h-16 mx-auto bg-green-500 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2"><?php echo e(__('orders.show.verified.title')); ?></h2>
                    <p class="text-green-400">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->credit_given_at): ?>
                        <?php echo e(__('orders.show.verified.credits_added', ['amount' => number_format($order->credit_amount, 0, ',', '.')])); ?>

                        <?php else: ?>
                        <?php echo e(__('orders.show.verified.credits_pending')); ?>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </p>
                    <div class="mt-6">
                        <a href="<?php echo e(route('app.credits.index')); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <?php echo e(__('orders.show.verified.view_credits')); ?>

                        </a>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <!-- Failed/Cancelled -->
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array($order->status, ['failed', 'cancelled'])): ?>
                <div class="bg-gradient-to-br from-red-900/30 to-red-800/10 rounded-2xl border border-red-700/50 p-8 text-center">
                    <div class="w-16 h-16 mx-auto bg-red-500 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2"><?php echo e(__('orders.show.failed.title', ['status' => ucfirst($order->status)])); ?></h2>
                    <p class="text-red-400">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->notes): ?>
                        <?php echo e($order->notes); ?>

                        <?php else: ?>
                        <?php echo e(__('orders.show.failed.message')); ?>

                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </p>
                    <div class="mt-6">
                        <a href="<?php echo e(route('app.credits.index')); ?>" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition-colors">
                            <?php echo e(__('orders.show.failed.try_again')); ?>

                        </a>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            <!-- Order Summary Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-dark-elevated rounded-2xl border border-dark-border overflow-hidden sticky top-24">
                    <div class="px-5 py-4 border-b border-dark-border bg-dark-soft">
                        <h3 class="font-semibold text-white"><?php echo e(__('orders.show.summary.title')); ?></h3>
                    </div>
                    <div class="p-5 space-y-4">
                        <!-- Product -->
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1"><?php echo e(__('orders.show.summary.product')); ?></p>
                            <p class="font-medium text-white"><?php echo e($order->product_name); ?></p>
                        </div>

                        <!-- Credits -->
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1"><?php echo e(__('orders.show.summary.credits')); ?></p>
                            <p class="text-2xl font-bold text-primary-400"><?php echo e(number_format($order->credit_amount, 0, ',', '.')); ?></p>
                        </div>

                        <!-- Payment Method -->
                        <div>
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1"><?php echo e(__('orders.show.summary.payment_method')); ?></p>
                            <p class="font-medium text-white"><?php echo e($order->paymentMethod?->name ?? $paymentDetails['payment_name'] ?? $order->payment_method_code ?? 'N/A'); ?></p>
                        </div>

                        <div class="border-t border-dark-border pt-4 space-y-2">
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-400"><?php echo e(__('orders.show.summary.subtotal')); ?></span>
                                <span class="text-white">Rp <?php echo e(number_format($order->subtotal, 0, ',', '.')); ?></span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-slate-400"><?php echo e(__('orders.show.summary.fee')); ?></span>
                                <span class="text-white">Rp <?php echo e(number_format($order->fee_amount, 0, ',', '.')); ?></span>
                            </div>
                            <div class="flex justify-between pt-2 border-t border-dark-border">
                                <span class="font-medium text-white"><?php echo e(__('orders.show.summary.total')); ?></span>
                                <span class="text-xl font-bold text-primary-400">Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></span>
                            </div>
                        </div>

                        <!-- Reference -->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->payment_reference): ?>
                        <div class="pt-4 border-t border-dark-border">
                            <p class="text-xs text-slate-500 uppercase tracking-wider mb-1"><?php echo e(__('orders.show.summary.reference')); ?></p>
                            <code class="text-xs bg-dark-soft px-2 py-1 rounded text-primary-400 break-all"><?php echo e($order->payment_reference); ?></code>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/livewire/app/orders/show.blade.php ENDPATH**/ ?>
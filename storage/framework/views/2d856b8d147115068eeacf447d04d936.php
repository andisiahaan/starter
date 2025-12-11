<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.orders.modals.detail.title')); ?></h3>
        <button wire:click="$dispatch('closeModal')" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:text-white dark:hover:bg-white/10 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order): ?>
    <div class="p-5 space-y-5 max-h-[70vh] overflow-y-auto">
        
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-xs text-slate-500 dark:text-slate-400">Order Number</p>
                <p class="font-medium text-slate-900 dark:text-white"><?php echo e($order->order_number); ?></p>
            </div>
            <div>
                <p class="text-xs text-slate-500 dark:text-slate-400">Status</p>
                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                    <?php if($order->status === 'verified'): ?> bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400
                    <?php elseif($order->status === 'pending'): ?> bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400
                    <?php elseif($order->status === 'failed'): ?> bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400
                    <?php else: ?> bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 <?php endif; ?>">
                    <?php echo e(ucfirst($order->status)); ?>

                </span>
            </div>
            <div>
                <p class="text-xs text-slate-500 dark:text-slate-400">Created At</p>
                <p class="font-medium text-slate-900 dark:text-white"><?php echo e($order->created_at->format('M d, Y H:i')); ?></p>
            </div>
            <div>
                <p class="text-xs text-slate-500 dark:text-slate-400">Verified At</p>
                <p class="font-medium text-slate-900 dark:text-white"><?php echo e($order->verified_at?->format('M d, Y H:i') ?? '-'); ?></p>
            </div>
        </div>

        <hr class="border-slate-200 dark:border-dark-border">

        
        <div>
            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-2">Customer</h4>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Name</p>
                    <p class="font-medium text-slate-900 dark:text-white"><?php echo e($order->user?->name ?? 'N/A'); ?></p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Email</p>
                    <p class="font-medium text-slate-900 dark:text-white"><?php echo e($order->user?->email ?? 'N/A'); ?></p>
                </div>
            </div>
        </div>

        <hr class="border-slate-200 dark:border-dark-border">

        
        <div>
            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-2">Product</h4>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Product Name</p>
                    <p class="font-medium text-slate-900 dark:text-white"><?php echo e($order->product_name); ?></p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Credits</p>
                    <p class="font-medium text-slate-900 dark:text-white"><?php echo e(number_format($order->credit_amount, 0, ',', '.')); ?></p>
                </div>
            </div>
        </div>

        <hr class="border-slate-200 dark:border-dark-border">

        
        <div>
            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-2">Payment</h4>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Method</p>
                    <p class="font-medium text-slate-900 dark:text-white"><?php echo e($order->paymentMethod?->name ?? $order->payment_method_code); ?></p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Reference</p>
                    <p class="font-medium text-slate-900 dark:text-white font-mono text-sm"><?php echo e($order->payment_reference ?? '-'); ?></p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Subtotal</p>
                    <p class="font-medium text-slate-900 dark:text-white">Rp <?php echo e(number_format($order->subtotal, 0, ',', '.')); ?></p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Fee</p>
                    <p class="font-medium text-slate-900 dark:text-white">Rp <?php echo e(number_format($order->fee_amount, 0, ',', '.')); ?></p>
                </div>
            </div>
            <div class="mt-3 p-3 bg-primary-50 dark:bg-primary-900/20 rounded-lg">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Total Amount</span>
                    <span class="text-lg font-bold text-primary-600 dark:text-primary-400">Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></span>
                </div>
            </div>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order->notes): ?>
        <hr class="border-slate-200 dark:border-dark-border">
        <div>
            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-2">Notes</h4>
            <pre class="text-sm text-slate-600 dark:text-slate-300 whitespace-pre-wrap font-sans bg-slate-50 dark:bg-dark-soft p-3 rounded-lg"><?php echo e($order->notes); ?></pre>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <div class="flex items-center justify-end gap-3 px-5 py-4 border-t border-slate-200 dark:border-dark-border bg-slate-50 dark:bg-dark-soft">
        <button wire:click="$dispatch('closeModal')" class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-dark-muted border border-slate-300 dark:border-dark-border rounded-lg hover:bg-slate-50 dark:hover:bg-dark-border transition">
            Close
        </button>
    </div>
</div>

<?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/admin/livewire/orders/modals/order-detail-modal.blade.php ENDPATH**/ ?>
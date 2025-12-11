<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.orders.modals.update_status.title')); ?></h3>
        <button wire:click="$dispatch('closeModal')" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:text-white dark:hover:bg-white/10 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    
    <div class="p-5">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($order): ?>
        <div class="mb-4 p-3 bg-slate-50 dark:bg-dark-soft rounded-lg border border-slate-200 dark:border-dark-border">
            <div class="flex justify-between items-center">
                <span class="text-sm text-slate-600 dark:text-slate-400">Order</span>
                <span class="font-medium text-slate-900 dark:text-white font-mono"><?php echo e($order->order_number); ?></span>
            </div>
            <div class="flex justify-between items-center mt-1">
                <span class="text-sm text-slate-600 dark:text-slate-400">Current Status</span>
                <span class="inline-flex px-2 py-0.5 text-xs font-medium rounded-full
                    <?php if($order->status === 'verified'): ?> bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400
                    <?php elseif($order->status === 'pending'): ?> bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400
                    <?php elseif($order->status === 'failed'): ?> bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400
                    <?php else: ?> bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 <?php endif; ?>">
                    <?php echo e(ucfirst($order->status)); ?>

                </span>
            </div>
        </div>

        <form wire:submit="updateStatus" class="space-y-4">
            <div>
                <label for="newStatus" class="block text-sm font-medium text-slate-700 dark:text-slate-300">New Status</label>
                <select wire:model="newStatus" id="newStatus" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <option value="<?php echo e($key); ?>"><?php echo e($label); ?></option>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </select>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['newStatus'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 dark:text-red-400 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div>
                <label for="statusNote" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Note (optional)</label>
                <textarea wire:model="statusNote" id="statusNote" rows="3" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm" placeholder="Add a note about this status change..."></textarea>
            </div>
        </form>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    
    <div class="flex items-center justify-end gap-3 px-5 py-4 border-t border-slate-200 dark:border-dark-border bg-slate-50 dark:bg-dark-soft">
        <button wire:click="$dispatch('closeModal')" class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-dark-muted border border-slate-300 dark:border-dark-border rounded-lg hover:bg-slate-50 dark:hover:bg-dark-border transition">
            Cancel
        </button>
        <button wire:click="updateStatus" class="px-4 py-2 text-sm font-medium text-white bg-primary-600 border border-transparent rounded-lg hover:bg-primary-700 transition" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="updateStatus">Update Status</span>
            <span wire:loading wire:target="updateStatus">Updating...</span>
        </button>
    </div>
</div>

<?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/admin/livewire/orders/modals/update-order-status-modal.blade.php ENDPATH**/ ?>
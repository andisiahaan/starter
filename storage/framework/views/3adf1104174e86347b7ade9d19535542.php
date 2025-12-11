<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
            <?php echo e($userId ? __('admin.users.modals.edit.title') : __('admin.users.modals.create.title')); ?>

        </h3>
        <button wire:click="$dispatch('closeModal')" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:text-white dark:hover:bg-white/10 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    
    <div class="p-5">
        <form wire:submit="save" class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300"><?php echo e(__('admin.users.modals.create.name')); ?></label>
                <input type="text" id="name" wire:model="name" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 dark:text-red-400 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300"><?php echo e(__('admin.users.modals.create.email')); ?></label>
                <input type="email" id="email" wire:model="email" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 dark:text-red-400 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                    <?php echo e(__('admin.users.modals.create.password')); ?> <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($userId): ?> <span class="text-slate-400"><?php echo e(__('admin.users.modals.create.password_hint')); ?></span> <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </label>
                <input type="password" id="password" wire:model="password" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-600 dark:text-red-400 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300"><?php echo e(__('admin.users.modals.create.password_confirm')); ?></label>
                <input type="password" id="password_confirmation" wire:model="password_confirmation" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2"><?php echo e(__('admin.users.modals.create.roles')); ?></label>
                <div class="grid grid-cols-2 gap-2 max-h-48 overflow-y-auto p-3 bg-slate-50 dark:bg-dark-soft rounded-md border border-slate-200 dark:border-dark-border">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" wire:model="selectedRoles" value="<?php echo e($role->name); ?>" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500 bg-white dark:bg-dark-muted">
                        <span class="text-sm text-slate-700 dark:text-slate-300"><?php echo e($role->name); ?></span>
                    </label>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
        </form>
    </div>

    
    <div class="flex items-center justify-end gap-3 px-5 py-4 border-t border-slate-200 dark:border-dark-border bg-slate-50 dark:bg-dark-soft">
        <button wire:click="$dispatch('closeModal')" class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-dark-muted border border-slate-300 dark:border-dark-border rounded-lg hover:bg-slate-50 dark:hover:bg-dark-border transition">
            <?php echo e(__('admin.users.modals.create.cancel')); ?>

        </button>
        <button wire:click="save" class="px-4 py-2 text-sm font-medium text-white bg-primary-600 border border-transparent rounded-lg hover:bg-primary-700 transition" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="save"><?php echo e($userId ? __('admin.users.modals.create.update') : __('admin.users.modals.create.create')); ?></span>
            <span wire:loading wire:target="save"><?php echo e(__('admin.users.modals.create.saving')); ?></span>
        </button>
    </div>
</div>
<?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/admin/livewire/users/modals/create-edit-user-modal.blade.php ENDPATH**/ ?>
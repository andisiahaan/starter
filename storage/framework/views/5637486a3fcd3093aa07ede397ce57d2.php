<div class="p-6">
    <div class="max-w-xl">
        <h3 class="text-lg font-medium text-slate-900 dark:text-white"><?php echo e(__('Profile Information')); ?></h3>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400"><?php echo e(__('Update your account\'s profile information.')); ?></p>

        <form wire:submit="updateProfile" class="mt-6 space-y-4">
            
            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                    <?php echo e(__('Name')); ?>

                </label>
                <input
                    type="text"
                    id="name"
                    wire:model="name"
                    class="mt-1 block w-full px-3 py-2 border border-slate-300 dark:border-dark-border rounded-lg bg-white dark:bg-dark-muted text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                    <?php echo e(__('Email')); ?>

                </label>
                <input
                    type="email"
                    value="<?php echo e(auth()->user()->email); ?>"
                    disabled
                    class="mt-1 block w-full px-3 py-2 border border-slate-200 dark:border-dark-border rounded-lg bg-slate-100 dark:bg-dark-soft text-slate-500 dark:text-slate-400 cursor-not-allowed">
                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400"><?php echo e(__('Email can be changed in the Security tab.')); ?></p>
            </div>

            
            <div class="flex items-center gap-4">
                <button type="submit" class="btn btn-primary">
                    <?php echo e(__('Save')); ?>

                </button>

                <div wire:loading wire:target="updateProfile" class="text-sm text-slate-500">
                    <?php echo e(__('Saving...')); ?>

                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                <span class="text-sm text-emerald-600 dark:text-emerald-400"><?php echo e(session('success')); ?></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </form>
    </div>
</div><?php /**PATH D:\Installed\Apps\laragon\www\gramsea\resources\views/livewire/app/account/profile.blade.php ENDPATH**/ ?>
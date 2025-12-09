<div class="p-6 space-y-8">
    
    <div class="max-w-xl">
        <h3 class="text-lg font-medium text-slate-900 dark:text-white"><?php echo e(__('Email Address')); ?></h3>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400"><?php echo e(__('Your current email address is')); ?> <strong class="text-slate-900 dark:text-white"><?php echo e($user->email); ?></strong></p>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($user->latestPendingEmailChange()): ?>
        <div class="mt-4 p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-lg">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div>
                    <p class="text-sm text-amber-800 dark:text-amber-200">
                        <?php echo e(__('Pending email change to')); ?> <strong><?php echo e($user->latestPendingEmailChange()->new_email); ?></strong>
                    </p>
                    <p class="mt-1 text-xs text-amber-600 dark:text-amber-400"><?php echo e(__('Check your new email for verification link.')); ?></p>
                </div>
            </div>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        <div class="mt-4">
            <button wire:click="$dispatch('openModal', { component: 'app.account.modals.change-email-modal' })" class="btn btn-outline">
                <?php echo e(__('Change Email')); ?>

            </button>
        </div>
    </div>

    <hr class="border-slate-200 dark:border-dark-border">

    
    <div class="max-w-xl">
        <h3 class="text-lg font-medium text-slate-900 dark:text-white"><?php echo e(__('Update Password')); ?></h3>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400"><?php echo e(__('Ensure your account is using a long, random password to stay secure.')); ?></p>

        <form wire:submit="changePassword" class="mt-6 space-y-4">
            
            <div>
                <label for="current_password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                    <?php echo e(__('Current Password')); ?>

                </label>
                <input
                    type="password"
                    id="current_password"
                    wire:model="current_password"
                    class="mt-1 block w-full px-3 py-2 border border-slate-300 dark:border-dark-border rounded-lg bg-white dark:bg-dark-muted text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['current_password'];
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
                <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                    <?php echo e(__('New Password')); ?>

                </label>
                <input
                    type="password"
                    id="password"
                    wire:model="password"
                    class="mt-1 block w-full px-3 py-2 border border-slate-300 dark:border-dark-border rounded-lg bg-white dark:bg-dark-muted text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['password'];
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
                <label for="password_confirmation" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                    <?php echo e(__('Confirm Password')); ?>

                </label>
                <input
                    type="password"
                    id="password_confirmation"
                    wire:model="password_confirmation"
                    class="mt-1 block w-full px-3 py-2 border border-slate-300 dark:border-dark-border rounded-lg bg-white dark:bg-dark-muted text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
            </div>

            
            <div class="flex items-center gap-4">
                <button type="submit" class="btn btn-primary">
                    <?php echo e(__('Update Password')); ?>

                </button>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                <span class="text-sm text-emerald-600 dark:text-emerald-400"><?php echo e(session('success')); ?></span>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </form>
    </div>
</div><?php /**PATH D:\Installed\Apps\laragon\www\gramsea\resources\views/livewire/app/account/security.blade.php ENDPATH**/ ?>
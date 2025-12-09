<div>
    <form wire:submit="save">
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 dark:border-dark-border">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Referral Settings</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Configure referral program and commission settings.</p>
            </div>

            <div class="p-6 space-y-6">
                <!-- Enable Referral -->
                <div class="flex items-center justify-between">
                    <div>
                        <label class="text-sm font-medium text-slate-900 dark:text-white">Enable Referral Program</label>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Allow users to invite friends and earn commissions.</p>
                    </div>
                    <button type="button" wire:click="$set('state.is_enabled', !$state['is_enabled'])"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 <?php echo e($state['is_enabled'] ? 'bg-primary-600' : 'bg-slate-200 dark:bg-slate-600'); ?>">
                        <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out <?php echo e($state['is_enabled'] ? 'translate-x-5' : 'translate-x-0'); ?>"></span>
                    </button>
                </div>

                <hr class="border-slate-200 dark:border-dark-border">

                <!-- Cookie Days -->
                <div>
                    <label for="referral_cookie_days" class="block text-sm font-medium text-slate-900 dark:text-white mb-1">
                        Referral Cookie Duration (days)
                    </label>
                    <input type="number" wire:model="state.referral_cookie_days" id="referral_cookie_days" min="1" max="365"
                           class="w-full max-w-xs bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">How long the referral code is saved in visitor's browser.</p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['state.referral_cookie_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <!-- Expiry Days -->
                <div>
                    <label for="referral_expiry_days" class="block text-sm font-medium text-slate-900 dark:text-white mb-1">
                        Commission Hold Period (days)
                    </label>
                    <input type="number" wire:model="state.referral_expiry_days" id="referral_expiry_days" min="0" max="365"
                           class="w-full max-w-xs bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Days before pending commission becomes available for withdrawal. Set 0 for immediate.</p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['state.referral_expiry_days'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <hr class="border-slate-200 dark:border-dark-border">

                <h4 class="text-sm font-medium text-slate-900 dark:text-white">Commission Settings</h4>

                <!-- Fixed Commission -->
                <div>
                    <label for="commission_fixed" class="block text-sm font-medium text-slate-900 dark:text-white mb-1">
                        Fixed Commission (Rp)
                    </label>
                    <input type="number" wire:model="state.commission_fixed" id="commission_fixed" min="0" step="100"
                           class="w-full max-w-xs bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Fixed amount given to referrer for each qualifying order.</p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['state.commission_fixed'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <!-- Percent Commission -->
                <div>
                    <label for="commission_percent" class="block text-sm font-medium text-slate-900 dark:text-white mb-1">
                        Percentage Commission (%)
                    </label>
                    <input type="number" wire:model="state.commission_percent" id="commission_percent" min="0" max="100" step="0.1"
                           class="w-full max-w-xs bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Percentage of order total given as commission (added to fixed amount).</p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['state.commission_percent'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <hr class="border-slate-200 dark:border-dark-border">

                <!-- Min Withdrawal -->
                <div>
                    <label for="min_withdrawal" class="block text-sm font-medium text-slate-900 dark:text-white mb-1">
                        Minimum Withdrawal (Rp)
                    </label>
                    <input type="number" wire:model="state.min_withdrawal" id="min_withdrawal" min="0" step="1000"
                           class="w-full max-w-xs bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Minimum amount required to request withdrawal.</p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['state.min_withdrawal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-sm text-red-600 dark:text-red-400"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <!-- Example Calculation -->
                <div class="bg-slate-50 dark:bg-dark-soft rounded-lg p-4 border border-slate-200 dark:border-dark-border">
                    <h5 class="text-sm font-medium text-slate-900 dark:text-white mb-2">Example Calculation</h5>
                    <p class="text-sm text-slate-600 dark:text-slate-400">
                        For an order of <strong>Rp 100,000</strong>:<br>
                        Fixed: Rp <?php echo e(number_format($state['commission_fixed'], 0, ',', '.')); ?><br>
                        Percent: <?php echo e($state['commission_percent']); ?>% × Rp 100,000 = Rp <?php echo e(number_format(($state['commission_percent'] / 100) * 100000, 0, ',', '.')); ?><br>
                        <strong>Total Commission: Rp <?php echo e(number_format($state['commission_fixed'] + (($state['commission_percent'] / 100) * 100000), 0, ',', '.')); ?></strong>
                    </p>
                </div>
            </div>

            <div class="px-6 py-4 bg-slate-50 dark:bg-dark-soft border-t border-slate-200 dark:border-dark-border flex justify-end">
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                    Save Settings
                </button>
            </div>
        </div>
    </form>
</div>
<?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/admin/livewire/settings/referral.blade.php ENDPATH**/ ?>
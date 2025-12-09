<div>
    <!-- Referral Stats Card -->
    <div class="bg-gradient-to-br from-emerald-600 to-teal-700 rounded-2xl shadow-lg overflow-hidden mb-8">
        <div class="px-6 py-8 sm:px-8">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-sm font-medium">Total Earnings</p>
                    <p class="text-4xl font-bold text-white mt-1">Rp <?php echo e(number_format($stats['total_earnings'], 0, ',', '.')); ?></p>
                    <p class="text-emerald-200 text-sm mt-1">From <?php echo e($stats['total_referrals']); ?> referrals</p>
                </div>
                <div class="bg-white/10 rounded-full p-4">
                    <svg class="w-10 h-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
            <div class="mt-6 flex gap-3">
                <a href="<?php echo e(route('app.referral.withdrawals')); ?>" class="inline-flex items-center px-4 py-2 bg-white/20 text-white text-sm font-medium rounded-lg hover:bg-white/30 transition-colors">
                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Withdrawal History
                </a>
            </div>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border p-4">
            <p class="text-sm text-slate-500 dark:text-slate-400">Total Referrals</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-white mt-1"><?php echo e($stats['total_referrals']); ?></p>
        </div>
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border p-4">
            <p class="text-sm text-slate-500 dark:text-slate-400">Available</p>
            <p class="text-2xl font-bold text-green-600 dark:text-green-400 mt-1">Rp <?php echo e(number_format($stats['available_commission'], 0, ',', '.')); ?></p>
        </div>
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border p-4">
            <p class="text-sm text-slate-500 dark:text-slate-400">Pending</p>
            <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400 mt-1">Rp <?php echo e(number_format($stats['pending_commission'], 0, ',', '.')); ?></p>
        </div>
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border p-4">
            <p class="text-sm text-slate-500 dark:text-slate-400">Withdrawn</p>
            <p class="text-2xl font-bold text-slate-600 dark:text-slate-400 mt-1">Rp <?php echo e(number_format($stats['withdrawn_commission'], 0, ',', '.')); ?></p>
        </div>
    </div>

    <!-- Referral Link -->
    <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border p-5 mb-8">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Your Referral Link</h3>
        <div class="flex gap-2">
            <input type="text" readonly value="<?php echo e($referralUrl); ?>" 
                   class="flex-1 bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 text-sm"
                   id="referral-link">
            <button 
                wire:click="copyReferralLink"
                onclick="navigator.clipboard.writeText('<?php echo e($referralUrl); ?>'); this.innerHTML = '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M5 13l4 4L19 7\'/></svg>'; setTimeout(() => this.innerHTML = '<svg class=\'w-5 h-5\' fill=\'none\' stroke=\'currentColor\' viewBox=\'0 0 24 24\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'2\' d=\'M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z\'/></svg>', 2000)"
                class="inline-flex items-center px-4 py-2.5 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
            </button>
        </div>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">
            Share this link with friends. When they register and make a purchase, you'll earn commission!
        </p>
    </div>

    <!-- Your Referrals -->
    <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border overflow-hidden mb-8">
        <div class="px-5 py-4 border-b border-slate-200 dark:border-dark-border flex items-center justify-between">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Your Referrals</h3>
            <input type="text" 
                   wire:model.live.debounce.300ms="search" 
                   placeholder="Search..." 
                   class="w-48 bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-3 py-2 text-sm text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($referrals->count() > 0): ?>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
                <thead class="bg-slate-50 dark:bg-dark-soft">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">User</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Joined</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-dark-elevated divide-y divide-slate-200 dark:divide-dark-border">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $referrals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referral): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <tr>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center text-primary-600 dark:text-primary-400 font-semibold text-sm">
                                    <?php echo e(strtoupper(substr($referral->name, 0, 1))); ?>

                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-slate-900 dark:text-white"><?php echo e($referral->name); ?></p>
                                    <p class="text-xs text-slate-500 dark:text-slate-400"><?php echo e(Str::mask($referral->email, '*', 3, 5)); ?></p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                            <?php echo e($referral->created_at->format('M d, Y')); ?>

                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($referral->email_verified_at): ?>
                            <span class="inline-flex items-center rounded-full bg-green-100 dark:bg-green-900/30 px-2.5 py-0.5 text-xs font-medium text-green-700 dark:text-green-400">Verified</span>
                            <?php else: ?>
                            <span class="inline-flex items-center rounded-full bg-yellow-100 dark:bg-yellow-900/30 px-2.5 py-0.5 text-xs font-medium text-yellow-700 dark:text-yellow-400">Pending</span>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </td>
                    </tr>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4 border-t border-slate-200 dark:border-dark-border">
            <?php echo e($referrals->links()); ?>

        </div>
        <?php else: ?>
        <div class="p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-slate-900 dark:text-white">No referrals yet</h3>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Share your referral link to start earning!</p>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>

    <!-- Recent Commissions -->
    <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-200 dark:border-dark-border">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Recent Commissions</h3>
        </div>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($commissions->count() > 0): ?>
        <div class="divide-y divide-slate-200 dark:divide-dark-border">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $commissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $commission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <div class="px-5 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full 
                        <?php if($commission->status === 'available'): ?> bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400
                        <?php elseif($commission->status === 'pending'): ?> bg-yellow-100 dark:bg-yellow-900/30 text-yellow-600 dark:text-yellow-400
                        <?php elseif($commission->status === 'withdrawn'): ?> bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400
                        <?php else: ?> bg-slate-100 dark:bg-slate-700 text-slate-500 <?php endif; ?>
                        flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-900 dark:text-white">
                            Commission from <?php echo e($commission->referredUser?->name ?? 'Unknown'); ?>

                        </p>
                        <p class="text-xs text-slate-500 dark:text-slate-400"><?php echo e($commission->created_at->format('M d, Y H:i')); ?></p>
                    </div>
                </div>
                <div class="text-right">
                    <p class="text-sm font-semibold text-slate-900 dark:text-white">+Rp <?php echo e(number_format($commission->amount, 0, ',', '.')); ?></p>
                    <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium
                        <?php if($commission->status === 'available'): ?> bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400
                        <?php elseif($commission->status === 'pending'): ?> bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400
                        <?php elseif($commission->status === 'withdrawn'): ?> bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400
                        <?php else: ?> bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-400 <?php endif; ?>">
                        <?php echo e(ucfirst($commission->status)); ?>

                    </span>
                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
        <?php else: ?>
        <div class="p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-slate-900 dark:text-white">No commissions yet</h3>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Commissions will appear when your referrals make purchases.</p>
        </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/livewire/app/referral/index.blade.php ENDPATH**/ ?>
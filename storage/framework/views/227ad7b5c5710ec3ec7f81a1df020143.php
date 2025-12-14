<div class="p-6 space-y-8">
    
    <div class="border-b border-slate-200 dark:border-dark-border pb-4">
        <h2 class="text-lg font-semibold text-slate-900 dark:text-white"><?php echo e(__('notifications.preferences.title')); ?></h2>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400"><?php echo e(__('notifications.preferences.description')); ?></p>
    </div>

    
    <div class="space-y-4">
        <h3 class="text-sm font-medium text-slate-900 dark:text-white uppercase tracking-wider"><?php echo e(__('notifications.preferences.channels.title')); ?></h3>
        
        <div class="grid gap-4 sm:grid-cols-3">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $channels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <?php 
                    $channelGlobalEnabled = isset($globalSettings['channels'][$channel->value]) ? $globalSettings['channels'][$channel->value] : false;
                    $channelUserEnabled = isset($userPreferences['channels'][$channel->value]) ? $userPreferences['channels'][$channel->value] : $channel->isRequired();
                    $isPush = $channel === \App\Enums\NotificationChannel::PUSH;
                ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($channelGlobalEnabled || $channel->isRequired()): ?>
                <div class="p-4 rounded-lg border-2 transition-colors <?php echo e($channelUserEnabled ? 'border-primary-500 bg-primary-50 dark:bg-primary-900/20' : 'border-slate-200 dark:border-dark-border'); ?>"
                     <?php if(!$channel->isRequired() && !$isPush): ?> wire:click="toggleChannel('<?php echo e($channel->value); ?>')" <?php endif; ?>
                     class="<?php echo \Illuminate\Support\Arr::toCssClasses(['cursor-pointer hover:border-primary-300 dark:hover:border-primary-700' => !$channel->isRequired() && !$isPush]); ?>">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full <?php echo e($channelUserEnabled ? 'bg-primary-100 dark:bg-primary-900/30' : 'bg-slate-100 dark:bg-dark-soft'); ?> flex items-center justify-center">
                                <svg class="w-5 h-5 <?php echo e($channelUserEnabled ? 'text-primary-600 dark:text-primary-400' : 'text-slate-500 dark:text-slate-400'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($channel->getIcon()); ?>" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-slate-900 dark:text-white"><?php echo e($channel->getLabel()); ?></p>
                                <p class="text-xs text-slate-500 dark:text-slate-400"><?php echo e($channel->getDescription()); ?></p>
                            </div>
                        </div>
                        
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($channel->isRequired()): ?>
                            <span class="px-2 py-1 text-xs font-medium text-primary-700 dark:text-primary-300 bg-primary-200 dark:bg-primary-800/50 rounded"><?php echo e(__('common.required')); ?></span>
                        <?php elseif($isPush): ?>
                            
                            <div class="flex items-center gap-2">
                                
                                <button wire:click="toggleChannel('<?php echo e($channel->value); ?>')" class="relative focus:outline-none">
                                    <div class="w-10 h-6 rounded-full transition-colors <?php echo e($channelUserEnabled ? 'bg-primary-500' : 'bg-slate-300 dark:bg-dark-border'); ?>">
                                        <div class="absolute top-1 left-1 w-4 h-4 rounded-full bg-white transition-transform <?php echo e($channelUserEnabled ? 'translate-x-4' : ''); ?>"></div>
                                    </div>
                                </button>
                                
                                <button wire:click="$dispatch('openModal', { component: 'app.account.modals.push-subscriptions-modal' })" 
                                        class="px-2.5 py-1.5 text-xs font-medium text-slate-600 dark:text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 bg-slate-100 dark:bg-dark-soft hover:bg-primary-50 dark:hover:bg-primary-900/20 rounded transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </div>
                        <?php else: ?>
                            
                            <div class="relative">
                                <div class="w-10 h-6 rounded-full transition-colors <?php echo e($channelUserEnabled ? 'bg-primary-500' : 'bg-slate-300 dark:bg-dark-border'); ?>">
                                    <div class="absolute top-1 left-1 w-4 h-4 rounded-full bg-white transition-transform <?php echo e($channelUserEnabled ? 'translate-x-4' : ''); ?>"></div>
                                </div>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>

    
    <div class="space-y-4">
        <h3 class="text-sm font-medium text-slate-900 dark:text-white uppercase tracking-wider"><?php echo e(__('notifications.preferences.types_title')); ?></h3>
        
        <div class="space-y-4">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $categorizedTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
            <div class="bg-slate-50 dark:bg-dark-soft rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
                
                <div class="flex items-center justify-between p-4 border-b border-slate-200 dark:border-dark-border">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center <?php echo e($category['color']['bg'] ?? 'bg-slate-100'); ?>">
                            <svg class="w-4 h-4 <?php echo e($category['color']['text'] ?? 'text-slate-500'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($category['icon'] ?? ''); ?>" />
                            </svg>
                        </div>
                        <span class="font-medium text-slate-900 dark:text-white"><?php echo e($category['label'] ?? 'Unknown'); ?></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <button wire:click="enableCategory('<?php echo e($category['key'] ?? ''); ?>')" class="text-xs text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300"><?php echo e(__('common.actions.enable_all')); ?></button>
                        <span class="text-slate-300 dark:text-dark-border">|</span>
                        <button wire:click="disableCategory('<?php echo e($category['key'] ?? ''); ?>')" class="text-xs text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300"><?php echo e(__('common.actions.disable_all')); ?></button>
                    </div>
                </div>
                
                
                <div class="divide-y divide-slate-200 dark:divide-dark-border">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $category['types'] ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <div class="flex items-center justify-between p-4 hover:bg-white dark:hover:bg-dark-elevated/50 transition-colors cursor-pointer"
                         wire:click="toggleType('<?php echo e($type['value'] ?? ''); ?>')"
                         <?php if($type['isSecurityCritical'] ?? false): ?> title="Security notifications cannot be disabled" <?php endif; ?>>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-medium text-slate-700 dark:text-slate-300"><?php echo e($type['label'] ?? 'Unknown'); ?></p>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($type['isSecurityCritical'] ?? false): ?>
                                    <span class="px-1.5 py-0.5 text-xs font-medium bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400 rounded"><?php echo e(__('common.security')); ?></span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5"><?php echo e($type['description'] ?? ''); ?></p>
                        </div>
                        <div class="relative">
                            <?php $typeUserEnabled = $type['userEnabled'] ?? true; ?>
                            <div class="w-10 h-6 rounded-full transition-colors <?php echo e($typeUserEnabled ? 'bg-primary-500' : 'bg-slate-300 dark:bg-dark-border'); ?>">
                                <div class="absolute top-1 left-1 w-4 h-4 rounded-full bg-white transition-transform <?php echo e($typeUserEnabled ? 'translate-x-4' : ''); ?>"></div>
                            </div>
                        </div>
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/livewire/app/account/notifications.blade.php ENDPATH**/ ?>
<div>
    <div class="space-y-6">
        
        <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 dark:border-dark-border">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Notification Channels</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Enable or disable notification delivery channels globally.</p>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $channelEnums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <button wire:click="toggleChannel('<?php echo e($channel->value); ?>')" 
                            type="button" 
                            class="flex items-center justify-between p-4 rounded-lg border transition <?php echo e(($channels[$channel->value] ?? false) ? 'bg-primary-50 dark:bg-primary-900/20 border-primary-300 dark:border-primary-500/50' : 'bg-slate-50 dark:bg-dark-soft border-slate-200 dark:border-dark-border hover:border-slate-300 dark:hover:border-slate-600'); ?>"
                            <?php if($channel->isRequired()): ?> disabled <?php endif; ?>>
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 <?php echo e(($channels[$channel->value] ?? false) ? 'text-primary-600 dark:text-primary-400' : 'text-slate-400 dark:text-slate-500'); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($channel->getIcon()); ?>" />
                            </svg>
                            <div class="text-left">
                                <span class="text-sm font-medium <?php echo e(($channels[$channel->value] ?? false) ? 'text-slate-900 dark:text-white' : 'text-slate-500 dark:text-slate-400'); ?>"><?php echo e($channel->getLabel()); ?></span>
                                <p class="text-xs text-slate-400 dark:text-slate-500"><?php echo e($channel->getDescription()); ?></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($channel->isRequired()): ?>
                                <span class="px-2 py-0.5 text-xs font-medium bg-primary-100 dark:bg-primary-900/50 text-primary-700 dark:text-primary-300 rounded">Required</span>
                            <?php else: ?>
                                <div class="w-3 h-3 rounded-full <?php echo e(($channels[$channel->value] ?? false) ? 'bg-primary-600 dark:bg-primary-400' : 'bg-slate-300 dark:bg-slate-600'); ?>"></div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </button>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 dark:border-dark-border">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Notification Types</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Enable or disable notification types globally. Users can also customize their preferences.</p>
            </div>

            <div class="divide-y divide-slate-200 dark:divide-dark-border">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = \App\Enums\NotificationType::getCategories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categoryKey => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="p-4" x-data="{ expanded: true }">
                    
                    <div class="flex items-center justify-between">
                        <button @click="expanded = !expanded" class="flex items-center gap-3 text-left">
                            <svg class="w-4 h-4 text-slate-400 transition-transform" :class="{ 'rotate-90': expanded }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            <div class="w-8 h-8 rounded-full flex items-center justify-center <?php echo e($category['color']['bg']); ?>">
                                <svg class="w-4 h-4 <?php echo e($category['color']['text']); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($category['icon']); ?>" />
                                </svg>
                            </div>
                            <span class="text-sm font-semibold text-slate-900 dark:text-white"><?php echo e($category['label']); ?></span>
                        </button>
                        <div class="flex items-center gap-2">
                            <button wire:click="enableCategory('<?php echo e($categoryKey); ?>')" class="text-xs text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 px-2 py-1 rounded hover:bg-primary-50 dark:hover:bg-primary-900/20">
                                Enable all
                            </button>
                            <span class="text-slate-300 dark:text-dark-border">|</span>
                            <button wire:click="disableCategory('<?php echo e($categoryKey); ?>')" class="text-xs text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300 px-2 py-1 rounded hover:bg-slate-100 dark:hover:bg-dark-soft">
                                Disable all
                            </button>
                        </div>
                    </div>

                    
                    <div x-show="expanded" x-collapse class="mt-3 ml-6 space-y-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = \App\Enums\NotificationType::forCategory($categoryKey); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                        <div class="flex items-center justify-between py-3 px-4 bg-slate-50 dark:bg-dark-soft rounded-lg group hover:bg-slate-100 dark:hover:bg-dark-soft/80 transition">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300"><?php echo e($type->getLabel()); ?></span>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($type->isSecurityCritical()): ?>
                                        <span class="px-1.5 py-0.5 text-xs font-medium bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-400 rounded">Security</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5"><?php echo e($type->getDescription()); ?></p>
                            </div>
                            <button wire:click="toggleType('<?php echo e($type->value); ?>')" 
                                    type="button" 
                                    class="relative w-10 h-5 rounded-full transition <?php echo e(($types[$type->value] ?? true) ? 'bg-primary-600' : 'bg-slate-300 dark:bg-dark-border'); ?>"
                                    <?php if($type->isSecurityCritical()): ?> disabled title="Security notifications cannot be disabled" <?php endif; ?>>
                                <span class="absolute left-0.5 top-0.5 w-4 h-4 bg-white rounded-full transition-transform <?php echo e(($types[$type->value] ?? true) ? 'translate-x-5' : ''); ?>"></span>
                            </button>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        </div>
    </div>
</div><?php /**PATH D:\Installed\Apps\laragon\www\gramsea\resources\views/admin/livewire/settings/notifications.blade.php ENDPATH**/ ?>
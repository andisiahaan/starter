<div>
    
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e(__('notifications.title')); ?></h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400"><?php echo e(__('notifications.description')); ?></p>
            </div>
            
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($unreadCount > 0): ?>
                <div class="flex items-center gap-2">
                    <button wire:click="markAllAsRead" 
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm font-medium text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20 hover:bg-primary-100 dark:hover:bg-primary-900/30 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <?php echo e(__('notifications.mark_all_read')); ?>

                    </button>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    
    <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border mb-4">
        <div class="p-4 flex flex-col sm:flex-row sm:items-center gap-4">
            
            <div class="flex items-center gap-2">
                <button wire:click="$set('filter', '')" 
                        class="px-3 py-1.5 text-sm font-medium rounded-lg transition-colors <?php echo e(!$filter ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-white/5'); ?>">
                    <?php echo e(__('notifications.filter_all')); ?>

                </button>
                <button wire:click="$set('filter', 'unread')"
                        class="px-3 py-1.5 text-sm font-medium rounded-lg transition-colors <?php echo e($filter === 'unread' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-white/5'); ?>">
                    <?php echo e(__('notifications.filter_unread')); ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($unreadCount > 0): ?>
                        <span class="ml-1.5 inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 text-xs font-bold bg-red-500 text-white rounded-full">
                            <?php echo e($unreadCount > 99 ? '99+' : $unreadCount); ?>

                        </span>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </button>
                <button wire:click="$set('filter', 'read')"
                        class="px-3 py-1.5 text-sm font-medium rounded-lg transition-colors <?php echo e($filter === 'read' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-white/5'); ?>">
                    <?php echo e(__('notifications.filter_read')); ?>

                </button>
            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($selected) > 0): ?>
                <div class="flex items-center gap-2 sm:ml-auto">
                    <span class="text-sm text-slate-500 dark:text-slate-400">
                        <?php echo e(__('notifications.selected_count', ['count' => count($selected)])); ?>

                    </span>
                    <div class="flex items-center gap-1">
                        <button wire:click="markSelectedAsRead" 
                                class="p-2 text-slate-500 hover:text-green-600 dark:text-slate-400 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 rounded-lg transition-colors"
                                title="<?php echo e(__('notifications.mark_read')); ?>">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </button>
                        <button wire:click="markSelectedAsUnread" 
                                class="p-2 text-slate-500 hover:text-amber-600 dark:text-slate-400 dark:hover:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 rounded-lg transition-colors"
                                title="<?php echo e(__('notifications.mark_unread')); ?>">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </button>
                        <button wire:click="deleteSelected" 
                                wire:confirm="<?php echo e(__('notifications.confirm_delete_selected')); ?>"
                                class="p-2 text-slate-500 hover:text-red-600 dark:text-slate-400 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors"
                                title="<?php echo e(__('notifications.delete')); ?>">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            <?php else: ?>
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filter === 'read' || (!$filter && $notifications->count() > 0)): ?>
                    <div class="sm:ml-auto">
                        <button wire:click="deleteAllRead"
                                wire:confirm="<?php echo e(__('notifications.confirm_delete_all_read')); ?>"
                                class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            <?php echo e(__('notifications.delete_all_read')); ?>

                        </button>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>

    
    <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border overflow-hidden">
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($notifications->count() > 0): ?>
            
            <div class="px-4 py-3 bg-slate-50 dark:bg-dark-soft/50 border-b border-slate-200 dark:border-dark-border">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" 
                           wire:model.live="selectAll"
                           class="w-4 h-4 rounded border-slate-300 dark:border-slate-600 text-primary-600 focus:ring-primary-500 dark:bg-dark-soft">
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">
                        <?php echo e(__('notifications.select_all')); ?>

                    </span>
                </label>
            </div>

            
            <div class="divide-y divide-slate-100 dark:divide-dark-border">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <div <?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processElementKey('notification-{{ $notification[\'id\'] }}', get_defined_vars()); ?>wire:key="notification-<?php echo e($notification['id']); ?>"
                         class="group relative hover:bg-slate-50 dark:hover:bg-white/5 transition-colors <?php echo e(!$notification['read_at'] ? 'bg-primary-50/50 dark:bg-primary-900/10' : ''); ?>">
                        <div class="flex items-start gap-4 p-4">
                            
                            <div class="shrink-0 pt-1">
                                <input type="checkbox" 
                                       wire:model.live="selected"
                                       value="<?php echo e($notification['id']); ?>"
                                       class="w-4 h-4 rounded border-slate-300 dark:border-slate-600 text-primary-600 focus:ring-primary-500 dark:bg-dark-soft">
                            </div>
                            
                            
                            <div class="shrink-0">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center <?php echo e($notification['color']['bg']); ?>">
                                    <svg class="w-5 h-5 <?php echo e($notification['color']['text']); ?>" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($notification['icon']); ?>" />
                                    </svg>
                                </div>
                            </div>
                            
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-4">
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2">
                                            <p class="text-sm font-semibold text-slate-900 dark:text-white">
                                                <?php echo e($notification['title']); ?>

                                            </p>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$notification['read_at']): ?>
                                                <span class="inline-flex items-center px-2 py-0.5 text-xs font-medium bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-300 rounded-full">
                                                    <?php echo e(__('notifications.new')); ?>

                                                </span>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($notification['message']): ?>
                                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                                                <?php echo e($notification['message']); ?>

                                            </p>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-2" title="<?php echo e($notification['created_at_full']); ?>">
                                            <?php echo e($notification['created_at']); ?>

                                        </p>
                                    </div>
                                    
                                    
                                    <div class="shrink-0 flex items-center gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($notification['url']): ?>
                                            <a href="<?php echo e($notification['url']); ?>" 
                                               wire:click="markAsRead('<?php echo e($notification['id']); ?>')"
                                               class="p-2 text-slate-400 hover:text-primary-600 dark:hover:text-primary-400 hover:bg-primary-50 dark:hover:bg-primary-900/20 rounded-lg transition-colors"
                                               title="<?php echo e(__('notifications.view')); ?>">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                </svg>
                                            </a>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(!$notification['read_at']): ?>
                                            <button wire:click="markAsRead('<?php echo e($notification['id']); ?>')"
                                                    class="p-2 text-slate-400 hover:text-green-600 dark:hover:text-green-400 hover:bg-green-50 dark:hover:bg-green-900/20 rounded-lg transition-colors"
                                                    title="<?php echo e(__('notifications.mark_read')); ?>">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </button>
                                        <?php else: ?>
                                            <button wire:click="markAsUnread('<?php echo e($notification['id']); ?>')"
                                                    class="p-2 text-slate-400 hover:text-amber-600 dark:hover:text-amber-400 hover:bg-amber-50 dark:hover:bg-amber-900/20 rounded-lg transition-colors"
                                                    title="<?php echo e(__('notifications.mark_unread')); ?>">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            </button>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        
                                        <button wire:click="delete('<?php echo e($notification['id']); ?>')"
                                                wire:confirm="<?php echo e(__('notifications.confirm_delete')); ?>"
                                                class="p-2 text-slate-400 hover:text-red-600 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg transition-colors"
                                                title="<?php echo e(__('notifications.delete')); ?>">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($notifications->hasPages()): ?>
                <div class="px-4 py-4 border-t border-slate-200 dark:border-dark-border">
                    <?php echo e($notifications->links()); ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php else: ?>
            
            <div class="flex flex-col items-center justify-center py-16 px-6">
                <div class="w-20 h-20 rounded-full bg-slate-100 dark:bg-dark-soft flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                </div>
                <h4 class="text-lg font-semibold text-slate-900 dark:text-white mb-2">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filter === 'unread'): ?>
                        <?php echo e(__('notifications.empty_unread_title')); ?>

                    <?php elseif($filter === 'read'): ?>
                        <?php echo e(__('notifications.empty_read_title')); ?>

                    <?php else: ?>
                        <?php echo e(__('notifications.empty_title')); ?>

                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </h4>
                <p class="text-sm text-slate-500 dark:text-slate-400 text-center max-w-sm">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($filter === 'unread'): ?>
                        <?php echo e(__('notifications.empty_unread_description')); ?>

                    <?php elseif($filter === 'read'): ?>
                        <?php echo e(__('notifications.empty_read_description')); ?>

                    <?php else: ?>
                        <?php echo e(__('notifications.empty_description')); ?>

                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </p>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</div>
<?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/livewire/app/notifications/index.blade.php ENDPATH**/ ?>
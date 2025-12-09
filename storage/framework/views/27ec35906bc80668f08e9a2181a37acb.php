<div>
    <form wire:submit="save">
        <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 dark:border-dark-border">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Custom Tags</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Inject custom HTML, CSS, or JavaScript into your layouts.</p>
            </div>

            <div class="p-6 space-y-8">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $layouts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $layoutKey => $layout): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="border border-slate-200 dark:border-dark-border rounded-lg overflow-hidden">
                    <div class="px-4 py-3 bg-slate-50 dark:bg-dark-soft border-b border-slate-200 dark:border-dark-border">
                        <h4 class="text-sm font-semibold text-slate-900 dark:text-white"><?php echo e($layout['name']); ?></h4>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5"><?php echo e($layout['description']); ?></p>
                    </div>
                    <div class="p-4 grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div>
                            <label for="<?php echo e($layoutKey); ?>_head" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                                <code class="text-primary-600 dark:text-primary-400">&lt;head&gt;</code> Tags
                            </label>
                            <textarea wire:model="state.<?php echo e($layoutKey); ?>_head_tags" id="<?php echo e($layoutKey); ?>_head" rows="4" placeholder="<!-- Analytics, meta tags, styles -->" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white font-mono text-xs placeholder-slate-400 dark:placeholder-slate-500 focus:border-primary-500 focus:ring-primary-500"></textarea>
                        </div>
                        <div>
                            <label for="<?php echo e($layoutKey); ?>_body" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                                Before <code class="text-primary-600 dark:text-primary-400">&lt;/body&gt;</code> Tags
                            </label>
                            <textarea wire:model="state.<?php echo e($layoutKey); ?>_body_tags" id="<?php echo e($layoutKey); ?>_body" rows="4" placeholder="<!-- Scripts, chat widgets -->" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white font-mono text-xs placeholder-slate-400 dark:placeholder-slate-500 focus:border-primary-500 focus:ring-primary-500"></textarea>
                        </div>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                <div class="p-4 bg-yellow-50 dark:bg-yellow-900/20 border border-yellow-200 dark:border-yellow-700/30 rounded-lg">
                    <div class="flex gap-3">
                        <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <div>
                            <p class="text-sm font-medium text-yellow-800 dark:text-yellow-400">Security Notice</p>
                            <p class="text-xs text-yellow-700 dark:text-yellow-300/70 mt-1">Only add trusted scripts. Malicious code can compromise your application and user data.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-slate-50 dark:bg-dark-soft border-t border-slate-200 dark:border-dark-border flex justify-end">
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-base transition">
                    Save Changes
                </button>
            </div>
        </div>
    </form>
</div><?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/admin/livewire/settings/custom-tags.blade.php ENDPATH**/ ?>
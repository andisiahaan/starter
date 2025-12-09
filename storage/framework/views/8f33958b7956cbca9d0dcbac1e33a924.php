<div class="space-y-6" x-data="{ activeTab: <?php if ((object) ('activeTab') instanceof \Livewire\WireDirective) : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('activeTab'->value()); ?>')<?php echo e('activeTab'->hasModifier('live') ? '.live' : ''); ?><?php else : ?>window.Livewire.find('<?php echo e($__livewire->getId()); ?>').entangle('<?php echo e('activeTab'); ?>')<?php endif; ?>.live }">
    
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e(__('Account Settings')); ?></h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400"><?php echo e(__('Manage your profile, security, and preferences.')); ?></p>
    </div>

    
    <div class="border-b border-slate-200 dark:border-dark-border">
        <nav class="flex gap-4 -mb-px overflow-x-auto no-scrollbar" aria-label="Tabs">
            <button
                wire:click="setTab('profile')"
                :class="activeTab === 'profile' ? 'border-primary-500 text-primary-600 dark:text-primary-400' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-white'"
                class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm transition-colors">
                <?php echo e(__('Profile')); ?>

            </button>
            <button
                wire:click="setTab('security')"
                :class="activeTab === 'security' ? 'border-primary-500 text-primary-600 dark:text-primary-400' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-white'"
                class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm transition-colors">
                <?php echo e(__('Security')); ?>

            </button>
            <button
                wire:click="setTab('2fa')"
                :class="activeTab === '2fa' ? 'border-primary-500 text-primary-600 dark:text-primary-400' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-white'"
                class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm transition-colors">
                <?php echo e(__('Two-Factor Auth')); ?>

            </button>
            <button
                wire:click="setTab('notifications')"
                :class="activeTab === 'notifications' ? 'border-primary-500 text-primary-600 dark:text-primary-400' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-white'"
                class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm transition-colors">
                <?php echo e(__('Notifications')); ?>

            </button>
            <button
                wire:click="setTab('sessions')"
                :class="activeTab === 'sessions' ? 'border-primary-500 text-primary-600 dark:text-primary-400' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-white'"
                class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm transition-colors">
                <?php echo e(__('Sessions')); ?>

            </button>
        </nav>
    </div>

    
    <div class="bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border shadow-sm overflow-hidden">
        <div x-show="activeTab === 'profile'" x-cloak>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('app.account.profile');

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1291475173-0', $key);

$__html = app('livewire')->mount($__name, $__params, $key, $__componentSlots);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
        <div x-show="activeTab === 'security'" x-cloak>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('app.account.security');

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1291475173-1', $key);

$__html = app('livewire')->mount($__name, $__params, $key, $__componentSlots);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
        <div x-show="activeTab === '2fa'" x-cloak>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('app.account.two-factor-auth');

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1291475173-2', $key);

$__html = app('livewire')->mount($__name, $__params, $key, $__componentSlots);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
        <div x-show="activeTab === 'notifications'" x-cloak>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('app.account.notifications');

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1291475173-3', $key);

$__html = app('livewire')->mount($__name, $__params, $key, $__componentSlots);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
        <div x-show="activeTab === 'sessions'" x-cloak>
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('app.account.sessions');

$key = null;
$__componentSlots = [];

$key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-1291475173-4', $key);

$__html = app('livewire')->mount($__name, $__params, $key, $__componentSlots);

echo $__html;

unset($__html);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
if (isset($__slots)) unset($__slots);
?>
        </div>
    </div>
</div><?php /**PATH D:\Installed\Apps\laragon\www\gramsea\resources\views/livewire/app/account/index.blade.php ENDPATH**/ ?>
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'type' => null,
    'message' => null,
    'dismissible' => true,
    'autoHide' => true,
    'hideAfter' => 6000
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'type' => null,
    'message' => null,
    'dismissible' => true,
    'autoHide' => true,
    'hideAfter' => 6000
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    use App\Enums\AlertType;

    $alertsToShow = [];

    // Manual alert
    if ($type && $message) {
        $alertType = AlertType::tryFrom($type);
        if ($alertType) {
            $alertsToShow[] = ['type' => $alertType, 'message' => $message];
        }
    } else {
        // Auto-detect from session
        foreach (AlertType::getSessionTypes() as $sessionType) {
            if (session()->has($sessionType)) {
                $enum = AlertType::tryFrom($sessionType);
                if ($enum) {
                    $alertsToShow[] = ['type' => $enum, 'message' => session($sessionType)];
                }
            }
        }
    }
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($alertsToShow) > 0): ?>
<div class="space-y-3 mb-6">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $alertsToShow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $alert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        <?php if($autoHide): ?>
        x-init="setTimeout(() => show = false, <?php echo e($hideAfter); ?>)"
        <?php endif; ?>
        class="flex items-center gap-3 px-4 py-3 rounded-lg border <?php echo e($alert['type']->getAlertClasses()); ?>"
        role="alert"
    >
        <!-- Icon -->
        <div class="flex-shrink-0 <?php echo e($alert['type']->getIconColorClasses()); ?>">
            <?php echo $alert['type']->getIconSvg(); ?>

        </div>

        <!-- Message -->
        <div class="flex-1 text-sm font-medium">
            <?php echo e($alert['message']); ?>

        </div>

        <!-- Dismiss -->
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($dismissible): ?>
        <button
            type="button"
            @click="show = false"
            class="flex-shrink-0 p-1 rounded hover:bg-white/10 transition-colors opacity-60 hover:opacity-100"
            aria-label="Dismiss"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
</div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/layouts/partials/alert.blade.php ENDPATH**/ ?>
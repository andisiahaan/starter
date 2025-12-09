@props([
    'type' => null,
    'message' => null,
    'dismissible' => true,
    'autoHide' => true,
    'hideAfter' => 6000
])

@php
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
@endphp

@if(count($alertsToShow) > 0)
<div class="space-y-3 mb-6">
    @foreach ($alertsToShow as $index => $alert)
    <div
        x-data="{ show: true }"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        @if($autoHide)
        x-init="setTimeout(() => show = false, {{ $hideAfter }})"
        @endif
        class="flex items-center gap-3 px-4 py-3 rounded-lg border {{ $alert['type']->getAlertClasses() }}"
        role="alert"
    >
        <!-- Icon -->
        <div class="flex-shrink-0 {{ $alert['type']->getIconColorClasses() }}">
            {!! $alert['type']->getIconSvg() !!}
        </div>

        <!-- Message -->
        <div class="flex-1 text-sm font-medium">
            {{ $alert['message'] }}
        </div>

        <!-- Dismiss -->
        @if($dismissible)
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
        @endif
    </div>
    @endforeach
</div>
@endif

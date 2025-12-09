@props([
    'position' => 'top-right',
    'hideAfter' => 5000
])

@php
    use App\Enums\AlertType;
    
    $positionClasses = match($position) {
        'top-right' => 'top-4 right-4',
        'top-left' => 'top-4 left-4',
        'bottom-right' => 'bottom-4 right-4',
        'bottom-left' => 'bottom-4 left-4',
        default => 'top-4 right-4'
    };

    // Pre-render icon data for Alpine
    $iconData = [];
    foreach (AlertType::cases() as $type) {
        $iconData[$type->value] = [
            'svg' => $type->getIconSvg(),
            'bgClass' => $type->getIconBgClasses(),
            'colorClass' => $type->getIconColorClasses(),
        ];
    }
@endphp

{{-- Toast Container --}}
<div 
    x-data="toastManager(@js($iconData))"
    class="fixed {{ $positionClasses }} z-50 space-y-3 pointer-events-none"
    style="width: calc(100vw - 2rem); max-width: 24rem;"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div 
            x-show="toast.visible"
            x-transition:enter="transform ease-out duration-300"
            x-transition:enter-start="translate-x-full opacity-0"
            x-transition:enter-end="translate-x-0 opacity-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="translate-x-0 opacity-100"
            x-transition:leave-end="translate-x-full opacity-0"
            class="flex items-start gap-3 bg-dark-elevated shadow-xl rounded-xl pointer-events-auto border border-dark-border overflow-hidden"
            role="alert"
        >
            {{-- Icon --}}
            <div class="flex-shrink-0 pl-4 pt-4">
                <div 
                    class="flex items-center justify-center w-10 h-10 rounded-lg"
                    :class="getIconBg(toast.type)"
                >
                    <span :class="getIconColor(toast.type)" x-html="getIconSvg(toast.type)"></span>
                </div>
            </div>
            
            {{-- Content --}}
            <div class="flex-1 py-4 pr-2">
                <p class="text-sm font-medium text-white" x-text="toast.message"></p>
            </div>
            
            {{-- Close Button --}}
            <div class="flex-shrink-0 pt-4 pr-4">
                <button 
                    @click="remove(toast.id)"
                    class="p-1 rounded-lg text-slate-400 hover:text-white hover:bg-white/10 transition-colors"
                >
                    <span class="sr-only">Close</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </template>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('toastManager', (iconData) => ({
        toasts: [],
        nextId: 1,
        hideAfter: {{ $hideAfter }},
        iconData: iconData,
        
        init() {
            Livewire.on('toast', (event) => {
                const data = Array.isArray(event) ? event[0] : event;
                this.show(data);
            });
        },
        
        show(data) {
            const toast = {
                id: this.nextId++,
                type: data.type || 'info',
                message: data.message || 'Notification',
                visible: true
            };
            
            this.toasts.push(toast);
            
            setTimeout(() => {
                this.remove(toast.id);
            }, this.hideAfter);
        },
        
        remove(id) {
            const index = this.toasts.findIndex(t => t.id === id);
            if (index !== -1) {
                this.toasts[index].visible = false;
                setTimeout(() => {
                    this.toasts.splice(index, 1);
                }, 300);
            }
        },

        getIconSvg(type) {
            return this.iconData[type]?.svg || this.iconData['info'].svg;
        },

        getIconBg(type) {
            return this.iconData[type]?.bgClass || this.iconData['info'].bgClass;
        },

        getIconColor(type) {
            return this.iconData[type]?.colorClass || this.iconData['info'].colorClass;
        }
    }));
});
</script>
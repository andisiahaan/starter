<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ __('admin.orders.modals.detail.title') }}</h3>
        <button wire:click="$dispatch('closeModal')" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:text-white dark:hover:bg-white/10 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Body --}}
    @if($order)
    <div class="p-5 space-y-5 max-h-[70vh] overflow-y-auto">
        {{-- Order Info --}}
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('credits.orders.table.order_id') }}</p>
                <p class="font-medium text-slate-900 dark:text-white">{{ $order->order_number }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('common.table.status') }}</p>
                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                    @if($order->status === 'verified') bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400
                    @elseif($order->status === 'pending') bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400
                    @elseif($order->status === 'failed') bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400
                    @else bg-slate-100 dark:bg-slate-700 text-slate-700 dark:text-slate-300 @endif">
                    {{ ucfirst($order->status) }}
                </span>
            </div>
            <div>
                <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('common.table.created_at') }}</p>
                <p class="font-medium text-slate-900 dark:text-white">{{ $order->created_at->format('M d, Y H:i') }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('common.verified_at') }}</p>
                <p class="font-medium text-slate-900 dark:text-white">{{ $order->verified_at?->format('M d, Y H:i') ?? '-' }}</p>
            </div>
        </div>

        <hr class="border-slate-200 dark:border-dark-border">

        {{-- Customer --}}
        <div>
            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-2">{{ __('credits.orders.table.customer') }}</h4>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('common.table.name') }}</p>
                    <p class="font-medium text-slate-900 dark:text-white">{{ $order->user?->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('common.table.email') }}</p>
                    <p class="font-medium text-slate-900 dark:text-white">{{ $order->user?->email ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <hr class="border-slate-200 dark:border-dark-border">

        {{-- Product --}}
        <div>
            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-2">{{ __('credits.orders.table.product') }}</h4>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('credits.products.form.name') }}</p>
                    <p class="font-medium text-slate-900 dark:text-white">{{ $order->product_name }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('credits.credits') }}</p>
                    <p class="font-medium text-slate-900 dark:text-white">{{ number_format($order->credit_amount, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <hr class="border-slate-200 dark:border-dark-border">

        {{-- Payment --}}
        <div>
            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-2">{{ __('credits.orders.detail.payment_info') }}</h4>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('credits.orders.detail.payment_method') }}</p>
                    <p class="font-medium text-slate-900 dark:text-white">{{ $order->paymentMethod?->name ?? $order->payment_method_code }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('credits.credit_logs.detail.reference') }}</p>
                    <p class="font-medium text-slate-900 dark:text-white font-mono text-sm">{{ $order->payment_reference ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('credits.user.purchase.subtotal') }}</p>
                    <p class="font-medium text-slate-900 dark:text-white">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('credits.user.purchase.payment_fee') }}</p>
                    <p class="font-medium text-slate-900 dark:text-white">Rp {{ number_format($order->fee_amount, 0, ',', '.') }}</p>
                </div>
            </div>
            <div class="mt-3 p-3 bg-primary-50 dark:bg-primary-900/20 rounded-lg">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('credits.user.purchase.total') }}</span>
                    <span class="text-lg font-bold text-primary-600 dark:text-primary-400">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        @if($order->notes)
        <hr class="border-slate-200 dark:border-dark-border">
        <div>
            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-2">{{ __('credits.orders.detail.notes') }}</h4>
            <pre class="text-sm text-slate-600 dark:text-slate-300 whitespace-pre-wrap font-sans bg-slate-50 dark:bg-dark-soft p-3 rounded-lg">{{ $order->notes }}</pre>
        </div>
        @endif
    </div>
    @endif

    {{-- Footer --}}
    <div class="flex items-center justify-end gap-3 px-5 py-4 border-t border-slate-200 dark:border-dark-border bg-slate-50 dark:bg-dark-soft">
        <button wire:click="$dispatch('closeModal')" class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-dark-muted border border-slate-300 dark:border-dark-border rounded-lg hover:bg-slate-50 dark:hover:bg-dark-border transition">
            {{ __('common.actions.close') }}
        </button>
    </div>
</div>


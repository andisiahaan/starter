<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ __('admin.credit_logs.modals.detail.title') }}</h3>
        <button wire:click="$dispatch('closeModal')" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:text-white dark:hover:bg-white/10 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Body --}}
    @if($log)
    <div class="p-5 space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <p class="text-xs text-slate-500 dark:text-slate-400">Date</p>
                <p class="font-medium text-slate-900 dark:text-white">{{ $log->created_at->format('M d, Y H:i:s') }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-500 dark:text-slate-400">Type</p>
                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full
                    @if($log->type === 'PURCHASE') bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400
                    @elseif($log->type === 'BROADCAST_FEE') bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400
                    @elseif($log->type === 'REFUND') bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400
                    @else bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 @endif">
                    {{ $log->type }}
                </span>
            </div>
        </div>

        <hr class="border-slate-200 dark:border-dark-border">

        <div>
            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-2">User</h4>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Name</p>
                    <p class="font-medium text-slate-900 dark:text-white">{{ $log->user?->name ?? 'N/A' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Email</p>
                    <p class="font-medium text-slate-900 dark:text-white">{{ $log->user?->email ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <hr class="border-slate-200 dark:border-dark-border">

        <div>
            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-2">{{ __('credits.credit_logs.detail.credit_change') }}</h4>
            <div class="grid grid-cols-3 gap-4">
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('credits.credit_logs.detail.before') }}</p>
                    <p class="font-medium text-slate-900 dark:text-white">{{ number_format($log->balance_before, 0, ',', '.') }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Amount</p>
                    <p class="font-bold {{ $log->amount >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                        {{ $log->amount >= 0 ? '+' : '' }}{{ number_format($log->amount, 0, ',', '.') }}
                    </p>
                </div>
                <div>
                    <p class="text-xs text-slate-500 dark:text-slate-400">{{ __('credits.credit_logs.detail.after') }}</p>
                    <p class="font-medium text-slate-900 dark:text-white">{{ number_format($log->balance_after, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

        @if($log->description)
        <hr class="border-slate-200 dark:border-dark-border">
        <div>
            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-2">Description</h4>
            <p class="text-sm text-slate-600 dark:text-slate-300">{{ $log->description }}</p>
        </div>
        @endif

        @if($log->meta && count($log->meta) > 0)
        <hr class="border-slate-200 dark:border-dark-border">
        <div>
            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-2">{{ __('credits.credit_logs.detail.additional_info') }}</h4>
            <pre class="text-xs text-slate-600 dark:text-slate-300 bg-slate-50 dark:bg-dark-soft p-3 rounded-lg overflow-x-auto">{{ json_encode($log->meta, JSON_PRETTY_PRINT) }}</pre>
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


<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    {{-- Header --}}
    <div class="flex items-center gap-4 px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
            <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
        </div>
        <div>
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Revoke Token</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400">This action cannot be undone.</p>
        </div>
    </div>

    {{-- Body --}}
    <div class="p-5">
        <p class="text-slate-600 dark:text-slate-300">
            Are you sure you want to revoke the token <strong class="text-slate-900 dark:text-white">"{{ $tokenName }}"</strong>?
        </p>
        <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">
            Any integrations using this token will immediately stop working.
        </p>
    </div>

    {{-- Footer --}}
    <div class="flex items-center justify-end gap-3 px-5 py-4 border-t border-slate-200 dark:border-dark-border bg-slate-50 dark:bg-dark-soft">
        <button wire:click="$dispatch('closeModal')" class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-dark-muted border border-slate-300 dark:border-dark-border rounded-lg hover:bg-slate-50 dark:hover:bg-dark-border transition">
            Cancel
        </button>
        <button wire:click="revoke" class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg hover:bg-red-700 transition" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="revoke">Revoke Token</span>
            <span wire:loading wire:target="revoke">Revoking...</span>
        </button>
    </div>
</div>

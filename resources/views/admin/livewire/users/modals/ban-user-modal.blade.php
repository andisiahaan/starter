<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
            {{ __('Ban User') }}
        </h3>
        <button wire:click="$dispatch('closeModal')" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:text-white dark:hover:bg-white/10 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Body --}}
    <div class="p-5">
        <div class="flex items-start gap-4 mb-4">
            <div class="flex-shrink-0 w-10 h-10 rounded-full bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center">
                <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                </svg>
            </div>
            <div>
                <p class="text-slate-700 dark:text-slate-300">
                    You are about to ban <strong class="text-slate-900 dark:text-white">{{ $user?->name }}</strong>
                </p>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    This user will no longer be able to log in until unbanned.
                </p>
            </div>
        </div>
        <div>
            <label for="banReason" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Ban Reason (optional)</label>
            <textarea wire:model="banReason" id="banReason" rows="3" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm" placeholder="Reason for banning this user..."></textarea>
        </div>
    </div>

    {{-- Footer --}}
    <div class="flex items-center justify-end gap-3 px-5 py-4 border-t border-slate-200 dark:border-dark-border bg-slate-50 dark:bg-dark-soft">
        <button wire:click="$dispatch('closeModal')" class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-dark-muted border border-slate-300 dark:border-dark-border rounded-lg hover:bg-slate-50 dark:hover:bg-dark-border transition">
            Cancel
        </button>
        <button wire:click="ban" class="px-4 py-2 text-sm font-medium text-white bg-amber-600 border border-transparent rounded-lg hover:bg-amber-700 transition" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="ban">Ban User</span>
            <span wire:loading wire:target="ban">Banning...</span>
        </button>
    </div>
</div>


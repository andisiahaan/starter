<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    {{-- Header --}}
    <div class="flex items-center gap-4 px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <div class="flex-shrink-0 h-10 w-10 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
            <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <div>
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Token Created Successfully!</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400">Copy your token now. It won't be shown again.</p>
        </div>
    </div>

    {{-- Body --}}
    <div class="p-5">
        <div class="p-4 bg-slate-50 dark:bg-dark-soft rounded-lg border border-slate-200 dark:border-dark-border">
            <div class="flex items-center justify-between gap-4">
                <code class="text-sm text-primary-600 dark:text-primary-400 break-all select-all font-mono">{{ $plainTextToken }}</code>
                <button onclick="navigator.clipboard.writeText('{{ $plainTextToken }}').then(() => this.innerText = 'Copied!')" 
                    class="flex-shrink-0 px-3 py-1.5 text-xs font-medium text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20 rounded-md hover:bg-primary-100 dark:hover:bg-primary-900/30 transition">
                    Copy
                </button>
            </div>
        </div>
        
        <div class="mt-4 p-4 bg-amber-50 dark:bg-amber-900/20 rounded-lg border border-amber-200 dark:border-amber-700/30">
            <div class="flex gap-3">
                <svg class="h-5 w-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div>
                    <p class="text-sm font-medium text-amber-800 dark:text-amber-300">Keep this token safe!</p>
                    <p class="text-xs text-amber-700 dark:text-amber-400 mt-1">Store it securely. You won't be able to see it again after closing this dialog.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="flex items-center justify-end px-5 py-4 border-t border-slate-200 dark:border-dark-border bg-slate-50 dark:bg-dark-soft">
        <button wire:click="$dispatch('closeModal')" class="px-4 py-2 text-sm font-medium text-white bg-primary-600 border border-transparent rounded-lg hover:bg-primary-700 transition">
            Done
        </button>
    </div>
</div>

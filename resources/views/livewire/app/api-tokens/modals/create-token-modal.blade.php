<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Create API Token</h3>
        <button wire:click="$dispatch('closeModal')" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 dark:hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Body --}}
    <div class="p-5">
        <form wire:submit="create" class="space-y-5">
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Token Name</label>
                <input wire:model="tokenName" type="text" placeholder="e.g. My Integration" 
                    class="w-full rounded-md border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                @error('tokenName') <span class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-3">Abilities</label>
                <div class="space-y-3 p-4 bg-slate-50 dark:bg-dark-soft rounded-lg border border-slate-200 dark:border-dark-border">
                    @foreach($abilities as $ability)
                    <label class="flex items-start gap-3 cursor-pointer">
                        <input wire:model="selectedAbilities" type="checkbox" value="{{ $ability['value'] }}" 
                            class="mt-0.5 rounded border-slate-300 dark:border-dark-border text-primary-600 bg-white dark:bg-dark-muted focus:ring-primary-500">
                        <div>
                            <span class="text-sm font-medium text-slate-700 dark:text-white">{{ $ability['label'] }}</span>
                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $ability['description'] }}</p>
                        </div>
                    </label>
                    @endforeach
                </div>
                @error('selectedAbilities') <span class="text-red-500 dark:text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Expiration</label>
                <select wire:model="expiresAt" class="w-full rounded-md border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    @foreach($this->expirationOptions as $value => $label)
                    <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">When should this token expire?</p>
            </div>
        </form>
    </div>

    {{-- Footer --}}
    <div class="flex items-center justify-end gap-3 px-5 py-4 border-t border-slate-200 dark:border-dark-border bg-slate-50 dark:bg-dark-soft">
        <button wire:click="$dispatch('closeModal')" class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-dark-muted border border-slate-300 dark:border-dark-border rounded-lg hover:bg-slate-50 dark:hover:bg-dark-border transition">
            Cancel
        </button>
        <button wire:click="create" class="px-4 py-2 text-sm font-medium text-white bg-primary-600 border border-transparent rounded-lg hover:bg-primary-700 transition" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="create">Create Token</span>
            <span wire:loading wire:target="create">Creating...</span>
        </button>
    </div>
</div>

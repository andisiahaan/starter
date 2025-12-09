<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
            {{ $paymentMethodId ? __('Edit Payment Method') : __('Create Payment Method') }}
        </h3>
        <button wire:click="$dispatch('closeModal')" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:text-white dark:hover:bg-white/10 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Body --}}
    <div class="p-5 max-h-[70vh] overflow-y-auto">
        <form wire:submit="save" class="space-y-4">
            {{-- Provider Selection --}}
            <div>
                <label for="provider" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Provider</label>
                <select wire:model="provider" id="provider" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                    @foreach($providers as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('provider') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                    <span class="font-medium">TRIPAY:</span> Uses Tripay payment gateway |
                    <span class="font-medium">MANUAL:</span> Manual confirmation required
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="code" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Code</label>
                    <input type="text" id="code" wire:model="code" placeholder="BRIVA" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm uppercase">
                    @error('code') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                        For TRIPAY, use Tripay channel code (e.g., BRIVA, BCAVA, QRIS)
                    </p>
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Type</label>
                    <select wire:model="type" id="type" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                        @foreach($types as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('type') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Name</label>
                <input type="text" id="name" wire:model="name" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                @error('name') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Description</label>
                <textarea wire:model="description" id="description" rows="2" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm" placeholder="For MANUAL provider, include payment instructions here"></textarea>
                @error('description') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="min_amount" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Min Amount (Rp)</label>
                    <input type="number" id="min_amount" wire:model="min_amount" step="0.01" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                    @error('min_amount') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="max_amount" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Max Amount (Rp)</label>
                    <input type="number" id="max_amount" wire:model="max_amount" step="0.01" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                    @error('max_amount') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="fee_flat" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Flat Fee (Rp)</label>
                    <input type="number" id="fee_flat" wire:model="fee_flat" step="0.01" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                    @error('fee_flat') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="fee_percent" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Fee Percent (%)</label>
                    <input type="number" id="fee_percent" wire:model="fee_percent" step="0.01" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                    @error('fee_percent') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex items-center">
                <input type="checkbox" wire:model="is_active" id="is_active" class="h-4 w-4 rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500 bg-white dark:bg-dark-soft">
                <label for="is_active" class="ml-2 block text-sm text-slate-700 dark:text-slate-300">Active</label>
            </div>
        </form>
    </div>

    {{-- Footer --}}
    <div class="flex items-center justify-end gap-3 px-5 py-4 border-t border-slate-200 dark:border-dark-border bg-slate-50 dark:bg-dark-soft">
        <button wire:click="$dispatch('closeModal')" class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-dark-muted border border-slate-300 dark:border-dark-border rounded-lg hover:bg-slate-50 dark:hover:bg-dark-border transition">
            Cancel
        </button>
        <button wire:click="save" class="px-4 py-2 text-sm font-medium text-white bg-primary-600 border border-transparent rounded-lg hover:bg-primary-700 transition" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="save">{{ $paymentMethodId ? 'Update' : 'Create' }}</span>
            <span wire:loading wire:target="save">Saving...</span>
        </button>
    </div>
</div>


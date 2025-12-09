<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
            {{ $productId ? __('Edit Product') : __('Create Product') }}
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
            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Name</label>
                <input type="text" id="name" wire:model="name" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                @error('name') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="category_id" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Category</label>
                <select wire:model="category_id" id="category_id" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                    <option value="">No Category</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Description</label>
                <textarea wire:model="description" id="description" rows="2" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm"></textarea>
                @error('description') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="price" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Price (Rp)</label>
                    <input type="number" id="price" wire:model="price" step="0.01" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                    @error('price') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="credit_amount" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Credit Amount</label>
                    <input type="number" id="credit_amount" wire:model="credit_amount" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                    @error('credit_amount') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="bonus_credit" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Bonus Credit</label>
                    <input type="number" id="bonus_credit" wire:model="bonus_credit" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                    @error('bonus_credit') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="flex items-center pt-6">
                    <input type="checkbox" wire:model="is_active" id="is_active" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500">
                    <label for="is_active" class="ml-2 text-sm text-slate-700 dark:text-slate-300">Active</label>
                </div>
            </div>
        </form>
    </div>

    {{-- Footer --}}
    <div class="flex items-center justify-end gap-3 px-5 py-4 border-t border-slate-200 dark:border-dark-border bg-slate-50 dark:bg-dark-soft">
        <button wire:click="$dispatch('closeModal')" class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-dark-muted border border-slate-300 dark:border-dark-border rounded-lg hover:bg-slate-50 dark:hover:bg-dark-border transition">
            Cancel
        </button>
        <button wire:click="save" class="px-4 py-2 text-sm font-medium text-white bg-primary-600 border border-transparent rounded-lg hover:bg-primary-700 transition" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="save">{{ $productId ? 'Update' : 'Create' }}</span>
            <span wire:loading wire:target="save">Saving...</span>
        </button>
    </div>
</div>


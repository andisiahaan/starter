<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
            {{ $permissionId ? __('Edit Permission') : __('Create Permission') }}
        </h3>
        <button wire:click="$dispatch('closeModal')" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:text-white dark:hover:bg-white/10 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Body --}}
    <div class="p-5">
        <form wire:submit="save" class="space-y-4">
            <div>
                <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Permission Name</label>
                <input type="text" id="name" wire:model="name" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm" placeholder="e.g. users.create">
                @error('name') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="guard_name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Guard Name</label>
                <input type="text" id="guard_name" wire:model="guard_name" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                @error('guard_name') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Assign to Roles</label>
                <div class="grid grid-cols-2 gap-2 max-h-48 overflow-y-auto p-3 bg-slate-50 dark:bg-dark-soft rounded-md border border-slate-200 dark:border-dark-border">
                    @foreach($roles as $role)
                    <label class="flex items-center gap-2">
                        <input type="checkbox" wire:model="selectedRoles" value="{{ $role->name }}" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500 bg-white dark:bg-dark-muted">
                        <span class="text-sm text-slate-700 dark:text-slate-300">{{ $role->name }}</span>
                    </label>
                    @endforeach
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
            <span wire:loading.remove wire:target="save">{{ $permissionId ? 'Update' : 'Create' }}</span>
            <span wire:loading wire:target="save">Saving...</span>
        </button>
    </div>
</div>


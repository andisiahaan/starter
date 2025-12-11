<div class="bg-white dark:bg-dark-elevated rounded-lg p-2 md:p-6 w-full">
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $categoryId ? __('blog.categories.edit') : __('blog.categories.add') }}</h3>
        <button wire:click="$dispatch('closeModal')" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <form wire:submit="save" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('common.table.name') }}</label>
            <input type="text" wire:model="name" wire:blur="generateSlug" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('blog.posts.slug') }}</label>
            <input type="text" wire:model="slug" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('blog.posts.parent_category') }}</label>
            <select wire:model="parent_id" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                <option value="">{{ __('common.none') }}</option>
                @foreach($parentCategories as $parent)
                <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('common.table.description') }}</label>
            <textarea wire:model="description" rows="3" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm"></textarea>
        </div>

        <div class="flex items-center gap-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('blog.posts.order') }}</label>
                <input type="number" wire:model="order" min="0" class="mt-1 block w-24 rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
            </div>
            <label class="flex items-center gap-2 mt-6">
                <input type="checkbox" wire:model="is_active" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500">
                <span class="text-sm text-slate-700 dark:text-slate-300">{{ __('common.status.active') }}</span>
            </label>
        </div>

        <div class="flex justify-end gap-3 pt-4 border-t border-slate-200 dark:border-dark-border">
            <button type="button" wire:click="$dispatch('closeModal')" class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-dark-border rounded-lg transition">{{ __('common.actions.cancel') }}</button>
            <button type="submit" class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition">{{ $categoryId ? __('common.actions.update') : __('common.actions.create') }}</button>
        </div>
    </form>
</div>

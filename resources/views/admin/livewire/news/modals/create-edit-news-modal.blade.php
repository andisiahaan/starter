<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
            {{ $newsId ? __('admin.news.modals.edit.title') : __('admin.news.modals.create.title') }}
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
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2 sm:col-span-1">
                    <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('common.table.name') }}</label>
                    <input type="text" id="title" wire:model.live="title" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                    @error('title') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <label for="slug" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('blog.posts.slug') }}</label>
                    <input type="text" id="slug" wire:model="slug" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                    @error('slug') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
            <div>
                <label for="type" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('common.table.type') }}</label>
                <select wire:model="type" id="type" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                    @foreach($types as $key => $label)
                    <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>
                @error('type') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="content" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('news.form.content') }}</label>
                <textarea wire:model="content" id="content" rows="6" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm"></textarea>
                @error('content') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="published_at" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('news.form.publish_at') }}</label>
                    <input type="datetime-local" id="published_at" wire:model="published_at" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-slate-700 text-slate-900 dark:text-white sm:text-sm">
                    @error('published_at') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label for="expires_at" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('news.form.expires_at') }}</label>
                    <input type="datetime-local" id="expires_at" wire:model="expires_at" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-slate-700 text-slate-900 dark:text-white sm:text-sm">
                    @error('expires_at') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="flex items-center gap-6">
                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="is_published" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500">
                    <span class="text-sm text-slate-700 dark:text-slate-300">{{ __('common.status.published') }}</span>
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="is_pinned" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500">
                    <span class="text-sm text-slate-700 dark:text-slate-300">{{ __('news.form.pinned') }}</span>
                </label>
            </div>
        </form>
    </div>

    {{-- Footer --}}
    <div class="flex items-center justify-end gap-3 px-5 py-4 border-t border-slate-200 dark:border-dark-border bg-slate-50 dark:bg-dark-soft">
        <button wire:click="$dispatch('closeModal')" class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 bg-white dark:bg-dark-muted border border-slate-300 dark:border-dark-border rounded-lg hover:bg-slate-50 dark:hover:bg-dark-border transition">
            {{ __('common.actions.cancel') }}
        </button>
        <button wire:click="save" class="px-4 py-2 text-sm font-medium text-white bg-primary-600 border border-transparent rounded-lg hover:bg-primary-700 transition" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="save">{{ $newsId ? __('admin.news.modals.create.update') : __('admin.news.modals.create.create') }}</span>
            <span wire:loading wire:target="save">{{ __('admin.news.modals.create.saving') }}</span>
        </button>
    </div>
</div>


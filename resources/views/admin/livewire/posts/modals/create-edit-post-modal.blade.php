<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
            {{ $postId ? __('Edit Post') : __('Create Post') }}
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
            {{-- Title & Slug --}}
            <div class="grid grid-cols-2 gap-4">
                <div class="col-span-2 sm:col-span-1">
                    <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Title</label>
                    <input type="text" id="title" wire:model.live="title" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                    @error('title') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <label for="slug" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Slug</label>
                    <input type="text" id="slug" wire:model="slug" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                    @error('slug') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Excerpt --}}
            <div>
                <label for="excerpt" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Excerpt</label>
                <textarea wire:model="excerpt" id="excerpt" rows="2" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm" placeholder="Short description for listing pages..."></textarea>
                @error('excerpt') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            {{-- Content --}}
            <div>
                <label for="content" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Content</label>
                <textarea wire:model="content" id="content" rows="8" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm"></textarea>
                @error('content') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            {{-- Thumbnail --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">Thumbnail</label>
                <div class="mt-2 flex items-center gap-4">
                    @if($existingThumbnail && !$thumbnail)
                        <div class="relative">
                            <img src="{{ Storage::url($existingThumbnail) }}" alt="" class="w-24 h-24 rounded-lg object-cover">
                            <button type="button" wire:click="removeThumbnail" class="absolute -top-2 -right-2 p-1 bg-red-500 text-white rounded-full hover:bg-red-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @elseif($thumbnail)
                        <div class="relative">
                            <img src="{{ $thumbnail->temporaryUrl() }}" alt="" class="w-24 h-24 rounded-lg object-cover">
                            <button type="button" wire:click="removeThumbnail" class="absolute -top-2 -right-2 p-1 bg-red-500 text-white rounded-full hover:bg-red-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endif
                    <div class="flex-1">
                        <input type="file" wire:model="thumbnail" accept="image/*" class="block w-full text-sm text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 dark:file:bg-primary-900/30 file:text-primary-700 dark:file:text-primary-400 hover:file:bg-primary-100 dark:hover:file:bg-primary-900/50">
                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Max 2MB. Recommended: 1200x630px</p>
                    </div>
                </div>
                @error('thumbnail') <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>

            {{-- Published --}}
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" wire:model="is_published" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500">
                        <span class="text-sm text-slate-700 dark:text-slate-300">Published</span>
                    </label>
                </div>
                <div>
                    <label for="published_at" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Publish At</label>
                    <input type="datetime-local" id="published_at" wire:model="published_at" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                </div>
            </div>

            {{-- SEO Section --}}
            <div class="pt-4 border-t border-slate-200 dark:border-dark-border">
                <h4 class="text-sm font-medium text-slate-900 dark:text-white mb-3">SEO Settings</h4>
                <div class="space-y-3">
                    <div>
                        <label for="meta_title" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Meta Title <span class="text-slate-400">(max 70 chars)</span></label>
                        <input type="text" id="meta_title" wire:model="meta_title" maxlength="70" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm">
                    </div>
                    <div>
                        <label for="meta_description" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Meta Description <span class="text-slate-400">(max 160 chars)</span></label>
                        <textarea wire:model="meta_description" id="meta_description" rows="2" maxlength="160" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm"></textarea>
                    </div>
                    <div>
                        <label for="meta_keywords" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Meta Keywords <span class="text-slate-400">(comma separated)</span></label>
                        <input type="text" id="meta_keywords" wire:model="meta_keywords" class="mt-1 block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-soft text-slate-900 dark:text-white sm:text-sm" placeholder="keyword1, keyword2, keyword3">
                    </div>
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
            <span wire:loading.remove wire:target="save">{{ $postId ? 'Update' : 'Create' }}</span>
            <span wire:loading wire:target="save">Saving...</span>
        </button>
    </div>
</div>

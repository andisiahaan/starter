<div>
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $isEditing ? __('blog.form.edit_post') : __('blog.form.create_post') }}</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $isEditing ? __('blog.form.edit_subtitle') : __('blog.form.create_subtitle') }}</p>
        </div>
        <a href="{{ route('admin.blog.posts.index') }}" class="text-sm text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white">
            ← {{ __('blog.form.back_to_posts') }}
        </a>
    </div>

    <form wire:submit="save">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Title & Slug -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border p-6">
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('blog.form.title') }}</label>
                            <input type="text" wire:model="title" wire:blur="generateSlug" placeholder="{{ __('blog.form.title_placeholder') }}" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 text-lg">
                            @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('blog.posts.slug') }}</label>
                            <div class="flex items-center gap-2">
                                <span class="text-sm text-slate-500 dark:text-slate-400">/blog/</span>
                                <input type="text" wire:model="slug" class="flex-1 rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            </div>
                            @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <!-- Excerpt -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border p-6">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('blog.form.excerpt') }}</label>
                    <textarea wire:model="excerpt" rows="2" placeholder="{{ __('blog.form.excerpt_placeholder') }}" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm"></textarea>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">{{ __('blog.form.excerpt_help') }}</p>
                    @error('excerpt') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <!-- Content with Trix Rich Editor -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border p-6">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ __('blog.form.content') }}</label>
                    
                    <!-- Trix Editor -->
                    <div wire:ignore>
                        <input id="content" type="hidden" value="{{ $content }}">
                        <trix-editor 
                            input="content"
                            class="trix-content prose dark:prose-invert max-w-none min-h-[400px] rounded-lg border border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500"
                            x-data
                            x-on:trix-change="$wire.set('content', $event.target.value)"
                        ></trix-editor>
                    </div>
                    @error('content') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">{{ __('blog.form.content_help') }}</p>
                </div>

                <!-- SEO Settings -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-dark-border">
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white">{{ __('blog.form.seo_settings') }}</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('blog.form.meta_title') }}</label>
                            <input type="text" wire:model="meta_title" placeholder="{{ __('blog.form.meta_title_placeholder') }}" maxlength="70" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('blog.form.meta_description') }}</label>
                            <textarea wire:model="meta_description" rows="2" placeholder="{{ __('blog.form.meta_description_placeholder') }}" maxlength="160" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm"></textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('blog.form.meta_keywords') }}</label>
                            <input type="text" wire:model="meta_keywords" placeholder="{{ __('blog.form.meta_keywords_placeholder') }}" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Publish Settings -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-dark-border">
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white">{{ __('blog.form.publish') }}</h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('common.table.status') }}</label>
                            <select wire:model.live="status" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                                <option value="draft">{{ __('common.status.draft') }}</option>
                                <option value="published">{{ __('common.status.published') }}</option>
                                <option value="scheduled">{{ __('common.status.scheduled') }}</option>
                                <option value="archived">{{ __('common.status.archived') }}</option>
                            </select>
                        </div>
                        @if($status === 'scheduled' || $status === 'published')
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('blog.form.publish_date') }}</label>
                            <input type="datetime-local" wire:model="published_at" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>
                        @endif
                        <div class="flex flex-col gap-2">
                            <label class="flex items-center gap-2">
                                <input type="checkbox" wire:model="is_featured" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500">
                                <span class="text-sm text-slate-700 dark:text-slate-300">{{ __('blog.form.featured_post') }}</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="checkbox" wire:model="allow_comments" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500">
                                <span class="text-sm text-slate-700 dark:text-slate-300">{{ __('blog.form.allow_comments') }}</span>
                            </label>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-slate-50 dark:bg-dark-soft border-t border-slate-200 dark:border-dark-border">
                        <button type="submit" class="w-full px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition">
                            {{ $isEditing ? __('blog.form.update_post') : __('blog.form.publish_post') }}
                        </button>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-dark-border">
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white">{{ __('blog.form.featured_image') }}</h3>
                    </div>
                    <div class="p-6">
                        @if($existing_image || $featured_image)
                        <div class="relative mb-4">
                            <img src="{{ $featured_image ? $featured_image->temporaryUrl() : Storage::url($existing_image) }}" alt="" class="w-full h-40 object-cover rounded-lg">
                            <button type="button" wire:click="removeImage" class="absolute top-2 right-2 p-1 bg-red-500 text-white rounded-full hover:bg-red-600">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        @endif
                        <input type="file" wire:model="featured_image" accept="image/*" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 dark:file:bg-primary-900/30 dark:file:text-primary-400">
                        @error('featured_image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Categories -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-dark-border flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white">{{ __('blog.public.categories') }}</h3>
                        <button type="button" wire:click="$toggle('showNewCategoryInput')" class="text-xs text-primary-600 hover:text-primary-700">
                            {{ $showNewCategoryInput ? __('common.actions.cancel') : '+ ' . __('blog.form.add_new') }}
                        </button>
                    </div>
                    @if($showNewCategoryInput)
                    <div class="p-4 bg-slate-50 dark:bg-dark-soft border-b border-slate-200 dark:border-dark-border">
                        <div class="flex gap-2">
                            <input type="text" wire:model="newCategoryName" wire:keydown.enter="createCategory" placeholder="{{ __('blog.categories.form.name_placeholder') }}" class="flex-1 rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white text-sm focus:border-primary-500 focus:ring-primary-500">
                            <button type="button" wire:click="createCategory" class="px-3 py-2 bg-primary-600 text-white text-xs font-medium rounded-lg hover:bg-primary-700">
                                {{ __('common.actions.add') }}
                            </button>
                        </div>
                        @error('newCategoryName') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    @endif
                    <div class="p-6 max-h-48 overflow-y-auto">
                        @forelse($categories as $category)
                        <label class="flex items-center gap-2 py-1">
                            <input type="checkbox" wire:model="selected_categories" value="{{ $category->id }}" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500">
                            <span class="text-sm text-slate-700 dark:text-slate-300">{{ $category->name }}</span>
                        </label>
                        @empty
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('blog.form.no_categories') }}</p>
                        @endforelse
                    </div>
                </div>

                <!-- Tags -->
                <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-200 dark:border-dark-border flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-slate-900 dark:text-white">{{ __('blog.public.tags') }}</h3>
                        <button type="button" wire:click="$toggle('showNewTagInput')" class="text-xs text-primary-600 hover:text-primary-700">
                            {{ $showNewTagInput ? __('common.actions.cancel') : '+ ' . __('blog.form.add_new') }}
                        </button>
                    </div>
                    @if($showNewTagInput)
                    <div class="p-4 bg-slate-50 dark:bg-dark-soft border-b border-slate-200 dark:border-dark-border">
                        <div class="flex gap-2">
                            <input type="text" wire:model="newTagName" wire:keydown.enter="createTag" placeholder="{{ __('blog.tags.form.name_placeholder') }}" class="flex-1 rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white text-sm focus:border-primary-500 focus:ring-primary-500">
                            <button type="button" wire:click="createTag" class="px-3 py-2 bg-primary-600 text-white text-xs font-medium rounded-lg hover:bg-primary-700">
                                {{ __('common.actions.add') }}
                            </button>
                        </div>
                        @error('newTagName') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    @endif
                    <div class="p-6 max-h-48 overflow-y-auto">
                        @forelse($tags as $tag)
                        <label class="flex items-center gap-2 py-1">
                            <input type="checkbox" wire:model="selected_tags" value="{{ $tag->id }}" class="rounded border-slate-300 dark:border-dark-border text-primary-600 focus:ring-primary-500">
                            <span class="text-sm text-slate-700 dark:text-slate-300">{{ $tag->name }}</span>
                        </label>
                        @empty
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('blog.form.no_tags') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

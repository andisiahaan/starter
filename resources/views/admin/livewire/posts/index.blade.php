<div>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-slate-900 dark:text-white">Blog Posts</h1>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Manage blog posts and articles.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <button wire:click="$dispatch('openModal', { component: 'admin.posts.modals.create-edit-post-modal' })" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Post
            </button>
        </div>
    </div>

    <div class="mt-4 flex flex-col sm:flex-row gap-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search posts..." class="block w-full sm:w-64 rounded-md border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm">
        <select wire:model.live="statusFilter" class="block w-full sm:w-48 rounded-md border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm">
            <option value="">All Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
        </select>
    </div>

    <div class="mt-6 overflow-hidden shadow ring-1 ring-slate-200 dark:ring-dark-border md:rounded-lg">
        <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
            <thead class="bg-slate-50 dark:bg-dark-soft">
                <tr>
                    <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 dark:text-white sm:pl-6">Post</th>
                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">Status</th>
                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">Author</th>
                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">Views</th>
                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">Created</th>
                    <th class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-dark-border bg-white dark:bg-dark-base">
                @forelse($posts as $post)
                <tr class="hover:bg-slate-50 dark:hover:bg-dark-elevated transition-colors">
                    <td class="py-4 pl-4 pr-3 sm:pl-6">
                        <div class="flex items-center gap-3">
                            @if($post->thumbnail)
                            <img src="{{ Storage::url($post->thumbnail) }}" alt="" class="w-12 h-12 rounded-lg object-cover">
                            @else
                            <div class="w-12 h-12 rounded-lg bg-slate-200 dark:bg-dark-muted flex items-center justify-center">
                                <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            @endif
                            <div>
                                <p class="font-medium text-slate-900 dark:text-white">{{ $post->title }}</p>
                                <p class="text-sm text-slate-500 dark:text-slate-400">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 50) }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                        <button wire:click="togglePublish({{ $post->id }})" class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $post->is_published ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300' }}">
                            {{ $post->is_published ? 'Published' : 'Draft' }}
                        </button>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-600 dark:text-slate-300">{{ $post->author?->name ?? 'Unknown' }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-600 dark:text-slate-300">{{ number_format($post->views) }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-600 dark:text-slate-300">{{ $post->created_at->format('M d, Y') }}</td>
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                        <button wire:click="$dispatch('openModal', { component: 'admin.posts.modals.create-edit-post-modal', arguments: { postId: {{ $post->id }} } })" class="text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300 mr-3">Edit</button>
                        <button wire:click="$dispatch('openModal', { component: 'admin.posts.modals.delete-post-modal', arguments: { postId: {{ $post->id }} } })" class="text-red-600 dark:text-red-400 hover:text-red-500 dark:hover:text-red-300">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-sm text-slate-500 dark:text-slate-400">No posts found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $posts->links() }}</div>
</div>

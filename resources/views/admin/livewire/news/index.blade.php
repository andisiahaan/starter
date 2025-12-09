<div>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-slate-900 dark:text-white">News & Announcements</h1>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Manage platform news, updates, and maintenance notices.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <button wire:click="$dispatch('openModal', { component: 'admin.news.modals.create-edit-news-modal' })" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add News
            </button>
        </div>
    </div>

    <div class="mt-4 flex flex-col sm:flex-row gap-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search..." class="block w-full sm:w-64 rounded-md border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm">
        <select wire:model.live="typeFilter" class="block w-full sm:w-48 rounded-md border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm">
            <option value="">All Types</option>
            @foreach($types as $key => $label)
            <option value="{{ $key }}">{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <div class="mt-6 overflow-hidden shadow ring-1 ring-slate-200 dark:ring-dark-border md:rounded-lg">
        <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
            <thead class="bg-slate-50 dark:bg-dark-soft">
                <tr>
                    <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 dark:text-white sm:pl-6">Title</th>
                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">Type</th>
                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">Status</th>
                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">Author</th>
                    <th class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-dark-border bg-white dark:bg-dark-base">
                @forelse($newsList as $news)
                <tr class="hover:bg-slate-50 dark:hover:bg-dark-elevated transition-colors">
                    <td class="py-4 pl-4 pr-3 sm:pl-6">
                        <div class="flex items-center gap-2">
                            @if($news->is_pinned)
                            <svg class="w-4 h-4 text-yellow-500 dark:text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                            </svg>
                            @endif
                            <span class="font-medium text-slate-900 dark:text-white">{{ $news->title }}</span>
                        </div>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                            @if($news->type === 'warning') bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400
                            @elseif($news->type === 'maintenance') bg-orange-100 dark:bg-orange-900/30 text-orange-700 dark:text-orange-400
                            @elseif($news->type === 'update') bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400
                            @else bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400
                            @endif">
                            {{ $types[$news->type] ?? $news->type }}
                        </span>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $news->is_published ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300' }}">
                            {{ $news->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-600 dark:text-slate-300">{{ $news->author?->name ?? 'Unknown' }}</td>
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                        <button wire:click="togglePin({{ $news->id }})" class="text-yellow-500 dark:text-yellow-400 hover:text-yellow-400 dark:hover:text-yellow-300 mr-3" title="{{ $news->is_pinned ? 'Unpin' : 'Pin' }}">
                            <svg class="w-4 h-4 inline" fill="{{ $news->is_pinned ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 20 20">
                                <path d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z" />
                            </svg>
                        </button>
                        <button wire:click="$dispatch('openModal', { component: 'admin.news.modals.create-edit-news-modal', arguments: { newsId: {{ $news->id }} } })" class="text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300 mr-3">Edit</button>
                        <button wire:click="$dispatch('openModal', { component: 'admin.news.modals.delete-news-modal', arguments: { newsId: {{ $news->id }} } })" class="text-red-600 dark:text-red-400 hover:text-red-500 dark:hover:text-red-300">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-500 dark:text-slate-400">No news found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $newsList->links() }}</div>
</div>
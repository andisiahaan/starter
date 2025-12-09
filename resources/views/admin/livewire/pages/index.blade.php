<div>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-slate-900 dark:text-white">Pages</h1>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Manage static pages like Terms, Privacy Policy, FAQ.</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <button wire:click="$dispatch('openModal', { component: 'admin.pages.modals.create-edit-page-modal' })" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 sm:w-auto">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Page
            </button>
        </div>
    </div>

    <div class="mt-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search pages..." class="block w-full sm:w-64 rounded-md border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm focus:border-primary-500 focus:ring-primary-500">
    </div>

    <div class="mt-6 overflow-hidden shadow ring-1 ring-slate-200 dark:ring-dark-border md:rounded-lg">
        <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
            <thead class="bg-slate-50 dark:bg-dark-soft">
                <tr>
                    <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 dark:text-white sm:pl-6">Title</th>
                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">Slug</th>
                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">Status</th>
                    <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">Layout</th>
                    <th class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only">Actions</span></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200 dark:divide-dark-border bg-white dark:bg-dark-base">
                @forelse($pages as $page)
                <tr class="hover:bg-slate-50 dark:hover:bg-dark-elevated transition-colors">
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-slate-900 dark:text-white sm:pl-6">{{ $page->title }}</td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500 dark:text-slate-400">
                        <a href="{{ url('/page/' . $page->slug) }}" target="_blank" class="text-primary-600 dark:text-primary-400 hover:underline">/page/{{ $page->slug }}</a>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm">
                        <button wire:click="togglePublish({{ $page->id }})" class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $page->is_published ? 'bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400' : 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300' }}">
                            {{ $page->is_published ? 'Published' : 'Draft' }}
                        </button>
                    </td>
                    <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-600 dark:text-slate-300">{{ ucfirst($page->layout) }}</td>
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                        <button wire:click="$dispatch('openModal', { component: 'admin.pages.modals.create-edit-page-modal', arguments: { pageId: {{ $page->id }} } })" class="text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300 mr-3">Edit</button>
                        <button wire:click="$dispatch('openModal', { component: 'admin.pages.modals.delete-page-modal', arguments: { pageId: {{ $page->id }} } })" class="text-red-600 dark:text-red-400 hover:text-red-500 dark:hover:text-red-300">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-sm text-slate-500 dark:text-slate-400">No pages found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $pages->links() }}</div>
</div>
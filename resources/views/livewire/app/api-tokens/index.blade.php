<div>
    <div class="max-w-4xl mx-auto">
        <div class="sm:flex sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">API Tokens</h1>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Manage your API access tokens for integrations</p>
            </div>
            <button wire:click="$dispatch('openModal', { component: 'app.api-tokens.modals.create-token-modal' })" class="mt-4 sm:mt-0 inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Create Token
            </button>
        </div>

        <div class="mt-6 bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden shadow-sm">
            @if($tokens->isEmpty())
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-slate-900 dark:text-white">No tokens</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Create an API token to integrate with external services.</p>
            </div>
            @else
            <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
                <thead class="bg-slate-50 dark:bg-dark-soft">
                    <tr>
                        <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 dark:text-white sm:pl-6">Name</th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">Abilities</th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">Last Used</th>
                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">Created</th>
                        <th class="relative py-3.5 pl-3 pr-4 sm:pr-6"><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-dark-border">
                    @foreach($tokens as $token)
                    <tr class="hover:bg-slate-50 dark:hover:bg-dark-soft transition-colors">
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-slate-900 dark:text-white sm:pl-6">{{ $token->name }}</td>
                        <td class="px-3 py-4 text-sm">
                            <div class="flex flex-wrap gap-1">
                                @foreach($token->abilities as $ability)
                                <span class="inline-flex items-center rounded px-1.5 py-0.5 text-xs font-medium bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400">{{ $ability }}</span>
                                @endforeach
                            </div>
                        </td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $token->last_used_at?->diffForHumans() ?? 'Never' }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-500 dark:text-slate-400">{{ $token->created_at->format('M d, Y') }}</td>
                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                            <button wire:click="$dispatch('openModal', { component: 'app.api-tokens.modals.revoke-token-modal', arguments: { tokenId: {{ $token->id }} } })" class="text-red-600 dark:text-red-400 hover:text-red-700 dark:hover:text-red-300 transition">
                                Revoke
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>

        {{-- API Documentation Link --}}
        <div class="mt-6 p-4 bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border shadow-sm">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-sm font-medium text-slate-900 dark:text-white mb-2">API Documentation</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400">Include your token in API requests using the <code class="text-primary-600 dark:text-primary-400 bg-primary-50 dark:bg-primary-900/20 px-1 py-0.5 rounded">Authorization</code> header:</p>
                    <code class="block mt-2 p-3 bg-slate-50 dark:bg-dark-soft rounded text-sm text-slate-700 dark:text-slate-300 font-mono">Authorization: Bearer YOUR_TOKEN</code>
                </div>
                <a href="{{ route('docs.api') }}" class="flex-shrink-0 inline-flex items-center text-sm text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 transition">
                    View Docs
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
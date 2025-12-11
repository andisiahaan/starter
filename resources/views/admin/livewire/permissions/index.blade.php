<div>
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-xl font-semibold text-slate-900 dark:text-white">{{ __('permissions.title') }}</h1>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">{{ __('permissions.description') }}</p>
        </div>
        <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            <button wire:click="$dispatch('openModal', { component: 'admin.permissions.modals.create-edit-permission-modal' })" type="button" class="inline-flex items-center justify-center rounded-md border border-transparent bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 sm:w-auto">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                {{ __('permissions.add') }}
            </button>
        </div>
    </div>

    <!-- Search -->
    <div class="mt-4">
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="{{ __('permissions.search') }}"
            class="block w-full sm:w-64 rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm">
    </div>

    <!-- Table -->
    <div class="mt-6 flex flex-col">
        <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                <div class="overflow-hidden shadow ring-1 ring-slate-200 dark:ring-dark-border md:rounded-lg">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
                        <thead class="bg-slate-50 dark:bg-dark-soft">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-slate-900 dark:text-white sm:pl-6">{{ __('permissions.table.permission') }}</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">{{ __('permissions.table.guard') }}</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-slate-900 dark:text-white">{{ __('permissions.table.assigned_to') }}</th>
                                <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                    <span class="sr-only">{{ __('common.table.actions') }}</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-dark-border bg-white dark:bg-dark-base">
                            @forelse($permissions as $permission)
                            <tr class="hover:bg-slate-50 dark:hover:bg-dark-elevated transition-colors">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 sm:pl-6">
                                    <div class="flex items-center gap-3">
                                        <div class="h-8 w-8 flex-shrink-0 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                                            </svg>
                                        </div>
                                        <span class="font-medium text-slate-900 dark:text-white">{{ $permission->name }}</span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-slate-600 dark:text-slate-300">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">
                                        {{ $permission->guard_name }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm">
                                    <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400">
                                        {{ __('permissions.roles_count', ['count' => $permission->roles_count]) }}
                                    </span>
                                </td>
                                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                    <button wire:click="$dispatch('openModal', { component: 'admin.permissions.modals.create-edit-permission-modal', arguments: { permissionId: {{ $permission->id }} } })" class="text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300 mr-3">{{ __('common.actions.edit') }}</button>
                                    <button wire:click="$dispatch('openModal', { component: 'admin.permissions.modals.delete-permission-modal', arguments: { permissionId: {{ $permission->id }} } })" class="text-red-600 dark:text-red-400 hover:text-red-500 dark:hover:text-red-300">{{ __('common.actions.delete') }}</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-sm text-slate-500 dark:text-slate-400">
                                    {{ __('permissions.empty') }}
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $permissions->links() }}
    </div>
</div>
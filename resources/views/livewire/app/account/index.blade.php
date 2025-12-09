<div class="space-y-6" x-data="{ activeTab: @entangle('activeTab').live }">
    {{-- Page Header --}}
    <div>
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('Account Settings') }}</h1>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Manage your profile, security, and preferences.') }}</p>
    </div>

    {{-- Tab Navigation --}}
    <div class="border-b border-slate-200 dark:border-dark-border">
        <nav class="flex gap-4 -mb-px overflow-x-auto no-scrollbar" aria-label="Tabs">
            <button
                wire:click="setTab('profile')"
                :class="activeTab === 'profile' ? 'border-primary-500 text-primary-600 dark:text-primary-400' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-white'"
                class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm transition-colors">
                {{ __('Profile') }}
            </button>
            <button
                wire:click="setTab('security')"
                :class="activeTab === 'security' ? 'border-primary-500 text-primary-600 dark:text-primary-400' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-white'"
                class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm transition-colors">
                {{ __('Security') }}
            </button>
            <button
                wire:click="setTab('2fa')"
                :class="activeTab === '2fa' ? 'border-primary-500 text-primary-600 dark:text-primary-400' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-white'"
                class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm transition-colors">
                {{ __('Two-Factor Auth') }}
            </button>
            <button
                wire:click="setTab('notifications')"
                :class="activeTab === 'notifications' ? 'border-primary-500 text-primary-600 dark:text-primary-400' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-white'"
                class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm transition-colors">
                {{ __('Notifications') }}
            </button>
            <button
                wire:click="setTab('sessions')"
                :class="activeTab === 'sessions' ? 'border-primary-500 text-primary-600 dark:text-primary-400' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300 dark:text-slate-400 dark:hover:text-white'"
                class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm transition-colors">
                {{ __('Sessions') }}
            </button>
        </nav>
    </div>

    {{-- Tab Content --}}
    <div class="bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border shadow-sm overflow-hidden">
        <div x-show="activeTab === 'profile'" x-cloak>
            @livewire('app.account.profile')
        </div>
        <div x-show="activeTab === 'security'" x-cloak>
            @livewire('app.account.security')
        </div>
        <div x-show="activeTab === '2fa'" x-cloak>
            @livewire('app.account.two-factor-auth')
        </div>
        <div x-show="activeTab === 'notifications'" x-cloak>
            @livewire('app.account.notifications')
        </div>
        <div x-show="activeTab === 'sessions'" x-cloak>
            @livewire('app.account.sessions')
        </div>
    </div>
</div>
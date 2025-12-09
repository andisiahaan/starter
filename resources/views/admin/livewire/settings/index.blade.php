<div>
    <div class="lg:grid lg:grid-cols-12 lg:gap-x-6">
        <!-- Sidebar Navigation -->
        <aside class="lg:col-span-3">
            <!-- Mobile Dropdown -->
            <div class="lg:hidden mb-6">
                <label for="section-select" class="sr-only">Select a section</label>
                <select id="section-select" wire:model.live="section" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500">
                    <option value="general">General</option>
                    <option value="auth">Authentication</option>
                    <option value="socials">Social Links</option>
                    <option value="custom-tags">Custom Tags</option>
                    <option value="notifications">Notifications</option>
                    <option value="referral">Referral Program</option>
                </select>
            </div>

            <!-- Desktop Sidebar -->
            <nav class="hidden lg:block space-y-1">
                <button wire:click="setSection('general')" class="{{ $section === 'general' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 border-primary-500' : 'text-slate-600 dark:text-slate-300 border-transparent hover:bg-slate-100 dark:hover:bg-dark-soft hover:text-slate-900 dark:hover:text-white' }} group rounded-lg px-3 py-2.5 flex items-center text-sm font-medium w-full text-left border-l-2 transition-all">
                    <svg class="w-5 h-5 mr-3 {{ $section === 'general' ? 'text-primary-600 dark:text-primary-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-500 dark:group-hover:text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    General
                </button>

                <button wire:click="setSection('auth')" class="{{ $section === 'auth' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 border-primary-500' : 'text-slate-600 dark:text-slate-300 border-transparent hover:bg-slate-100 dark:hover:bg-dark-soft hover:text-slate-900 dark:hover:text-white' }} group rounded-lg px-3 py-2.5 flex items-center text-sm font-medium w-full text-left border-l-2 transition-all">
                    <svg class="w-5 h-5 mr-3 {{ $section === 'auth' ? 'text-primary-600 dark:text-primary-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-500 dark:group-hover:text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    Authentication
                </button>

                <button wire:click="setSection('socials')" class="{{ $section === 'socials' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 border-primary-500' : 'text-slate-600 dark:text-slate-300 border-transparent hover:bg-slate-100 dark:hover:bg-dark-soft hover:text-slate-900 dark:hover:text-white' }} group rounded-lg px-3 py-2.5 flex items-center text-sm font-medium w-full text-left border-l-2 transition-all">
                    <svg class="w-5 h-5 mr-3 {{ $section === 'socials' ? 'text-primary-600 dark:text-primary-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-500 dark:group-hover:text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Social Links
                </button>

                <button wire:click="setSection('custom-tags')" class="{{ $section === 'custom-tags' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 border-primary-500' : 'text-slate-600 dark:text-slate-300 border-transparent hover:bg-slate-100 dark:hover:bg-dark-soft hover:text-slate-900 dark:hover:text-white' }} group rounded-lg px-3 py-2.5 flex items-center text-sm font-medium w-full text-left border-l-2 transition-all">
                    <svg class="w-5 h-5 mr-3 {{ $section === 'custom-tags' ? 'text-primary-600 dark:text-primary-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-500 dark:group-hover:text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                    Custom Tags
                </button>

                <button wire:click="setSection('notifications')" class="{{ $section === 'notifications' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 border-primary-500' : 'text-slate-600 dark:text-slate-300 border-transparent hover:bg-slate-100 dark:hover:bg-dark-soft hover:text-slate-900 dark:hover:text-white' }} group rounded-lg px-3 py-2.5 flex items-center text-sm font-medium w-full text-left border-l-2 transition-all">
                    <svg class="w-5 h-5 mr-3 {{ $section === 'notifications' ? 'text-primary-600 dark:text-primary-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-500 dark:group-hover:text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    Notifications
                </button>

                <button wire:click="setSection('referral')" class="{{ $section === 'referral' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 border-primary-500' : 'text-slate-600 dark:text-slate-300 border-transparent hover:bg-slate-100 dark:hover:bg-dark-soft hover:text-slate-900 dark:hover:text-white' }} group rounded-lg px-3 py-2.5 flex items-center text-sm font-medium w-full text-left border-l-2 transition-all">
                    <svg class="w-5 h-5 mr-3 {{ $section === 'referral' ? 'text-primary-600 dark:text-primary-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-500 dark:group-hover:text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Referral Program
                </button>
            </nav>
        </aside>

        <!-- Content Area -->
        <div class="lg:col-span-9">
            @if($section === 'general')
            @livewire('admin.settings.general', key('general'))
            @elseif($section === 'auth')
            @livewire('admin.settings.auth', key('auth'))
            @elseif($section === 'socials')
            @livewire('admin.settings.socials', key('socials'))
            @elseif($section === 'custom-tags')
            @livewire('admin.settings.custom-tags', key('custom-tags'))
            @elseif($section === 'notifications')
            @livewire('admin.settings.notifications', key('notifications'))
            @elseif($section === 'referral')
            @livewire('admin.settings.referral', key('referral'))
            @endif
        </div>
    </div>
</div>
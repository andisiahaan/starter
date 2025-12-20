<div>
    <div class="lg:grid lg:grid-cols-12 lg:gap-x-6">
        <!-- Sidebar Navigation -->
        <aside class="lg:col-span-3">
            <!-- Mobile Dropdown -->
            <div class="lg:hidden mb-6">
                <label for="section-select" class="sr-only">{{ __('admin.settings.sr.select_section') }}</label>
                <select id="section-select" wire:model.live="section" class="block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-elevated text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500">
                    <option value="general">{{ __('admin.settings.nav.general') }}</option>
                    <option value="business">{{ __('admin.settings.nav.business') }}</option>
                    <option value="auth">{{ __('admin.settings.nav.auth') }}</option>
                    <option value="captcha">{{ __('admin.settings.nav.captcha') }}</option>
                    <option value="cookie-consent">{{ __('admin.settings.nav.cookie_consent') }}</option>
                    <option value="socials">{{ __('admin.settings.nav.socials') }}</option>
                    <option value="custom-tags">{{ __('admin.settings.nav.custom_tags') }}</option>
                    <option value="notifications">{{ __('admin.settings.nav.notifications') }}</option>
                    <option value="referral">{{ __('admin.settings.nav.referral') }}</option>
                    <option value="free-credit">{{ __('admin.settings.nav.free_credit') }}</option>
                </select>
            </div>

            <!-- Desktop Sidebar -->
            <nav class="hidden lg:block space-y-1">
                <button wire:click="setSection('general')" class="{{ $section === 'general' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 border-primary-500' : 'text-slate-600 dark:text-slate-300 border-transparent hover:bg-slate-100 dark:hover:bg-dark-soft hover:text-slate-900 dark:hover:text-white' }} group rounded-lg px-3 py-2.5 flex items-center text-sm font-medium w-full text-left border-l-2 transition-all">
                    <svg class="w-5 h-5 mr-3 {{ $section === 'general' ? 'text-primary-600 dark:text-primary-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-500 dark:group-hover:text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    {{ __('admin.settings.nav.general') }}
                </button>

                <button wire:click="setSection('business')" class="{{ $section === 'business' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 border-primary-500' : 'text-slate-600 dark:text-slate-300 border-transparent hover:bg-slate-100 dark:hover:bg-dark-soft hover:text-slate-900 dark:hover:text-white' }} group rounded-lg px-3 py-2.5 flex items-center text-sm font-medium w-full text-left border-l-2 transition-all">
                    <svg class="w-5 h-5 mr-3 {{ $section === 'business' ? 'text-primary-600 dark:text-primary-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-500 dark:group-hover:text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    {{ __('admin.settings.nav.business') }}
                </button>

                <button wire:click="setSection('auth')" class="{{ $section === 'auth' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 border-primary-500' : 'text-slate-600 dark:text-slate-300 border-transparent hover:bg-slate-100 dark:hover:bg-dark-soft hover:text-slate-900 dark:hover:text-white' }} group rounded-lg px-3 py-2.5 flex items-center text-sm font-medium w-full text-left border-l-2 transition-all">
                    <svg class="w-5 h-5 mr-3 {{ $section === 'auth' ? 'text-primary-600 dark:text-primary-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-500 dark:group-hover:text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                    {{ __('admin.settings.nav.auth') }}
                </button>

                <button wire:click="setSection('captcha')" class="{{ $section === 'captcha' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 border-primary-500' : 'text-slate-600 dark:text-slate-300 border-transparent hover:bg-slate-100 dark:hover:bg-dark-soft hover:text-slate-900 dark:hover:text-white' }} group rounded-lg px-3 py-2.5 flex items-center text-sm font-medium w-full text-left border-l-2 transition-all">
                    <svg class="w-5 h-5 mr-3 {{ $section === 'captcha' ? 'text-primary-600 dark:text-primary-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-500 dark:group-hover:text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                    {{ __('admin.settings.nav.captcha') }}
                </button>

                <button wire:click="setSection('cookie-consent')" class="{{ $section === 'cookie-consent' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 border-primary-500' : 'text-slate-600 dark:text-slate-300 border-transparent hover:bg-slate-100 dark:hover:bg-dark-soft hover:text-slate-900 dark:hover:text-white' }} group rounded-lg px-3 py-2.5 flex items-center text-sm font-medium w-full text-left border-l-2 transition-all">
                    <svg class="w-5 h-5 mr-3 {{ $section === 'cookie-consent' ? 'text-primary-600 dark:text-primary-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-500 dark:group-hover:text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('admin.settings.nav.cookie_consent') }}
                </button>

                <button wire:click="setSection('socials')" class="{{ $section === 'socials' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 border-primary-500' : 'text-slate-600 dark:text-slate-300 border-transparent hover:bg-slate-100 dark:hover:bg-dark-soft hover:text-slate-900 dark:hover:text-white' }} group rounded-lg px-3 py-2.5 flex items-center text-sm font-medium w-full text-left border-l-2 transition-all">
                    <svg class="w-5 h-5 mr-3 {{ $section === 'socials' ? 'text-primary-600 dark:text-primary-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-500 dark:group-hover:text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    {{ __('admin.settings.nav.socials') }}
                </button>

                <button wire:click="setSection('custom-tags')" class="{{ $section === 'custom-tags' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 border-primary-500' : 'text-slate-600 dark:text-slate-300 border-transparent hover:bg-slate-100 dark:hover:bg-dark-soft hover:text-slate-900 dark:hover:text-white' }} group rounded-lg px-3 py-2.5 flex items-center text-sm font-medium w-full text-left border-l-2 transition-all">
                    <svg class="w-5 h-5 mr-3 {{ $section === 'custom-tags' ? 'text-primary-600 dark:text-primary-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-500 dark:group-hover:text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                    </svg>
                    {{ __('admin.settings.nav.custom_tags') }}
                </button>

                <button wire:click="setSection('notifications')" class="{{ $section === 'notifications' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 border-primary-500' : 'text-slate-600 dark:text-slate-300 border-transparent hover:bg-slate-100 dark:hover:bg-dark-soft hover:text-slate-900 dark:hover:text-white' }} group rounded-lg px-3 py-2.5 flex items-center text-sm font-medium w-full text-left border-l-2 transition-all">
                    <svg class="w-5 h-5 mr-3 {{ $section === 'notifications' ? 'text-primary-600 dark:text-primary-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-500 dark:group-hover:text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                    </svg>
                    {{ __('admin.settings.nav.notifications') }}
                </button>

                <button wire:click="setSection('referral')" class="{{ $section === 'referral' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 border-primary-500' : 'text-slate-600 dark:text-slate-300 border-transparent hover:bg-slate-100 dark:hover:bg-dark-soft hover:text-slate-900 dark:hover:text-white' }} group rounded-lg px-3 py-2.5 flex items-center text-sm font-medium w-full text-left border-l-2 transition-all">
                    <svg class="w-5 h-5 mr-3 {{ $section === 'referral' ? 'text-primary-600 dark:text-primary-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-500 dark:group-hover:text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ __('admin.settings.nav.referral') }}
                </button>

                <button wire:click="setSection('free-credit')" class="{{ $section === 'free-credit' ? 'bg-primary-100 dark:bg-primary-900/30 text-primary-700 dark:text-primary-400 border-primary-500' : 'text-slate-600 dark:text-slate-300 border-transparent hover:bg-slate-100 dark:hover:bg-dark-soft hover:text-slate-900 dark:hover:text-white' }} group rounded-lg px-3 py-2.5 flex items-center text-sm font-medium w-full text-left border-l-2 transition-all">
                    <svg class="w-5 h-5 mr-3 {{ $section === 'free-credit' ? 'text-primary-600 dark:text-primary-400' : 'text-slate-400 dark:text-slate-500 group-hover:text-slate-500 dark:group-hover:text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                    </svg>
                    {{ __('admin.settings.nav.free_credit') }}
                </button>
            </nav>
        </aside>

        <!-- Content Area -->
        <div class="lg:col-span-9">
            @if($section === 'general')
            @livewire('admin.settings.general', key('general'))
            @elseif($section === 'business')
            @livewire('admin.settings.business', key('business'))
            @elseif($section === 'auth')
            @livewire('admin.settings.auth', key('auth'))
            @elseif($section === 'captcha')
            @livewire('admin.settings.captcha', key('captcha'))
            @elseif($section === 'cookie-consent')
            @livewire('admin.settings.cookie-consent', key('cookie-consent'))
            @elseif($section === 'socials')
            @livewire('admin.settings.socials', key('socials'))
            @elseif($section === 'custom-tags')
            @livewire('admin.settings.custom-tags', key('custom-tags'))
            @elseif($section === 'notifications')
            @livewire('admin.settings.notifications', key('notifications'))
            @elseif($section === 'referral')
            @livewire('admin.settings.referral', key('referral'))
            @elseif($section === 'free-credit')
            @livewire('admin.settings.free-credit', key('free-credit'))
            @endif
        </div>
    </div>
</div>
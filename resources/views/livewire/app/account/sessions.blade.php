<div class="p-6">
    <div>
        <h3 class="text-lg font-medium text-slate-900 dark:text-white">{{ __('Browser Sessions') }}</h3>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Manage and log out your active sessions on other browsers and devices.') }}</p>

        @if(session('success'))
        <div class="mt-4 p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-lg">
            <p class="text-sm text-emerald-800 dark:text-emerald-200">{{ session('success') }}</p>
        </div>
        @endif

        @if(session('error'))
        <div class="mt-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
            <p class="text-sm text-red-800 dark:text-red-200">{{ session('error') }}</p>
        </div>
        @endif

        <div class="mt-6 space-y-4">
            @php $sessionList = $sessions ?? collect(); @endphp
            @if($sessionList->count() > 0)
                @foreach($sessionList as $session)
                <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-dark-soft rounded-lg border border-slate-200 dark:border-dark-border">
                    <div class="flex items-center gap-4">
                        {{-- Device Icon --}}
                        <div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-dark-muted flex items-center justify-center">
                            @if(($session->device ?? 'desktop') === 'mobile')
                            <svg class="w-5 h-5 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            @elseif(($session->device ?? 'desktop') === 'tablet')
                            <svg class="w-5 h-5 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                            @else
                            <svg class="w-5 h-5 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            @endif
                        </div>

                        <div>
                            <p class="font-medium text-slate-900 dark:text-white">
                                {{ $session->browser ?? 'Unknown' }} on {{ $session->platform ?? 'Unknown' }}
                                @if($session->is_current ?? false)
                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-primary-100 text-primary-800 dark:bg-primary-900/30 dark:text-primary-300">
                                    {{ __('This device') }}
                                </span>
                                @endif
                            </p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                {{ $session->ip_address ?? 'Unknown' }} · {{ isset($session->last_activity) ? $session->last_activity->diffForHumans() : 'Unknown' }}
                            </p>
                        </div>
                    </div>

                    @unless($session->is_current ?? false)
                    <button
                        wire:click="logoutSession('{{ $session->id ?? '' }}')"
                        wire:confirm="{{ __('Are you sure you want to log out this session?') }}"
                        class="text-sm text-red-600 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 font-medium">
                        {{ __('Log out') }}
                    </button>
                    @endunless
                </div>
                @endforeach
            @else
            <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('No active sessions found.') }}</p>
            @endif
        </div>

        @if(isset($sessions) && $sessions->count() > 1)
        <div class="mt-6">
            <button
                wire:click="logoutAllOtherSessions"
                wire:confirm="{{ __('Are you sure you want to log out all other sessions?') }}"
                class="btn btn-outline text-red-600 border-red-300 hover:bg-red-50 dark:text-red-400 dark:border-red-800 dark:hover:bg-red-900/20">
                {{ __('Log Out All Other Sessions') }}
            </button>
        </div>
        @endif
    </div>
</div>
<div class="p-6">
    <div class="max-w-xl">
        <h3 class="text-lg font-medium text-slate-900 dark:text-white">{{ __('Two-Factor Authentication') }}</h3>
        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('Add additional security to your account using two-factor authentication.') }}</p>

        <div class="mt-6">
            @if($enabled)
            {{-- 2FA Enabled State --}}
            <div class="p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-lg">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/50 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-emerald-800 dark:text-emerald-200">{{ __('Two-factor authentication is enabled.') }}</p>
                        <p class="text-sm text-emerald-600 dark:text-emerald-400">{{ __('You have :count recovery codes remaining.', ['count' => $recoveryCodesCount]) }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-4 flex flex-wrap gap-3">
                <button wire:click="$dispatch('openModal', { component: 'app.account.modals.show-recovery-codes-modal' })" class="btn btn-outline">
                    {{ __('View Recovery Codes') }}
                </button>
                <button wire:click="regenerateRecoveryCodes" class="btn btn-ghost">
                    {{ __('Regenerate Codes') }}
                </button>
                <button wire:click="$dispatch('openModal', { component: 'app.account.modals.disable-two-factor-modal' })" class="btn btn-ghost text-red-600 hover:text-red-700 dark:text-red-400">
                    {{ __('Disable 2FA') }}
                </button>
            </div>
            @else
            {{-- 2FA Disabled State --}}
            <div class="p-4 bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-slate-200 dark:bg-dark-muted flex items-center justify-center">
                        <svg class="w-5 h-5 text-slate-500 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <div>
                        <p class="font-medium text-slate-900 dark:text-white">{{ __('Two-factor authentication is not enabled.') }}</p>
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('Enable 2FA to add an extra layer of security.') }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button wire:click="$dispatch('openModal', { component: 'app.account.modals.enable-two-factor-modal' })" class="btn btn-primary">
                    {{ __('Enable Two-Factor Authentication') }}
                </button>
            </div>
            @endif
        </div>

        {{-- Info Box --}}
        <div class="mt-6 p-4 bg-sky-50 dark:bg-sky-900/20 border border-sky-200 dark:border-sky-800 rounded-lg">
            <div class="flex gap-3">
                <svg class="w-5 h-5 text-sky-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="text-sm text-sky-800 dark:text-sky-200">
                    <p class="font-medium">{{ __('How does 2FA work?') }}</p>
                    <p class="mt-1 text-sky-600 dark:text-sky-400">{{ __('When enabled, you\'ll be prompted to enter a code from your authenticator app (like Google Authenticator) each time you log in. This ensures that even if someone has your password, they cannot access your account without your phone.') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
<x-layouts.plain title="Two-Factor Authentication">
    <div class="p-6 sm:p-8" x-data="{ useRecoveryCode: false }">
        <div class="text-center mb-6">
            <div class="w-14 h-14 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center mx-auto mb-4">
                <svg class="w-7 h-7 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <h1 class="text-xl font-bold text-slate-900 dark:text-white">
                {{ __('Two-Factor Authentication') }}
            </h1>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                <span x-show="!useRecoveryCode">{{ __('Enter the 6-digit code from your authenticator app.') }}</span>
                <span x-show="useRecoveryCode" x-cloak>{{ __('Enter one of your emergency recovery codes.') }}</span>
            </p>
        </div>

        <form method="POST" action="{{ route('two-factor.verify') }}" class="space-y-4">
            @csrf
            <input type="hidden" name="use_recovery_code" :value="useRecoveryCode ? '1' : '0'">

            <div>
                <label for="code" class="sr-only">{{ __('Code') }}</label>
                <input
                    type="text"
                    id="code"
                    name="code"
                    :maxlength="useRecoveryCode ? 14 : 6"
                    :placeholder="useRecoveryCode ? 'XXXX-XXXX-XXXX' : '000000'"
                    class="block w-full px-4 py-3 border border-slate-300 dark:border-dark-border rounded-lg bg-white dark:bg-dark-muted text-slate-900 dark:text-white text-center text-xl tracking-widest font-mono focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    autofocus
                    autocomplete="one-time-code">
                @error('code')
                <p class="mt-2 text-sm text-red-600 dark:text-red-400 text-center">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full btn btn-primary py-3">
                {{ __('Verify') }}
            </button>
        </form>

        <div class="mt-6 text-center">
            <button
                @click="useRecoveryCode = !useRecoveryCode"
                type="button"
                class="text-sm text-primary-600 hover:text-primary-700 dark:text-primary-400 dark:hover:text-primary-300">
                <span x-show="!useRecoveryCode">{{ __('Use a recovery code instead') }}</span>
                <span x-show="useRecoveryCode" x-cloak>{{ __('Use authenticator code instead') }}</span>
            </button>
        </div>

        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-sm text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200">
                {{ __('Cancel and go back to login') }}
            </a>
        </div>
    </div>
</x-layouts.plain>
<div>
    <form wire:submit="save">
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 dark:border-dark-border">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ __('settings.referral.title') }}</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ __('settings.referral.description') }}</p>
            </div>

            <div class="p-6 space-y-6">
                <!-- Enable Referral -->
                <div class="flex items-center justify-between">
                    <div>
                        <label class="text-sm font-medium text-slate-900 dark:text-white">{{ __('settings.referral.enabled.label') }}</label>
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('settings.referral.enabled.description') }}</p>
                    </div>
                    <button type="button" wire:click="$toggle('state.is_enabled')"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 {{ $state['is_enabled'] ? 'bg-primary-600' : 'bg-slate-200 dark:bg-slate-600' }}">
                        <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $state['is_enabled'] ? 'translate-x-5' : 'translate-x-0' }}"></span>
                    </button>
                </div>

                <hr class="border-slate-200 dark:border-dark-border">

                <!-- Cookie Days -->
                <div>
                    <label for="referral_cookie_days" class="block text-sm font-medium text-slate-900 dark:text-white mb-1">
                        {{ __('settings.referral.cookie_days.label') }}
                    </label>
                    <input type="number" wire:model="state.referral_cookie_days" id="referral_cookie_days" min="1" max="365"
                           class="w-full max-w-xs bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('settings.referral.cookie_days.description') }}</p>
                    @error('state.referral_cookie_days') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                <!-- Expiry Days -->
                <div>
                    <label for="referral_expiry_days" class="block text-sm font-medium text-slate-900 dark:text-white mb-1">
                        {{ __('settings.referral.expiry_days.label') }}
                    </label>
                    <input type="number" wire:model="state.referral_expiry_days" id="referral_expiry_days" min="0" max="365"
                           class="w-full max-w-xs bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('settings.referral.expiry_days.description') }}</p>
                    @error('state.referral_expiry_days') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                <hr class="border-slate-200 dark:border-dark-border">

                <h4 class="text-sm font-medium text-slate-900 dark:text-white">{{ __('settings.referral.commission.title') }}</h4>

                <!-- Fixed Commission -->
                <div>
                    <label for="commission_fixed" class="block text-sm font-medium text-slate-900 dark:text-white mb-1">
                        {{ __('settings.referral.commission.fixed_label') }}
                    </label>
                    <input type="number" wire:model="state.commission_fixed" id="commission_fixed" min="0" step="100"
                           class="w-full max-w-xs bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('settings.referral.commission.fixed_description') }}</p>
                    @error('state.commission_fixed') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                <!-- Percent Commission -->
                <div>
                    <label for="commission_percent" class="block text-sm font-medium text-slate-900 dark:text-white mb-1">
                        {{ __('settings.referral.commission.percent_label') }}
                    </label>
                    <input type="number" wire:model="state.commission_percent" id="commission_percent" min="0" max="100" step="0.1"
                           class="w-full max-w-xs bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('settings.referral.commission.percent_description') }}</p>
                    @error('state.commission_percent') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                <hr class="border-slate-200 dark:border-dark-border">

                <!-- Min Withdrawal -->
                <div>
                    <label for="min_withdrawal" class="block text-sm font-medium text-slate-900 dark:text-white mb-1">
                        {{ __('settings.referral.min_withdrawal.label') }}
                    </label>
                    <input type="number" wire:model="state.min_withdrawal" id="min_withdrawal" min="0" step="1000"
                           class="w-full max-w-xs bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('settings.referral.min_withdrawal.description') }}</p>
                    @error('state.min_withdrawal') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                <!-- Max Withdrawal -->
                <div>
                    <label for="max_withdrawal" class="block text-sm font-medium text-slate-900 dark:text-white mb-1">
                        {{ __('settings.referral.max_withdrawal.label') }}
                    </label>
                    <input type="number" wire:model="state.max_withdrawal" id="max_withdrawal" min="0" step="1000"
                           class="w-full max-w-xs bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('settings.referral.max_withdrawal.description') }}</p>
                    @error('state.max_withdrawal') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                <hr class="border-slate-200 dark:border-dark-border">

                <h4 class="text-sm font-medium text-slate-900 dark:text-white">{{ __('settings.referral.withdrawal.title') }}</h4>

                <!-- Enable Withdrawal -->
                <div class="flex items-center justify-between">
                    <div>
                        <label class="text-sm font-medium text-slate-900 dark:text-white">{{ __('settings.referral.withdrawal.enabled.label') }}</label>
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('settings.referral.withdrawal.enabled.description') }}</p>
                    </div>
                    <button type="button" wire:click="$toggle('state.is_withdraw_enabled')"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 {{ $state['is_withdraw_enabled'] ? 'bg-primary-600' : 'bg-slate-200 dark:bg-slate-600' }}">
                        <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $state['is_withdraw_enabled'] ? 'translate-x-5' : 'translate-x-0' }}"></span>
                    </button>
                </div>

                <!-- Require Email OTP -->
                <div class="flex items-center justify-between">
                    <div>
                        <label class="text-sm font-medium text-slate-900 dark:text-white">{{ __('settings.referral.withdrawal.require_otp.label') }}</label>
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('settings.referral.withdrawal.require_otp.description') }}</p>
                    </div>
                    <button type="button" wire:click="$toggle('state.is_withdraw_require_otp')"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 {{ $state['is_withdraw_require_otp'] ? 'bg-primary-600' : 'bg-slate-200 dark:bg-slate-600' }}">
                        <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $state['is_withdraw_require_otp'] ? 'translate-x-5' : 'translate-x-0' }}"></span>
                    </button>
                </div>

                <!-- Require Password Confirmation -->
                <div class="flex items-center justify-between">
                    <div>
                        <label class="text-sm font-medium text-slate-900 dark:text-white">{{ __('settings.referral.withdrawal.require_password.label') }}</label>
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('settings.referral.withdrawal.require_password.description') }}</p>
                    </div>
                    <button type="button" wire:click="$toggle('state.is_withdraw_require_password')"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 {{ $state['is_withdraw_require_password'] ? 'bg-primary-600' : 'bg-slate-200 dark:bg-slate-600' }}">
                        <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $state['is_withdraw_require_password'] ? 'translate-x-5' : 'translate-x-0' }}"></span>
                    </button>
                </div>

                <!-- Example Calculation -->
                <div class="bg-slate-50 dark:bg-dark-soft rounded-lg p-4 border border-slate-200 dark:border-dark-border">
                    <h5 class="text-sm font-medium text-slate-900 dark:text-white mb-2">{{ __('settings.referral.example.title') }}</h5>
                    <p class="text-sm text-slate-600 dark:text-slate-400">
                        For an order of <strong>Rp 100,000</strong>:<br>
                        Fixed: Rp {{ number_format($state['commission_fixed'], 0, ',', '.') }}<br>
                        Percent: {{ $state['commission_percent'] }}% × Rp 100,000 = Rp {{ number_format(($state['commission_percent'] / 100) * 100000, 0, ',', '.') }}<br>
                        <strong>Total Commission: Rp {{ number_format($state['commission_fixed'] + (($state['commission_percent'] / 100) * 100000), 0, ',', '.') }}</strong>
                    </p>
                </div>
            </div>

            <div class="px-6 py-4 bg-slate-50 dark:bg-dark-soft border-t border-slate-200 dark:border-dark-border flex justify-end">
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                    {{ __('common.actions.save_changes') }}
                </button>
            </div>
        </div>
    </form>
</div>

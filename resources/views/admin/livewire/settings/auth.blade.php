<div>
    <form wire:submit="save">
        <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 dark:border-dark-border">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Authentication Settings</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Configure login, registration, and security options.</p>
            </div>

            <div class="p-6 space-y-6">
                <!-- Toggle Options -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach([
                    'is_login_enabled' => 'Login Enabled',
                    'is_registration_enabled' => 'Registration Enabled',
                    'is_login_with_google_enabled' => 'Login with Google',
                    'is_registration_with_google_enabled' => 'Register with Google',
                    'is_email_verification_required' => 'Email Verification Required',
                    'is_phone_required' => 'Phone Required',
                    'is_login_with_username_enabled' => 'Login with Username',
                    'is_login_with_email_enabled' => 'Login with Email',
                    'is_remember_me_enabled' => 'Remember Me Option',
                    'is_account_deletion_enabled' => 'Account Deletion',
                    'is_strong_password_required' => 'Strong Password Required',
                    ] as $field => $label)
                    <label class="flex items-center justify-between p-4 bg-slate-50 dark:bg-dark-soft rounded-lg border border-slate-200 dark:border-dark-border hover:border-primary-500/30 transition cursor-pointer">
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $label }}</span>
                        <div class="relative">
                            <input type="checkbox" wire:model.live="state.{{ $field }}" class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-300 dark:bg-dark-border rounded-full peer peer-checked:bg-primary-600 transition-colors"></div>
                            <div class="absolute left-0.5 top-0.5 w-5 h-5 bg-white rounded-full transition-transform peer-checked:translate-x-5"></div>
                        </div>
                    </label>
                    @endforeach
                </div>

                <!-- Number/Text Inputs -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-200 dark:border-dark-border">
                    <div>
    <label for="default_role" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
        {{ __('Default Role') }}
    </label>

    <select
        id="default_role"
        wire:model="state.default_role"
        class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
    >
        <option value="">{{ __('Pilih Role') }}</option>

        @foreach ($roles as $role)
            <option value="{{ $role->name }}">{{ $role->name }}</option>
        @endforeach
    </select>

    @error('state.default_role')
        <span class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</span>
    @enderror
</div>


                    <div>
                        <label for="max_login_attempts" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Max Login Attempts</label>
                        <input type="number" wire:model="state.max_login_attempts" id="max_login_attempts" min="1" max="10" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        @error('state.max_login_attempts') <span class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="min_password_length" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Min Password Length</label>
                        <input type="number" wire:model="state.min_password_length" id="min_password_length" min="6" max="32" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        @error('state.min_password_length') <span class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label for="lockout_duration" class="block text-sm font-medium text-slate-700 dark:text-slate-300">Lockout Duration (minutes)</label>
                        <input type="number" wire:model="state.lockout_duration_minutes" id="lockout_duration" min="1" max="1440" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        @error('state.lockout_duration_minutes') <span class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-slate-50 dark:bg-dark-soft border-t border-slate-200 dark:border-dark-border flex justify-end">
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-base transition">
                    Save Changes
                </button>
            </div>
        </div>
    </form>
</div>
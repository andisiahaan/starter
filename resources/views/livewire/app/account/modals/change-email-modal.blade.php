<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
            @if($emailSent)
            {{ __('account.modals.change_email.verification_sent_title') }}
            @else
            {{ __('account.modals.change_email.title') }}
            @endif
        </h3>
        <button wire:click="$dispatch('closeModal')" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:text-white dark:hover:bg-white/10 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Body --}}
    <div class="p-5">
        @if($emailSent)
        <div class="text-center">
            <div class="w-12 h-12 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center mx-auto mb-4">
                <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
            <p class="text-slate-600 dark:text-slate-300">
                {{ __('account.modals.change_email.sent_to') }}
                <strong class="text-slate-900 dark:text-white">{{ $new_email }}</strong>
            </p>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                {{ __('account.modals.change_email.link_expires') }}
            </p>
        </div>
        @else
        <form wire:submit="changeEmail" class="space-y-4">
            {{-- New Email --}}
            <div>
                <label for="new_email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                    {{ __('account.modals.change_email.new_email') }}
                </label>
                <input
                    type="email"
                    id="new_email"
                    wire:model="new_email"
                    class="mt-1 block w-full px-3 py-2 border border-slate-300 dark:border-dark-border rounded-lg bg-white dark:bg-dark-muted text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    placeholder="new@example.com"
                    {{ $otpSent ? 'disabled' : '' }}
                    autofocus>
                @error('new_email')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                    {{ __('account.modals.change_email.confirm_password') }}
                </label>
                <input
                    type="password"
                    id="password"
                    wire:model="password"
                    class="mt-1 block w-full px-3 py-2 border border-slate-300 dark:border-dark-border rounded-lg bg-white dark:bg-dark-muted text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    {{ $otpSent ? 'disabled' : '' }}>
                @error('password')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- OTP Section --}}
            <div>
                <label for="otp" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                    {{ __('account.modals.change_email.otp_label') }}
                </label>
                <div class="mt-1 flex gap-2">
                    <input
                        type="text"
                        id="otp"
                        wire:model="otp"
                        maxlength="6"
                        class="flex-1 px-3 py-2 border border-slate-300 dark:border-dark-border rounded-lg bg-white dark:bg-dark-muted text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500 tracking-widest text-center font-mono"
                        placeholder="000000"
                        {{ !$otpSent ? 'disabled' : '' }}>
                    <button
                        type="button"
                        wire:click="sendOtp"
                        wire:loading.attr="disabled"
                        wire:target="sendOtp"
                        x-data="{ 
                            countdown: {{ $otpCooldown }},
                            interval: null,
                            init() {
                                if (this.countdown > 0) {
                                    this.startCountdown();
                                }
                            },
                            startCountdown() {
                                this.interval = setInterval(() => {
                                    this.countdown--;
                                    if (this.countdown <= 0) {
                                        clearInterval(this.interval);
                                        this.countdown = 0;
                                    }
                                }, 1000);
                            }
                        }"
                        x-on:click="if(countdown <= 0) { countdown = 60; startCountdown(); }"
                        :disabled="countdown > 0"
                        :class="countdown > 0 ? 'bg-slate-100 dark:bg-dark-muted text-slate-400 cursor-not-allowed' : 'bg-primary-600 text-white hover:bg-primary-700'"
                        class="px-4 py-2 text-sm font-medium rounded-lg transition">
                        <span wire:loading.remove wire:target="sendOtp">
                            <template x-if="countdown > 0">
                                <span x-text="countdown + 's'"></span>
                            </template>
                            <template x-if="countdown <= 0">
                                <span>{{ __('account.modals.change_email.send_otp') }}</span>
                            </template>
                        </span>
                        <span wire:loading wire:target="sendOtp">...</span>
                    </button>
                </div>
                @error('otp')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                @if($otpSent)
                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                    {{ __('account.modals.change_email.otp_sent_to_old') }}
                </p>
                @else
                <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                    {{ __('account.modals.change_email.otp_hint') }}
                </p>
                @endif
            </div>
        </form>
        @endif
    </div>

    {{-- Footer --}}
    <div class="flex items-center justify-end gap-3 px-5 py-4 border-t border-slate-200 dark:border-dark-border bg-slate-50 dark:bg-dark-soft">
        @if($emailSent)
        <button wire:click="$dispatch('closeModal')" class="btn btn-primary">
            {{ __('account.modals.change_email.got_it') }}
        </button>
        @else
        <button wire:click="$dispatch('closeModal')" class="btn btn-ghost">
            {{ __('account.modals.change_email.cancel') }}
        </button>
        <button 
            wire:click="changeEmail" 
            class="btn btn-primary" 
            wire:loading.attr="disabled"
            {{ !$otpSent ? 'disabled' : '' }}>
            <span wire:loading.remove wire:target="changeEmail">{{ __('account.modals.change_email.send_verification') }}</span>
            <span wire:loading wire:target="changeEmail">{{ __('account.modals.change_email.sending') }}</span>
        </button>
        @endif
    </div>
</div>


<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    {{-- Header --}}
    <div class="flex items-center justify-between px-4 md:px-6 py-4 border-b border-slate-200 dark:border-dark-border">
        <div>
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ __('referral.user.withdrawals.modal.title') }}</h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ __('referral.user.withdrawals.modal.available') }} Rp {{ number_format($availableCommission, 0, ',', '.') }}</p>
        </div>
        <button wire:click="$dispatch('closeModal')" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 dark:hover:text-white transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Body --}}
    <div class="p-4 md:p-6">
        <form wire:submit="requestWithdrawal" class="space-y-4">
            {{-- Payment Method --}}
            <div>
                <label for="paymentMethodId" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('referral.user.withdrawals.modal.payment_method') }}</label>
                <select wire:model.live="paymentMethodId" id="paymentMethodId"
                       class="w-full bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                    <option value="">{{ __('referral.user.withdrawals.modal.select_payment_method') }}</option>
                    @foreach($paymentMethods as $method)
                        <option value="{{ $method->id }}">{{ $method->name }}</option>
                    @endforeach
                </select>
                @error('paymentMethodId') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Min/Max Info (shows when payment method selected) --}}
            @if($this->selectedPaymentMethod)
            <div class="p-3 bg-slate-100 dark:bg-dark-soft rounded-lg text-sm text-slate-600 dark:text-slate-400">
                <p>{{ __('referral.user.withdrawals.modal.min_amount') }}: <span class="font-semibold text-slate-900 dark:text-white">Rp {{ number_format($this->minAmount, 0, ',', '.') }}</span></p>
                <p>{{ __('referral.user.withdrawals.modal.max_amount') }}: <span class="font-semibold text-slate-900 dark:text-white">Rp {{ number_format($this->maxAmount, 0, ',', '.') }}</span></p>
            </div>
            @endif

            {{-- Amount --}}
            <div>
                <label for="amount" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('referral.user.withdrawals.modal.amount') }}</label>
                <input type="number" wire:model="amount" id="amount" 
                       min="{{ $this->minAmount }}" 
                       max="{{ $this->maxAmount }}" 
                       step="1000"
                       class="w-full bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                @error('amount') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Bank Name --}}
            <div>
                <label for="bankName" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('referral.user.withdrawals.modal.bank_name') }} <span class="text-slate-400">({{ __('common.optional') }})</span></label>
                <input type="text" wire:model="bankName" id="bankName" placeholder="{{ __('referral.user.withdrawals.modal.bank_placeholder') }}"
                       class="w-full bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                @error('bankName') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Account Number --}}
            <div>
                <label for="accountNumber" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('referral.user.withdrawals.modal.account_number') }}</label>
                <input type="text" wire:model="accountNumber" id="accountNumber" placeholder="{{ __('referral.user.withdrawals.modal.account_number_placeholder') }}"
                       class="w-full bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                @error('accountNumber') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Account Holder --}}
            <div>
                <label for="accountHolder" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('referral.user.withdrawals.modal.account_holder') }}</label>
                <input type="text" wire:model="accountHolder" id="accountHolder" placeholder="{{ __('referral.user.withdrawals.modal.account_holder_placeholder') }}"
                       class="w-full bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                @error('accountHolder') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>

            {{-- Password (if required) --}}
            @if($requirePassword)
            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('referral.user.withdrawals.modal.password') }}</label>
                <input type="password" wire:model="password" id="password" placeholder="{{ __('referral.user.withdrawals.modal.password_placeholder') }}"
                       class="w-full bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                @error('password') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>
            @endif

            {{-- OTP (if required) --}}
            @if($requireOtp)
            <div>
                <label for="otp" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">{{ __('referral.user.withdrawals.modal.otp') }}</label>
                <div class="flex gap-2">
                    <input type="text" wire:model="otp" id="otp" 
                           placeholder="{{ __('referral.user.withdrawals.modal.otp_placeholder') }}"
                           maxlength="6"
                           class="flex-1 bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                    <button type="button" 
                            wire:click="sendOtp" 
                            wire:loading.attr="disabled"
                            wire:target="sendOtp"
                            @if($this->otpOnCooldown) disabled @endif
                            x-data="{ cooldown: {{ $this->remainingCooldown }}, interval: null }"
                            x-init="if(cooldown > 0) { interval = setInterval(() => { cooldown--; if(cooldown <= 0) clearInterval(interval); }, 1000); }"
                            class="px-4 py-2.5 text-sm font-medium rounded-lg transition-colors whitespace-nowrap
                                   {{ $this->otpOnCooldown 
                                      ? 'bg-slate-200 dark:bg-dark-muted text-slate-400 cursor-not-allowed' 
                                      : 'bg-primary-600 text-white hover:bg-primary-700' }}">
                        <span wire:loading.remove wire:target="sendOtp">
                            @if($this->otpOnCooldown)
                                <span x-text="cooldown + 's'"></span>
                            @else
                                {{ __('referral.user.withdrawals.modal.send_otp') }}
                            @endif
                        </span>
                        <span wire:loading wire:target="sendOtp">
                            <svg class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </span>
                    </button>
                </div>
                @if($otpSent)
                <p class="mt-1 text-sm text-green-600 dark:text-green-400">{{ __('referral.user.withdrawals.otp.sent_message') }}</p>
                @endif
                @error('otp') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
            </div>
            @endif
        </form>
    </div>

    {{-- Footer --}}
    <div class="flex items-center justify-end gap-3 px-4 md:px-6 py-4 border-t border-slate-200 dark:border-dark-border bg-slate-50 dark:bg-dark-soft">
        <button wire:click="$dispatch('closeModal')" class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-dark-muted rounded-lg transition-colors">
            {{ __('referral.user.withdrawals.modal.cancel') }}
        </button>
        <button wire:click="requestWithdrawal" class="px-4 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-colors" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="requestWithdrawal">{{ __('referral.user.withdrawals.modal.submit') }}</span>
            <span wire:loading wire:target="requestWithdrawal" class="flex items-center gap-2">
                <svg class="animate-spin w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ __('referral.user.withdrawals.modal.processing') }}
            </span>
        </button>
    </div>
</div>

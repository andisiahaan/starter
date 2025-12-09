<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">
            @if($emailSent)
            {{ __('Verification Email Sent') }}
            @else
            {{ __('Change Email Address') }}
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
                {{ __('We have sent a verification link to') }}
                <strong class="text-slate-900 dark:text-white">{{ $new_email }}</strong>
            </p>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                {{ __('Click the link in the email to confirm your new email address. The link will expire in 24 hours.') }}
            </p>
        </div>
        @else
        <form wire:submit="changeEmail" class="space-y-4">
            <div>
                <label for="new_email" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                    {{ __('New Email Address') }}
                </label>
                <input
                    type="email"
                    id="new_email"
                    wire:model="new_email"
                    class="mt-1 block w-full px-3 py-2 border border-slate-300 dark:border-dark-border rounded-lg bg-white dark:bg-dark-muted text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    placeholder="new@example.com"
                    autofocus>
                @error('new_email')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                    {{ __('Confirm your password') }}
                </label>
                <input
                    type="password"
                    id="password"
                    wire:model="password"
                    class="mt-1 block w-full px-3 py-2 border border-slate-300 dark:border-dark-border rounded-lg bg-white dark:bg-dark-muted text-slate-900 dark:text-white focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                @error('password')
                <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </form>
        @endif
    </div>

    {{-- Footer --}}
    <div class="flex items-center justify-end gap-3 px-5 py-4 border-t border-slate-200 dark:border-dark-border bg-slate-50 dark:bg-dark-soft">
        @if($emailSent)
        <button wire:click="$dispatch('closeModal')" class="btn btn-primary">
            {{ __('Got it') }}
        </button>
        @else
        <button wire:click="$dispatch('closeModal')" class="btn btn-ghost">
            {{ __('Cancel') }}
        </button>
        <button wire:click="changeEmail" class="btn btn-primary" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="changeEmail">{{ __('Send Verification') }}</span>
            <span wire:loading wire:target="changeEmail">{{ __('Sending...') }}</span>
        </button>
        @endif
    </div>
</div>

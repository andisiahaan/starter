<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ __('Recovery Codes') }}</h3>
        <button wire:click="$dispatch('closeModal')" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:text-white dark:hover:bg-white/10 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Body --}}
    <div class="p-5">
        <p class="text-sm text-slate-600 dark:text-slate-300 mb-4">
            {{ __('Store these recovery codes in a secure location. They can be used to access your account if you lose your authenticator device.') }}
        </p>

        <div class="bg-slate-100 dark:bg-dark-soft rounded-lg p-4 mb-4">
            <div class="grid grid-cols-2 gap-2 font-mono text-sm">
                @forelse($recoveryCodes as $code)
                <div class="p-2 bg-white dark:bg-dark-muted rounded text-center text-slate-800 dark:text-slate-200">
                    {{ $code }}
                </div>
                @empty
                <p class="col-span-2 text-center text-slate-500">{{ __('No recovery codes available.') }}</p>
                @endforelse
            </div>
        </div>

        <p class="text-xs text-slate-500 dark:text-slate-400">
            {{ __('Each code can only be used once. You have :count codes remaining.', ['count' => count($recoveryCodes)]) }}
        </p>
    </div>

    {{-- Footer --}}
    <div class="flex items-center justify-between px-5 py-4 border-t border-slate-200 dark:border-dark-border bg-slate-50 dark:bg-dark-soft">
        <button
            x-data
            @click="
                const codes = @js(implode('\n', $recoveryCodes));
                navigator.clipboard.writeText(codes);
                $dispatch('toast', { type: 'success', message: '{{ __('Codes copied to clipboard') }}' });
            "
            class="btn btn-ghost">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
            </svg>
            {{ __('Copy') }}
        </button>
        <button wire:click="$dispatch('closeModal')" class="btn btn-primary">
            {{ __('Done') }}
        </button>
    </div>
</div>

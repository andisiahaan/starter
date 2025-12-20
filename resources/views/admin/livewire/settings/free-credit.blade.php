<div>
    <form wire:submit="save">
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 dark:border-dark-border">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ __('free_credit.settings.title') }}</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ __('free_credit.settings.description') }}</p>
            </div>

            <div class="p-6 space-y-6">
                <!-- Enable Free Credit -->
                <div class="flex items-center justify-between">
                    <div>
                        <label class="text-sm font-medium text-slate-900 dark:text-white">{{ __('free_credit.settings.enabled') }}</label>
                        <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('free_credit.settings.enabled_help') }}</p>
                    </div>
                    <button type="button" wire:click="$toggle('state.enabled')"
                            class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-600 focus:ring-offset-2 {{ $state['enabled'] ? 'bg-primary-600' : 'bg-slate-200 dark:bg-slate-600' }}">
                        <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $state['enabled'] ? 'translate-x-5' : 'translate-x-0' }}"></span>
                    </button>
                </div>

                <hr class="border-slate-200 dark:border-dark-border">

                <!-- Credit Amount -->
                <div>
                    <label for="amount" class="block text-sm font-medium text-slate-900 dark:text-white mb-1">
                        {{ __('free_credit.settings.amount') }}
                    </label>
                    <input type="number" wire:model="state.amount" id="amount" min="0" step="100"
                           class="w-full max-w-xs bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">{{ __('free_credit.settings.amount_help') }}</p>
                    @error('state.amount') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                <hr class="border-slate-200 dark:border-dark-border">

                <!-- Preview Widget -->
                <div>
                    <h4 class="text-sm font-medium text-slate-900 dark:text-white mb-3">{{ __('free_credit.settings.preview') }}</h4>
                    
                    @if($state['enabled'] && $state['amount'] > 0)
                    <div class="max-w-md">
                        <div class="relative overflow-hidden bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl shadow-lg">
                            <div class="absolute inset-0 bg-white/5"></div>
                            <div class="relative px-5 py-4">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="flex-shrink-0 w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-emerald-100 text-xs font-medium uppercase tracking-wide">{{ __('free_credit.title') }}</p>
                                            <p class="text-white text-xl font-bold">{{ number_format($state['amount'], 0, ',', '.') }} Credits</p>
                                        </div>
                                    </div>
                                    <button type="button" 
                                            class="px-4 py-2 bg-white text-emerald-600 text-sm font-semibold rounded-lg shadow-sm hover:bg-emerald-50 transition-colors cursor-default">
                                        {{ __('free_credit.claim_now') }}
                                    </button>
                                </div>
                                <p class="mt-3 text-emerald-100 text-sm">{{ now()->translatedFormat('F Y') }}</p>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="max-w-md p-4 bg-slate-100 dark:bg-dark-soft rounded-lg border border-dashed border-slate-300 dark:border-dark-border">
                        <p class="text-sm text-slate-500 dark:text-slate-400 text-center">
                            {{ __('free_credit.settings.preview_disabled') }}
                        </p>
                    </div>
                    @endif
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

<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden">
    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ __('credits.credit_logs.add') }}</h3>
        <button wire:click="$dispatch('closeModal')" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Body --}}
    <div class="p-5 max-h-[70vh] overflow-y-auto">
        <form wire:submit="save" class="space-y-5">
            {{-- User Selection --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                    User <span class="text-red-500">*</span>
                </label>
                
                @if($selectedUser)
                    {{-- Selected User Display --}}
                    <div class="flex items-center justify-between p-3 rounded-lg bg-primary-50 dark:bg-primary-900/20 border border-primary-200 dark:border-primary-800">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 font-bold">
                                {{ strtoupper(substr($selectedUser->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="font-medium text-slate-900 dark:text-white">{{ $selectedUser->name }}</div>
                                <div class="text-sm text-slate-500 dark:text-slate-400">{{ $selectedUser->email }}</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="text-right">
                                <div class="text-xs text-slate-500 dark:text-slate-400">{{ __('credits.credit_logs.form.current_credit') }}</div>
                                <div class="font-semibold text-slate-900 dark:text-white">{{ number_format($selectedUser->credit, 2) }}</div>
                            </div>
                            <button type="button" wire:click="clearSelectedUser" class="p-1 text-slate-400 hover:text-red-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                @else
                    {{-- User Search Input --}}
                    <div class="relative">
                        <input
                            type="text"
                            wire:model.live.debounce.300ms="userSearch"
                            placeholder="{{ __('credits.credit_logs.form.search_user') }}"
                            class="block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm"
                        >
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        
                        {{-- Search Results Dropdown --}}
                        @if(count($userResults) > 0)
                            <div class="absolute z-10 w-full mt-1 bg-white dark:bg-dark-elevated border border-slate-200 dark:border-dark-border rounded-md shadow-lg max-h-60 overflow-auto">
                                @foreach($userResults as $result)
                                    <button
                                        type="button"
                                        wire:click="selectUser({{ $result['id'] }})"
                                        class="w-full flex items-center gap-3 px-4 py-3 hover:bg-slate-50 dark:hover:bg-dark-soft transition-colors text-left"
                                    >
                                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-slate-100 dark:bg-dark-soft text-slate-600 dark:text-slate-400 font-bold text-sm">
                                            {{ strtoupper(substr($result['name'], 0, 1)) }}
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="font-medium text-slate-900 dark:text-white truncate">{{ $result['name'] }}</div>
                                            <div class="text-sm text-slate-500 dark:text-slate-400 truncate">{{ $result['email'] }}</div>
                                        </div>
                                        <div class="text-sm font-medium text-slate-600 dark:text-slate-300">
                                            {{ number_format($result['credit'], 2) }}
                                        </div>
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endif
                
                @error('userId')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Amount --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                    Amount <span class="text-red-500">*</span>
                </label>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-2">
                    {{ __('credits.credit_logs.form.amount_hint') }}
                </p>
                <input
                    type="number"
                    wire:model="amount"
                    step="0.01"
                    placeholder="{{ __('credits.credit_logs.form.amount_placeholder') }}"
                    class="block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm"
                >
                @error('amount')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Type --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                    {{ __('credits.credit_logs.form.type') }} <span class="text-red-500">*</span>
                </label>
                <select
                    wire:model="type"
                    class="block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm"
                >
                    <option value="">{{ __('credits.credit_logs.form.select_type') }}</option>
                    @foreach($availableTypes as $typeEnum)
                        <option value="{{ $typeEnum->value }}">{{ $typeEnum->getLabel() }}</option>
                    @endforeach
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                    {{ __('credits.credit_logs.form.description') }}
                </label>
                <textarea
                    wire:model="description"
                    rows="3"
                    placeholder="{{ __('credits.credit_logs.form.description_placeholder') }}"
                    class="block w-full rounded-md border-slate-300 dark:border-dark-border shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white dark:bg-dark-elevated text-slate-900 dark:text-white sm:text-sm"
                ></textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            {{-- Preview --}}
            @if($selectedUser && $amount != 0)
                <div class="p-4 rounded-lg {{ $amount > 0 ? 'bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800' : 'bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800' }}">
                    <h4 class="font-medium {{ $amount > 0 ? 'text-green-800 dark:text-green-300' : 'text-red-800 dark:text-red-300' }} mb-2">{{ __('credits.credit_logs.form.preview_title') }}</h4>
                    <div class="flex items-center gap-4 text-sm">
                        <div class="text-slate-600 dark:text-slate-400">
                            {{ __('credits.credit_logs.form.credit_before') }} <span class="font-medium">{{ number_format($selectedUser->credit, 2) }}</span>
                        </div>
                        <div class="{{ $amount > 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                            {{ $amount > 0 ? '+' : '' }}{{ number_format($amount, 2) }}
                        </div>
                        <div class="font-medium {{ $amount > 0 ? 'text-green-700 dark:text-green-300' : 'text-red-700 dark:text-red-300' }}">
                            = {{ number_format($selectedUser->credit + $amount, 2) }}
                        </div>
                    </div>
                    @if($amount < 0 && abs($amount) > $selectedUser->credit)
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">
                            ⚠️ {{ __('credits.credit_logs.form.insufficient_warning') }}
                        </p>
                    @endif
                </div>
            @endif
        </form>
    </div>

    {{-- Footer --}}
    <div class="flex items-center justify-end gap-3 px-5 py-4 border-t border-slate-200 dark:border-dark-border bg-slate-50 dark:bg-dark-soft">
        <button type="button" wire:click="$dispatch('closeModal')" class="inline-flex items-center px-4 py-2 border border-slate-300 dark:border-dark-border text-sm font-medium rounded-md text-slate-700 dark:text-slate-300 bg-white dark:bg-dark-elevated hover:bg-slate-50 dark:hover:bg-dark-soft focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            {{ __('common.actions.cancel') }}
        </button>
        <button type="button" wire:click="save" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            {{ __('common.actions.save') }}
        </button>
    </div>
</div>


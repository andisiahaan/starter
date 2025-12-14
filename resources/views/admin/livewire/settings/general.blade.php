<div>
    <form wire:submit="save">
        <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 dark:border-dark-border">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ __('settings.general.title') }}</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('settings.general.description') }}</p>
            </div>

            <div class="p-6 space-y-6">
                <!-- App Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.general.app_name') }}</label>
                    <input type="text" wire:model="state.name" id="name" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                    @error('state.name') <span class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.general.app_description') }}</label>
                    <textarea wire:model="state.description" id="description" rows="3" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm"></textarea>
                    @error('state.description') <span class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Logo & Favicon -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Logo -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ __('settings.general.logo') }}</label>
                        <div class="flex items-center gap-4">
                            <div class="h-16 w-16 rounded-lg bg-slate-100 dark:bg-dark-soft border border-slate-200 dark:border-dark-border flex items-center justify-center overflow-hidden">
                                @if ($logo)
                                <img src="{{ $logo->temporaryUrl() }}" class="h-full w-full object-contain">
                                @elseif(!empty($state['logo']))
                                <img src="{{ Storage::url($state['logo']) }}" class="h-full w-full object-contain">
                                @else
                                <svg class="h-8 w-8 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                @endif
                            </div>
                            <label class="cursor-pointer px-4 py-2 bg-slate-100 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-dark-border transition">
                                <span>{{ __('settings.general.upload_logo') }}</span>
                                <input type="file" class="sr-only" wire:model="logo" accept="image/*">
                            </label>
                        </div>
                        @error('logo') <span class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Favicon -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">{{ __('settings.general.favicon') }}</label>
                        <div class="flex items-center gap-4">
                            <div class="h-16 w-16 rounded-lg bg-slate-100 dark:bg-dark-soft border border-slate-200 dark:border-dark-border flex items-center justify-center overflow-hidden">
                                @if ($favicon)
                                <img src="{{ $favicon->temporaryUrl() }}" class="h-full w-full object-contain">
                                @elseif(!empty($state['favicon']))
                                <img src="{{ Storage::url($state['favicon']) }}" class="h-full w-full object-contain">
                                @else
                                <svg class="h-8 w-8 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                @endif
                            </div>
                            <label class="cursor-pointer px-4 py-2 bg-slate-100 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-dark-border transition">
                                <span>{{ __('settings.general.upload_favicon') }}</span>
                                <input type="file" class="sr-only" wire:model="favicon" accept="image/*">
                            </label>
                        </div>
                        @error('favicon') <span class="text-red-600 dark:text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Language, Theme, Timezone, Currency -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="language" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.general.language') }}</label>
                        <select wire:model="state.default_language" id="language" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            @foreach($languages as $code => $lang)
                            <option value="{{ $code }}">{{ $lang['flag'] }} {{ $lang['native_name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="theme" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.general.default_theme') }}</label>
                        <select wire:model="state.theme" id="theme" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            <option value="light">{{ __('settings.general.themes.light') }}</option>
                            <option value="dark">{{ __('settings.general.themes.dark') }}</option>
                        </select>
                    </div>

                    @php
    $timezones = \DateTimeZone::listIdentifiers();
@endphp

<div>
    <label for="timezone" class="block text-sm font-medium text-slate-700 dark:text-slate-300">
        {{ __('settings.general.timezone') }}
    </label>

    <select
        wire:model="state.timezone"
        id="timezone"
        class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
    >
        <option value="">{{ __('Select Timezone') }}</option>

        @foreach ($timezones as $timezone)
            <option value="{{ $timezone }}">
                {{ $timezone }}
            </option>
        @endforeach
    </select>
</div>


                    <div>
                        <label for="currency" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('settings.general.currency') }}</label>
                        <input type="text" wire:model="state.currency" id="currency" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm" placeholder="IDR">
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-slate-50 dark:bg-dark-soft border-t border-slate-200 dark:border-dark-border flex justify-end">
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-base transition">
                    {{ __('common.actions.save_changes') }}
                </button>
            </div>
        </div>
    </form>
</div>
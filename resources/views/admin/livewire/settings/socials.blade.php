<div>
    <form wire:submit="save">
        <div class="bg-white dark:bg-dark-elevated rounded-lg border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-200 dark:border-dark-border">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Social Links</h3>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Add your social media profile URLs.</p>
            </div>

            <div class="p-6 space-y-4">
                @foreach($socialLabels as $key => $social)
                <div class="flex items-center gap-4">
                    <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-slate-100 dark:bg-dark-soft border border-slate-200 dark:border-dark-border flex items-center justify-center">
                        <svg class="w-5 h-5 text-slate-500 dark:text-slate-400" fill="currentColor" viewBox="0 0 24 24">
                            <path d="{{ $social['icon'] }}" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <label for="{{ $key }}" class="block text-sm font-medium text-slate-700 dark:text-slate-300">{{ $social['label'] }}</label>
                        <input type="url" wire:model="state.{{ $key }}" id="{{ $key }}" placeholder="{{ $social['placeholder'] }}" class="mt-1 block w-full rounded-lg border-slate-300 dark:border-dark-border bg-white dark:bg-dark-soft text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        @error("state.{$key}") <span class="text-red-600 dark:text-red-400 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                @endforeach
            </div>

            <div class="px-6 py-4 bg-slate-50 dark:bg-dark-soft border-t border-slate-200 dark:border-dark-border flex justify-end">
                <button type="submit" class="px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-dark-base transition">
                    Save Changes
                </button>
            </div>
        </div>
    </form>
</div>
<div>
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">{{ __('credits.user.history.title') }}</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('credits.user.history.subtitle') }}</p>
        </div>
        <div class="flex items-center gap-3">
            <div class="text-right">
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ __('credits.user.balance.current') }}</p>
                <p class="text-xl font-bold text-primary-600 dark:text-primary-400">{{ number_format($user->credit, 0, ',', '.') }}</p>
            </div>
            <a href="{{ route('app.credits.index') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
                {{ __('credits.user.actions.buy_credits') }}
            </a>
        </div>
    </div>

    <!-- Filter -->
    <div class="mb-4">
        <select wire:model.live="typeFilter" class="block w-full sm:w-48 rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 dark:bg-dark-elevated dark:border-dark-border dark:text-white sm:text-sm">
            <option value="">{{ __('credits.user.history.all_types') }}</option>
            @foreach($types as $key => $label)
            <option value="{{ $key }}">{{ $label }}</option>
            @endforeach
        </select>
    </div>

    <!-- History List -->
    <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-gray-200 dark:border-dark-border overflow-hidden">
        @forelse($logs as $log)
        @php
            $hasOrderLink = $log->reference_type === 'App\\Models\\Order' && $log->reference_id;
            $linkHref = $hasOrderLink ? route('app.orders.show', $log->reference_id) : null;
        @endphp
        <a href="{{ $linkHref ?? '#' }}" 
           @if(!$hasOrderLink) onclick="event.preventDefault()" @endif
           class="flex items-center justify-between p-4 border-b border-gray-100 dark:border-dark-border last:border-b-0 hover:bg-gray-50 dark:hover:bg-dark-soft transition-colors {{ $hasOrderLink ? 'cursor-pointer' : 'cursor-default' }}">
            <div class="flex items-center gap-4">
                <div class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center {{ $log->amount >= 0 ? 'bg-green-100 dark:bg-green-900/30' : 'bg-red-100 dark:bg-red-900/30' }}">
                    @if($log->amount >= 0)
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    @else
                    <svg class="w-5 h-5 text-red-600 dark:text-red-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                    </svg>
                    @endif
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $log->description ?? $types[$log->type] ?? $log->type }}</p>
                        @if($hasOrderLink)
                        <svg class="w-4 h-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                        @endif
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $log->created_at->format('M d, Y H:i') }}</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-lg font-semibold {{ $log->amount >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                    {{ $log->amount >= 0 ? '+' : '' }}{{ number_format($log->amount, 0, ',', '.') }}
                </p>
                <p class="text-xs text-gray-400">{{ __('credits.user.history.balance_after', ['amount' => number_format($log->balance_after, 0, ',', '.')]) }}</p>
            </div>
        </a>
        @empty
        <div class="p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('credits.user.history.empty_title') }}</h3>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('credits.user.history.empty_desc') }}</p>
        </div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $logs->links() }}
    </div>
</div>
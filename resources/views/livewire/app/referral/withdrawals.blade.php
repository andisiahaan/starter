<div>
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ __('referral.user.withdrawals.title') }}</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400">{{ __('referral.user.withdrawals.available') }} <span class="font-semibold text-green-600">Rp {{ number_format($availableCommission, 0, ',', '.') }}</span></p>
        </div>
        <button wire:click="$dispatch('openModal', { component: 'app.referral.modals.request-withdrawal-modal' })" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            {{ __('referral.user.withdrawals.request') }}
        </button>
    </div>

    <!-- Withdrawals Table -->
    <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border overflow-hidden">
        @if($withdrawals->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
                <thead class="bg-slate-50 dark:bg-dark-soft">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('referral.user.withdrawals.table.date') }}</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('referral.user.withdrawals.table.amount') }}</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('referral.user.withdrawals.table.account_details') }}</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">{{ __('referral.user.withdrawals.table.status') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-dark-elevated divide-y divide-slate-200 dark:divide-dark-border">
                    @foreach($withdrawals as $withdrawal)
                    <tr>
                        <td class="px-5 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                            {{ $withdrawal->created_at->format('M d, Y H:i') }}
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <span class="text-sm font-semibold text-slate-900 dark:text-white">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                            {{ $withdrawal->formatted_account_details }}
                        </td>
                        <td class="px-5 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                @if($withdrawal->status === 'completed') bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400
                                @elseif($withdrawal->status === 'pending') bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400
                                @elseif($withdrawal->status === 'processing') bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400
                                @else bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 @endif">
                                {{ __('referral.withdrawals.status.' . $withdrawal->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4 border-t border-slate-200 dark:border-dark-border">
            {{ $withdrawals->links() }}
        </div>
        @else
        <div class="p-8 text-center">
            <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3 class="mt-2 text-sm font-medium text-slate-900 dark:text-white">{{ __('referral.user.withdrawals.empty.title') }}</h3>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('referral.user.withdrawals.empty.description') }}</p>
        </div>
        @endif
    </div>

    <!-- Back Link -->
    <div class="mt-6">
        <a href="{{ route('app.referral.index') }}" class="inline-flex items-center text-sm text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            {{ __('referral.user.withdrawals.back') }}
        </a>
    </div>

</div>

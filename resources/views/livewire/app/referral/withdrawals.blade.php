<div>
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Withdrawal History</h1>
            <p class="text-sm text-slate-500 dark:text-slate-400">Available: <span class="font-semibold text-green-600">Rp {{ number_format($availableCommission, 0, ',', '.') }}</span></p>
        </div>
        <button wire:click="openRequestModal" class="inline-flex items-center px-4 py-2 bg-primary-600 text-white text-sm font-medium rounded-lg hover:bg-primary-700 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Request Withdrawal
        </button>
    </div>

    <!-- Withdrawals Table -->
    <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border overflow-hidden">
        @if($withdrawals->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
                <thead class="bg-slate-50 dark:bg-dark-soft">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Date</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Amount</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Account Details</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
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
                                {{ ucfirst($withdrawal->status) }}
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
            <h3 class="mt-2 text-sm font-medium text-slate-900 dark:text-white">No withdrawals yet</h3>
            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Your withdrawal history will appear here.</p>
        </div>
        @endif
    </div>

    <!-- Request Withdrawal Modal -->
    @if($showRequestModal)
    <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-500/75 dark:bg-slate-900/80 transition-opacity" wire:click="closeRequestModal"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block align-bottom bg-white dark:bg-dark-elevated rounded-xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form wire:submit="requestWithdrawal">
                    <div class="px-6 py-5 border-b border-slate-200 dark:border-dark-border">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Request Withdrawal</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Available: Rp {{ number_format($availableCommission, 0, ',', '.') }}</p>
                    </div>

                    <div class="px-6 py-5 space-y-4">
                        <!-- Amount -->
                        <div>
                            <label for="amount" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Amount</label>
                            <input type="number" wire:model="amount" id="amount" min="10000" max="{{ $availableCommission }}" step="1000"
                                   class="w-full bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                            @error('amount') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                        </div>

                        <!-- Bank Name -->
                        <div>
                            <label for="bankName" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Bank Name</label>
                            <input type="text" wire:model="bankName" id="bankName" placeholder="e.g. BCA, Mandiri, BNI"
                                   class="w-full bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                            @error('bankName') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                        </div>

                        <!-- Account Number -->
                        <div>
                            <label for="accountNumber" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Account Number</label>
                            <input type="text" wire:model="accountNumber" id="accountNumber" placeholder="1234567890"
                                   class="w-full bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                            @error('accountNumber') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                        </div>

                        <!-- Account Holder -->
                        <div>
                            <label for="accountHolder" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Account Holder Name</label>
                            <input type="text" wire:model="accountHolder" id="accountHolder" placeholder="John Doe"
                                   class="w-full bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-4 py-2.5 text-slate-700 dark:text-slate-300 focus:ring-primary-500 focus:border-primary-500">
                            @error('accountHolder') <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="px-6 py-4 bg-slate-50 dark:bg-dark-soft flex justify-end gap-3">
                        <button type="button" wire:click="closeRequestModal" class="px-4 py-2 text-sm font-medium text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-dark-muted rounded-lg transition-colors">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-colors">
                            Submit Request
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <!-- Back Link -->
    <div class="mt-6">
        <a href="{{ route('app.referral.index') }}" class="inline-flex items-center text-sm text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Referral
        </a>
    </div>
</div>

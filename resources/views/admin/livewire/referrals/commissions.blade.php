<div>
    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border p-5">
            <p class="text-sm text-slate-500 dark:text-slate-400">Total Commissions</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-white mt-1">Rp {{ number_format($stats['total'], 0, ',', '.') }}</p>
        </div>
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border p-5">
            <p class="text-sm text-slate-500 dark:text-slate-400">Pending</p>
            <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400 mt-1">Rp {{ number_format($stats['pending'], 0, ',', '.') }}</p>
        </div>
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border p-5">
            <p class="text-sm text-slate-500 dark:text-slate-400">Available</p>
            <p class="text-2xl font-bold text-green-600 dark:text-green-400 mt-1">Rp {{ number_format($stats['available'], 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-200 dark:border-dark-border flex flex-wrap items-center justify-between gap-4">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Commissions</h3>
            <div class="flex items-center gap-3">
                <select wire:model.live="statusFilter" class="bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-3 py-2 text-sm">
                    <option value="">All Status</option>
                    @foreach($statuses as $status)
                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search..." 
                       class="w-64 bg-slate-50 dark:bg-dark-soft border border-slate-200 dark:border-dark-border rounded-lg px-3 py-2 text-sm">
            </div>
        </div>

        @if($commissions->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-dark-border">
                <thead class="bg-slate-50 dark:bg-dark-soft">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Referrer</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Referred</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Amount</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Status</th>
                        <th class="px-5 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Date</th>
                        <th class="px-5 py-3 text-right text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-dark-border">
                    @foreach($commissions as $commission)
                    <tr>
                        <td class="px-5 py-4">
                            <p class="text-sm font-medium text-slate-900 dark:text-white">{{ $commission->user?->name ?? '-' }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $commission->user?->email }}</p>
                        </td>
                        <td class="px-5 py-4">
                            <p class="text-sm text-slate-900 dark:text-white">{{ $commission->referredUser?->name ?? '-' }}</p>
                        </td>
                        <td class="px-5 py-4">
                            <p class="text-sm font-semibold text-slate-900 dark:text-white">Rp {{ number_format($commission->amount, 0, ',', '.') }}</p>
                        </td>
                        <td class="px-5 py-4">
                            <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                @if($commission->status === 'available') bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400
                                @elseif($commission->status === 'pending') bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400
                                @elseif($commission->status === 'withdrawn') bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400
                                @else bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-400 @endif">
                                {{ ucfirst($commission->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-sm text-slate-500 dark:text-slate-400">
                            {{ $commission->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-5 py-4 text-right">
                            @if($commission->status === 'pending')
                            <button wire:click="updateStatus({{ $commission->id }}, 'available')" 
                                    class="text-green-600 hover:text-green-700 text-sm font-medium">
                                Approve
                            </button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-5 py-4 border-t border-slate-200 dark:border-dark-border">
            {{ $commissions->links() }}
        </div>
        @else
        <div class="p-8 text-center">
            <p class="text-slate-500 dark:text-slate-400">No commissions found.</p>
        </div>
        @endif
    </div>
</div>

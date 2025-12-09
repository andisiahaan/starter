<div>
    <h1 class="text-2xl font-semibold text-slate-900 dark:text-white">Dashboard</h1>

    <div class="mt-6 grid grid-cols-1 gap-4 sm:gap-5 lg:grid-cols-3">
        <!-- Credit Balance Card -->
        <div class="lg:col-span-2 bg-gradient-to-br from-primary-600 to-primary-800 rounded-2xl shadow-lg overflow-hidden">
            <div class="px-6 py-6 sm:px-8">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-primary-100 text-sm font-medium">Your Credit Balance</p>
                        <p class="text-4xl font-bold text-white mt-1">{{ number_format($creditBalance, 0, ',', '.') }}</p>
                        <p class="text-primary-200 text-sm mt-1">Credits available</p>
                    </div>
                    <div class="bg-white/10 rounded-full p-4">
                        <svg class="w-10 h-10 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-6 flex gap-3">
                    <a href="{{ route('app.credits.index') }}" class="inline-flex items-center px-4 py-2 bg-white text-primary-600 text-sm font-medium rounded-lg hover:bg-white/90 transition-colors">
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Buy Credits
                    </a>
                    <a href="{{ route('app.credits.history') }}" class="inline-flex items-center px-4 py-2 bg-white/20 text-white text-sm font-medium rounded-lg hover:bg-white/30 transition-colors">
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        View History
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions Card -->
        <div class="bg-white dark:bg-dark-elevated overflow-hidden shadow-sm rounded-xl border border-slate-200 dark:border-dark-border">
            <div class="p-4 sm:p-5">
                <h3 class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-4">Quick Actions</h3>
                <div class="space-y-3">
                    <a href="{{ route('app.credits.index') }}" class="flex items-center p-3 rounded-lg bg-gradient-to-r from-green-50 to-green-100 dark:from-green-900/20 dark:to-green-900/10 text-green-700 dark:text-green-400 hover:from-green-100 hover:to-green-200 dark:hover:from-green-900/30 dark:hover:to-green-900/20 transition-colors">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-green-500 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                        <span class="ml-3 text-sm font-medium">Buy Credits</span>
                    </a>
                    <a href="{{ route('app.orders.index') }}" class="flex items-center p-3 rounded-lg bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-900/10 text-blue-700 dark:text-blue-400 hover:from-blue-100 hover:to-blue-200 dark:hover:from-blue-900/30 dark:hover:to-blue-900/20 transition-colors">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-blue-500 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <span class="ml-3 text-sm font-medium">View Orders</span>
                    </a>
                    <a href="{{ route('app.tickets.create') }}" class="flex items-center p-3 rounded-lg bg-gradient-to-r from-purple-50 to-purple-100 dark:from-purple-900/20 dark:to-purple-900/10 text-purple-700 dark:text-purple-400 hover:from-purple-100 hover:to-purple-200 dark:hover:from-purple-900/30 dark:hover:to-purple-900/20 transition-colors">
                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-purple-500 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="ml-3 text-sm font-medium">Get Support</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Order Stats Grid -->
    <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-4">
        <div class="bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-2 bg-slate-100 dark:bg-slate-700 rounded-lg">
                    <svg class="w-5 h-5 text-slate-600 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $orderStats['total'] }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Total Orders</p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-2 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg">
                    <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $orderStats['pending'] }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Pending</p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                    <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $orderStats['verified'] }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Verified</p>
                </div>
            </div>
        </div>
        <div class="bg-white dark:bg-dark-elevated rounded-xl border border-slate-200 dark:border-dark-border p-4">
            <div class="flex items-center">
                <div class="flex-shrink-0 p-2 bg-red-100 dark:bg-red-900/30 rounded-lg">
                    <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $orderStats['failed'] }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Failed</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Credit Activity Chart -->
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-200 dark:border-dark-border">
                <h3 class="text-base font-semibold text-slate-900 dark:text-white">Credit Activity (30 Days)</h3>
            </div>
            <div class="p-5">
                <canvas id="creditChart" height="200"></canvas>
            </div>
        </div>

        <!-- Recent Transactions -->
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-sm border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-200 dark:border-dark-border flex items-center justify-between">
                <h3 class="text-base font-semibold text-slate-900 dark:text-white">Recent Transactions</h3>
                <a href="{{ route('app.credits.history') }}" class="text-sm text-primary-600 hover:text-primary-700 dark:text-primary-400">View all</a>
            </div>
            <div class="divide-y divide-slate-100 dark:divide-dark-border">
                @forelse($recentTransactions as $log)
                <div class="flex items-center justify-between px-5 py-3">
                    <div class="flex items-center gap-3">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center {{ $log->amount >= 0 ? 'bg-green-100 dark:bg-green-900/30' : 'bg-red-100 dark:bg-red-900/30' }}">
                            @if($log->amount >= 0)
                            <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            @else
                            <svg class="w-4 h-4 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                            </svg>
                            @endif
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-900 dark:text-white">{{ $log->description ?? $log->type->getLabel() }}</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400">{{ $log->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <span class="text-sm font-semibold {{ $log->amount >= 0 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400' }}">
                        {{ $log->amount >= 0 ? '+' : '' }}{{ number_format($log->amount, 0, ',', '.') }}
                    </span>
                </div>
                @empty
                <div class="px-5 py-8 text-center">
                    <p class="text-sm text-slate-500 dark:text-slate-400">No transactions yet</p>
                    <a href="{{ route('app.credits.index') }}" class="mt-2 inline-block text-sm text-primary-600 hover:text-primary-700 dark:text-primary-400">
                        Buy your first credits →
                    </a>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('creditChart');
    if (!ctx) return;
    
    const chartData = @json($chartData);
    const isDark = document.documentElement.classList.contains('dark');
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartData.labels,
            datasets: [
                {
                    label: 'Credits In',
                    data: chartData.credits,
                    backgroundColor: isDark ? 'rgba(34, 197, 94, 0.7)' : 'rgba(34, 197, 94, 0.8)',
                    borderRadius: 4,
                },
                {
                    label: 'Credits Out',
                    data: chartData.debits,
                    backgroundColor: isDark ? 'rgba(239, 68, 68, 0.7)' : 'rgba(239, 68, 68, 0.8)',
                    borderRadius: 4,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: isDark ? '#94a3b8' : '#64748b',
                        boxWidth: 12,
                        padding: 20,
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false,
                    },
                    ticks: {
                        color: isDark ? '#94a3b8' : '#64748b',
                        maxRotation: 45,
                        minRotation: 45,
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: isDark ? 'rgba(148, 163, 184, 0.1)' : 'rgba(148, 163, 184, 0.2)',
                    },
                    ticks: {
                        color: isDark ? '#94a3b8' : '#64748b',
                    }
                }
            }
        }
    });
});
</script>
@endpush
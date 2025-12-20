<div>
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.dashboard.title')); ?></h1>
        <select wire:model.live="period" class="text-sm rounded-lg border-slate-300 dark:border-dark-border dark:bg-dark-elevated dark:text-white focus:ring-primary-500 focus:border-primary-500">
            <option value="7"><?php echo e(__('admin.dashboard.period.last_7_days')); ?></option>
            <option value="30"><?php echo e(__('admin.dashboard.period.last_30_days')); ?></option>
            <option value="90"><?php echo e(__('admin.dashboard.period.last_90_days')); ?></option>
        </select>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
        <!-- Total Users -->
        <div class="bg-white dark:bg-dark-elevated overflow-hidden shadow-lg rounded-xl border border-slate-200 dark:border-dark-border">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-primary-100 dark:bg-primary-900/30 rounded-lg p-3">
                        <svg class="h-6 w-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400"><?php echo e(__('admin.dashboard.stats.total_users')); ?></p>
                        <p class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e(number_format($stats['total_users'])); ?></p>
                        <p class="text-xs text-green-600 dark:text-green-400"><?php echo e(__('admin.dashboard.stats.new_users', ['count' => $stats['new_users']])); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="bg-white dark:bg-dark-elevated overflow-hidden shadow-lg rounded-xl border border-slate-200 dark:border-dark-border">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 dark:bg-blue-900/30 rounded-lg p-3">
                        <svg class="h-6 w-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400"><?php echo e(__('admin.dashboard.stats.total_orders')); ?></p>
                        <p class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e(number_format($stats['total_orders'])); ?></p>
                        <p class="text-xs text-yellow-600 dark:text-yellow-400"><?php echo e(__('admin.dashboard.stats.pending_orders', ['count' => $stats['pending_orders']])); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-white dark:bg-dark-elevated overflow-hidden shadow-lg rounded-xl border border-slate-200 dark:border-dark-border">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-100 dark:bg-green-900/30 rounded-lg p-3">
                        <svg class="h-6 w-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400"><?php echo e(__('admin.dashboard.stats.total_revenue')); ?></p>
                        <p class="text-2xl font-bold text-slate-900 dark:text-white">Rp <?php echo e(number_format($stats['total_revenue'], 0, ',', '.')); ?></p>
                        <p class="text-xs text-green-600 dark:text-green-400"><?php echo e(__('admin.dashboard.stats.period_revenue', ['amount' => number_format($stats['period_revenue'], 0, ',', '.')])); ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Credits Given -->
        <div class="bg-white dark:bg-dark-elevated overflow-hidden shadow-lg rounded-xl border border-slate-200 dark:border-dark-border">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-100 dark:bg-purple-900/30 rounded-lg p-3">
                        <svg class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div class="ml-4 flex-1">
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400"><?php echo e(__('admin.dashboard.stats.credits_given')); ?></p>
                        <p class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e(number_format($stats['total_credits_given'], 0, ',', '.')); ?></p>
                        <p class="text-xs text-purple-600 dark:text-purple-400"><?php echo e(__('admin.dashboard.stats.period_credits', ['amount' => number_format($stats['period_credits'], 0, ',', '.')])); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Revenue Chart -->
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-lg border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-200 dark:border-dark-border">
                <h3 class="text-base font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.dashboard.charts.revenue_overview')); ?></h3>
            </div>
            <div class="p-5">
                <canvas id="revenueChart" height="200"></canvas>
            </div>
        </div>

        <!-- User Registration Chart -->
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-lg border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-200 dark:border-dark-border">
                <h3 class="text-base font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.dashboard.charts.new_users')); ?></h3>
            </div>
            <div class="p-5">
                <canvas id="userChart" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Order Status & Recent Activity -->
    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-3">
        <!-- Order Status Pie Chart -->
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-lg border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-200 dark:border-dark-border">
                <h3 class="text-base font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.dashboard.charts.order_status')); ?></h3>
            </div>
            <div class="p-5 flex items-center justify-center">
                <canvas id="orderStatusChart" height="200"></canvas>
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-lg border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-200 dark:border-dark-border flex items-center justify-between">
                <h3 class="text-base font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.dashboard.recent.orders')); ?></h3>
                <a href="<?php echo e(route('admin.orders.index')); ?>" class="text-sm text-primary-600 hover:text-primary-700 dark:text-primary-400"><?php echo e(__('admin.dashboard.recent.view_all')); ?></a>
            </div>
            <div class="divide-y divide-slate-100 dark:divide-dark-border">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $recentOrders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="px-5 py-3 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-900 dark:text-white"><?php echo e($order->order_number); ?></p>
                        <p class="text-xs text-slate-500 dark:text-slate-400"><?php echo e($order->user?->name ?? __('admin.dashboard.recent.guest')); ?></p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-medium text-slate-900 dark:text-white">Rp <?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></p>
                        <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium 
                            <?php if($order->status === 'verified'): ?> bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400
                            <?php elseif($order->status === 'pending'): ?> bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400
                            <?php else: ?> bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400
                            <?php endif; ?>">
                            <?php echo e($order->status->getLabel()); ?>

                        </span>
                    </div>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="px-5 py-8 text-center text-sm text-slate-500 dark:text-slate-400"><?php echo e(__('admin.dashboard.recent.no_orders')); ?></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="bg-white dark:bg-dark-elevated rounded-xl shadow-lg border border-slate-200 dark:border-dark-border overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-200 dark:border-dark-border flex items-center justify-between">
                <h3 class="text-base font-semibold text-slate-900 dark:text-white"><?php echo e(__('admin.dashboard.recent.users')); ?></h3>
                <a href="<?php echo e(route('admin.users.index')); ?>" class="text-sm text-primary-600 hover:text-primary-700 dark:text-primary-400"><?php echo e(__('admin.dashboard.recent.view_all')); ?></a>
            </div>
            <div class="divide-y divide-slate-100 dark:divide-dark-border">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $recentUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                <div class="px-5 py-3 flex items-center gap-3">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                        <span class="text-sm font-medium text-primary-600 dark:text-primary-400"><?php echo e(strtoupper(substr($user->name, 0, 1))); ?></span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-slate-900 dark:text-white truncate"><?php echo e($user->name); ?></p>
                        <p class="text-xs text-slate-500 dark:text-slate-400 truncate"><?php echo e($user->email); ?></p>
                    </div>
                    <span class="text-xs text-slate-400"><?php echo e($user->created_at->diffForHumans()); ?></span>
                </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                <div class="px-5 py-8 text-center text-sm text-slate-500 dark:text-slate-400"><?php echo e(__('admin.dashboard.recent.no_users')); ?></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const isDark = document.documentElement.classList.contains('dark');
    const textColor = isDark ? '#94a3b8' : '#64748b';
    const gridColor = isDark ? 'rgba(148, 163, 184, 0.1)' : 'rgba(148, 163, 184, 0.2)';

    // Revenue Chart
    const revenueCtx = document.getElementById('revenueChart');
    if (revenueCtx) {
        const revenueData = <?php echo json_encode($revenueChart, 15, 512) ?>;
        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: revenueData.labels,
                datasets: [{
                    label: '<?php echo e(__('admin.dashboard.charts.revenue_label')); ?>',
                    data: revenueData.data,
                    borderColor: '#22c55e',
                    backgroundColor: isDark ? 'rgba(34, 197, 94, 0.1)' : 'rgba(34, 197, 94, 0.1)',
                    fill: true,
                    tension: 0.4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { color: textColor, maxRotation: 45, minRotation: 45 } },
                    y: { beginAtZero: true, grid: { color: gridColor }, ticks: { color: textColor, callback: v => 'Rp ' + v.toLocaleString('id-ID') } }
                }
            }
        });
    }

    // User Chart
    const userCtx = document.getElementById('userChart');
    if (userCtx) {
        const userData = <?php echo json_encode($userChart, 15, 512) ?>;
        new Chart(userCtx, {
            type: 'bar',
            data: {
                labels: userData.labels,
                datasets: [{
                    label: '<?php echo e(__('admin.dashboard.charts.new_users')); ?>',
                    data: userData.data,
                    backgroundColor: isDark ? 'rgba(99, 102, 241, 0.7)' : 'rgba(99, 102, 241, 0.8)',
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { grid: { display: false }, ticks: { color: textColor, maxRotation: 45, minRotation: 45 } },
                    y: { beginAtZero: true, grid: { color: gridColor }, ticks: { color: textColor } }
                }
            }
        });
    }

    // Order Status Pie Chart
    const orderStatusCtx = document.getElementById('orderStatusChart');
    if (orderStatusCtx) {
        const statusData = <?php echo json_encode($orderStatusData, 15, 512) ?>;
        new Chart(orderStatusCtx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(statusData).map(s => s.charAt(0).toUpperCase() + s.slice(1)),
                datasets: [{
                    data: Object.values(statusData),
                    backgroundColor: ['#eab308', '#22c55e', '#ef4444', '#6b7280'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom', labels: { color: textColor, padding: 15 } }
                }
            }
        });
    }
});
</script>
<?php $__env->stopPush(); ?><?php /**PATH D:\Installed\Apps\laragon\www\starter\resources\views/admin/livewire/dashboard.blade.php ENDPATH**/ ?>
<?php

namespace App\Livewire\Admin;

use App\Models\CreditLog;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Carbon\Carbon;

class Dashboard extends Component
{
    public string $period = '30'; // days

    /**
     * Get stats cards data.
     */
    public function getStats(): array
    {
        $startDate = Carbon::now()->subDays((int) $this->period)->startOfDay();

        return [
            'total_users' => User::count(),
            'new_users' => User::where('created_at', '>=', $startDate)->count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_revenue' => Order::where('status', 'verified')->sum('total_amount'),
            'period_revenue' => Order::where('status', 'verified')
                ->where('created_at', '>=', $startDate)->sum('total_amount'),
            'total_credits_given' => CreditLog::where('amount', '>', 0)->sum('amount'),
            'period_credits' => CreditLog::where('amount', '>', 0)
                ->where('created_at', '>=', $startDate)->sum('amount'),
        ];
    }

    /**
     * Get revenue chart data.
     */
    public function getRevenueChartData(): array
    {
        $startDate = Carbon::now()->subDays((int) $this->period - 1)->startOfDay();
        
        $revenue = Order::where('status', 'verified')
            ->where('created_at', '>=', $startDate)
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(total_amount) as total')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $labels = [];
        $data = [];

        for ($i = 0; $i < (int) $this->period; $i++) {
            $date = $startDate->copy()->addDays($i);
            $dateKey = $date->format('Y-m-d');
            $labels[] = $date->format('M d');
            $data[] = (float) ($revenue[$dateKey]->total ?? 0);
        }

        return ['labels' => $labels, 'data' => $data];
    }

    /**
     * Get user registration chart data.
     */
    public function getUserChartData(): array
    {
        $startDate = Carbon::now()->subDays((int) $this->period - 1)->startOfDay();
        
        $users = User::where('created_at', '>=', $startDate)
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        $labels = [];
        $data = [];

        for ($i = 0; $i < (int) $this->period; $i++) {
            $date = $startDate->copy()->addDays($i);
            $dateKey = $date->format('Y-m-d');
            $labels[] = $date->format('M d');
            $data[] = (int) ($users[$dateKey]->count ?? 0);
        }

        return ['labels' => $labels, 'data' => $data];
    }

    /**
     * Get order status distribution.
     */
    public function getOrderStatusData(): array
    {
        return Order::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();
    }

    /**
     * Get recent orders.
     */
    public function getRecentOrders()
    {
        return Order::with('user')
            ->latest()
            ->take(5)
            ->get();
    }

    /**
     * Get recent users.
     */
    public function getRecentUsers()
    {
        return User::latest()
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('admin.livewire.dashboard', [
            'stats' => $this->getStats(),
            'revenueChart' => $this->getRevenueChartData(),
            'userChart' => $this->getUserChartData(),
            'orderStatusData' => $this->getOrderStatusData(),
            'recentOrders' => $this->getRecentOrders(),
            'recentUsers' => $this->getRecentUsers(),
        ])->layout('admin.layouts.app', ['title' => 'Dashboard']);
    }
}

<?php

namespace App\Livewire\App;

use App\Models\CreditLog;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Helpers\Toast;
use App\Helpers\Alert;
use App\Notifications\TestNotification;
use Carbon\Carbon;

class Dashboard extends Component
{
    public function mount()
    {
        if (request()->has('test-redirect-alert')) {
            Alert::success('Hello, world!');
            return redirect()->route('app.index');
        }
    }

    /**
     * Get credit chart data for the last 30 days.
     */
    public function getCreditChartData(): array
    {
        $user = Auth::user();
        $startDate = Carbon::now()->subDays(29)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        // Get credit logs grouped by date
        $logs = CreditLog::where('user_id', $user->id)
            ->where('created_at', '>=', $startDate)
            ->select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(CASE WHEN amount > 0 THEN amount ELSE 0 END) as credits'),
                DB::raw('SUM(CASE WHEN amount < 0 THEN ABS(amount) ELSE 0 END) as debits')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');

        // Build chart data for all 30 days
        $labels = [];
        $credits = [];
        $debits = [];

        for ($i = 0; $i < 30; $i++) {
            $date = $startDate->copy()->addDays($i);
            $dateKey = $date->format('Y-m-d');
            $labels[] = $date->format('M d');
            $credits[] = (float) ($logs[$dateKey]->credits ?? 0);
            $debits[] = (float) ($logs[$dateKey]->debits ?? 0);
        }

        return [
            'labels' => $labels,
            'credits' => $credits,
            'debits' => $debits,
        ];
    }

    /**
     * Get order statistics.
     */
    public function getOrderStats(): array
    {
        $user = Auth::user();

        return [
            'total' => Order::where('user_id', $user->id)->count(),
            'pending' => Order::where('user_id', $user->id)->where('status', 'pending')->count(),
            'verified' => Order::where('user_id', $user->id)->where('status', 'verified')->count(),
            'failed' => Order::where('user_id', $user->id)->where('status', 'failed')->count(),
        ];
    }

    /**
     * Get recent transactions.
     */
    public function getRecentTransactions()
    {
        $user = Auth::user();

        return CreditLog::where('user_id', $user->id)
            ->with('reference')
            ->latest()
            ->take(5)
            ->get();
    }

    public function showToast()
    {
        Toast::success('Hello, world! ');
    }
    
    public function testNotification()
    {
        $user = Auth::user();
        $user->notify(new TestNotification());
        Toast::success('Notification sent!');
    }

    public function render()
    {
        $user = Auth::user();

        return view('livewire.app.dashboard', [
            'user' => $user,
            'creditBalance' => $user->credit ?? 0,
            'chartData' => $this->getCreditChartData(),
            'orderStats' => $this->getOrderStats(),
            'recentTransactions' => $this->getRecentTransactions(),
        ])->title('Dashboard');
    }
}
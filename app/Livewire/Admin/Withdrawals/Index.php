<?php

namespace App\Livewire\Admin\Withdrawals;

use App\Helpers\Toast;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function approve(int $withdrawalId): void
    {
        $withdrawal = Withdrawal::findOrFail($withdrawalId);
        $withdrawal->markAsCompleted(Auth::id(), 'Approved');
        Toast::success('Withdrawal approved successfully.');
    }

    public function reject(int $withdrawalId, string $reason = ''): void
    {
        $withdrawal = Withdrawal::findOrFail($withdrawalId);
        
        // Restore commissions when rejecting
        $user = $withdrawal->user;
        $remaining = (float) $withdrawal->amount;
        
        $commissions = $user->referralCommissions()
            ->where('status', 'withdrawn')
            ->orderByDesc('created_at')
            ->get();

        foreach ($commissions as $commission) {
            if ($remaining <= 0) break;
            $commission->update(['status' => 'available']);
            $remaining -= (float) $commission->amount;
        }

        $withdrawal->markAsRejected(Auth::id(), $reason ?: 'Rejected by admin');
        Toast::success('Withdrawal rejected.');
    }

    public function markAsProcessing(int $withdrawalId): void
    {
        $withdrawal = Withdrawal::findOrFail($withdrawalId);
        $withdrawal->markAsProcessing();
        Toast::success('Withdrawal marked as processing.');
    }

    public function render()
    {
        $withdrawals = Withdrawal::query()
            ->with(['user', 'paymentMethod', 'processedByUser'])
            ->when($this->search, function ($q) {
                $q->whereHas('user', fn($query) => $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%"));
            })
            ->when($this->statusFilter, fn($q) => $q->where('status', $this->statusFilter))
            ->orderByDesc('created_at')
            ->paginate(15);

        $stats = [
            'pending' => Withdrawal::pending()->sum('amount'),
            'processing' => Withdrawal::processing()->sum('amount'),
            'completed' => Withdrawal::completed()->sum('amount'),
        ];

        return view('admin.livewire.withdrawals.index', [
            'withdrawals' => $withdrawals,
            'stats' => $stats,
            'statuses' => ['pending', 'processing', 'completed', 'rejected'],
        ])->layout('admin.layouts.app', ['title' => 'Withdrawals']);
    }
}

<?php

namespace App\Livewire\Admin\Referrals;

use App\Helpers\Toast;
use App\Models\ReferralCommission;
use Livewire\Component;
use Livewire\WithPagination;

class Commissions extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function updateStatus(int $commissionId, string $status): void
    {
        $commission = ReferralCommission::findOrFail($commissionId);
        $commission->update(['status' => $status]);
        Toast::success('Commission status updated.');
    }

    public function render()
    {
        $commissions = ReferralCommission::query()
            ->with(['user', 'referredUser', 'commissionable'])
            ->when($this->search, function ($q) {
                $q->whereHas('user', fn($query) => $query->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%"));
            })
            ->when($this->statusFilter, fn($q) => $q->where('status', $this->statusFilter))
            ->orderByDesc('created_at')
            ->paginate(15);

        $stats = [
            'total' => ReferralCommission::sum('amount'),
            'pending' => ReferralCommission::pending()->sum('amount'),
            'available' => ReferralCommission::available()->sum('amount'),
        ];

        return view('admin.livewire.referrals.commissions', [
            'commissions' => $commissions,
            'stats' => $stats,
            'statuses' => ['pending', 'available', 'withdrawn', 'expired', 'canceled'],
        ])->layout('admin.layouts.app', ['title' => 'Referral Commissions']);
    }
}

<?php

namespace App\Livewire\App\Referral;

use App\Models\ReferralCommission;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function copyReferralLink(): void
    {
        $this->dispatch('copy-to-clipboard', url: Auth::user()->referral_url);
    }

    public function render()
    {
        $user = Auth::user();

        // Statistics
        $stats = [
            'total_referrals' => $user->referrals()->count(),
            'total_earnings' => $user->total_earnings,
            'available_commission' => $user->available_commission,
            'pending_commission' => $user->pending_commission,
            'withdrawn_commission' => $user->withdrawn_commission,
        ];

        // Referred users
        $referrals = $user->referrals()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%"))
            ->orderByDesc('created_at')
            ->paginate(10);

        // Recent commissions
        $commissions = $user->referralCommissions()
            ->with(['referredUser', 'commissionable'])
            ->orderByDesc('created_at')
            ->take(10)
            ->get();

        return view('livewire.app.referral.index', [
            'stats' => $stats,
            'referrals' => $referrals,
            'commissions' => $commissions,
            'referralUrl' => $user->referral_url,
            'referralCode' => $user->referral_code,
        ])->layout('layouts.app', ['title' => 'Referral Program']);
    }
}

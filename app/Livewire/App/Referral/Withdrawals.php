<?php

namespace App\Livewire\App\Referral;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Withdrawals extends Component
{
    use WithPagination;

    #[On('refreshWithdrawals')]
    public function refreshWithdrawals(): void
    {
        // This will trigger a re-render
    }

    public function render()
    {
        $user = Auth::user();

        $withdrawals = $user->withdrawals()
            ->with('paymentMethod')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('livewire.app.referral.withdrawals', [
            'withdrawals' => $withdrawals,
            'availableCommission' => $user->available_commission,
        ])->layout('layouts.app', ['title' => __('referral.user.withdrawals.title')]);
    }
}

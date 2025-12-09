<?php

namespace App\Livewire\Admin\Referrals;

use App\Models\User;
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

    public function render()
    {
        $referrals = User::query()
            ->whereNotNull('referrer_id')
            ->with('referrer')
            ->when($this->search, function ($q) {
                $q->where(function ($query) {
                    $query->where('name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%");
                });
            })
            ->orderByDesc('created_at')
            ->paginate(15);

        $stats = [
            'total_referrals' => User::whereNotNull('referrer_id')->count(),
            'total_referrers' => User::whereHas('referrals')->count(),
        ];

        return view('admin.livewire.referrals.index', [
            'referrals' => $referrals,
            'stats' => $stats,
        ])->layout('admin.layouts.app', ['title' => 'Referral Users']);
    }
}

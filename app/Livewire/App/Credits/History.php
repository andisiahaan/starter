<?php

namespace App\Livewire\App\Credits;

use App\Models\CreditLog;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class History extends Component
{
    use WithPagination;

    public string $typeFilter = '';

    public array $types = [
        'PURCHASE' => 'Purchase',
        'BROADCAST_FEE' => 'Broadcast Fee',
        'ADMIN_ADJUSTMENT' => 'Admin Adjustment',
        'REFUND' => 'Refund',
    ];

    public function updatingTypeFilter(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $user = Auth::user();

        $logs = CreditLog::query()
            ->where('user_id', $user->id)
            ->when($this->typeFilter, fn($q) => $q->where('type', $this->typeFilter))
            ->latest()
            ->paginate(15);

        return view('livewire.app.credits.history', [
            'user' => $user,
            'logs' => $logs,
        ])
            ->layout('layouts.app')
            ->title(__('credits.credit_logs.title'));
    }
}

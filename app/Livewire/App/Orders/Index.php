<?php

namespace App\Livewire\App\Orders;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $statusFilter = '';
    public bool $showDetailModal = false;
    public ?Order $selectedOrder = null;

    public array $statuses = [
        'pending' => 'Pending',
        'verified' => 'Verified',
        'failed' => 'Failed',
        'cancelled' => 'Cancelled',
    ];

    public array $statusColors = [
        'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
        'verified' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
        'failed' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
        'cancelled' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200',
    ];

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    public function showDetail(int $id): void
    {
        $this->selectedOrder = Order::query()
            ->where('user_id', Auth::id())
            ->with(['product', 'paymentMethod'])
            ->findOrFail($id);
        $this->showDetailModal = true;
    }

    public function closeModal(): void
    {
        $this->showDetailModal = false;
        $this->selectedOrder = null;
    }

    public function render()
    {
        $orders = Order::query()
            ->where('user_id', Auth::id())
            ->with(['product', 'paymentMethod'])
            ->when($this->statusFilter, fn($q) => $q->where('status', $this->statusFilter))
            ->latest()
            ->paginate(10);

        return view('livewire.app.orders.index', [
            'orders' => $orders,
        ])
            ->layout('layouts.app')
            ->title(__('My Orders'));
    }
}

<?php

namespace App\Livewire\Admin\Orders;

use App\Models\Order;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';
    public string $dateFrom = '';
    public string $dateTo = '';

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

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingStatusFilter(): void
    {
        $this->resetPage();
    }

    /**
     * Export orders to CSV.
     */
    public function exportCsv(): StreamedResponse
    {
        $orders = $this->getOrdersQuery()->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="orders_export_' . date('Y-m-d_His') . '.csv"',
        ];

        return response()->stream(function () use ($orders) {
            $file = fopen('php://output', 'w');
            
            // Header row
            fputcsv($file, ['Order Number', 'User', 'Email', 'Product', 'Credits', 'Subtotal', 'Fee', 'Total', 'Payment Method', 'Status', 'Created At', 'Verified At']);
            
            // Data rows
            foreach ($orders as $order) {
                fputcsv($file, [
                    $order->order_number,
                    $order->user?->name ?? 'N/A',
                    $order->user?->email ?? 'N/A',
                    $order->product_name,
                    $order->credit_amount,
                    $order->subtotal,
                    $order->fee_amount,
                    $order->total_amount,
                    $order->paymentMethod?->name ?? $order->payment_method_code ?? 'N/A',
                    $order->status,
                    $order->created_at->format('Y-m-d H:i:s'),
                    $order->verified_at?->format('Y-m-d H:i:s') ?? '',
                ]);
            }
            
            fclose($file);
        }, 200, $headers);
    }

    /**
     * Get the base orders query.
     */
    protected function getOrdersQuery()
    {
        return Order::query()
            ->with(['user', 'product', 'paymentMethod'])
            ->when($this->search, fn($q) => $q->where('order_number', 'like', "%{$this->search}%")
                ->orWhereHas('user', fn($uq) => $uq->where('name', 'like', "%{$this->search}%")
                    ->orWhere('email', 'like', "%{$this->search}%")))
            ->when($this->statusFilter, fn($q) => $q->where('status', $this->statusFilter))
            ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo, fn($q) => $q->whereDate('created_at', '<=', $this->dateTo))
            ->latest();
    }

    #[On('refreshOrders')]
    public function refreshOrders(): void
    {
        // This will trigger a re-render
    }

    public function render()
    {
        $orders = $this->getOrdersQuery()->paginate(15);

        return view('admin.livewire.orders.index', [
            'orders' => $orders,
        ])->layout('admin.layouts.app', ['title' => 'Orders']);
    }
}

<?php

namespace App\Livewire\Admin\CreditLogs;

use App\Enums\CreditLogType;
use App\Models\CreditLog;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $typeFilter = '';
    public string $userFilter = '';
    public string $dateFrom = '';
    public string $dateTo = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingTypeFilter(): void
    {
        $this->resetPage();
    }

    public function updatingUserFilter(): void
    {
        $this->resetPage();
    }

    /**
     * Export credit logs to CSV.
     */
    public function exportCsv(): StreamedResponse
    {
        $logs = $this->getLogsQuery()->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="credit_logs_export_' . date('Y-m-d_His') . '.csv"',
        ];

        return response()->stream(function () use ($logs) {
            $file = fopen('php://output', 'w');
            
            // Header row
            fputcsv($file, ['ID', 'User', 'Email', 'Type', 'Amount', 'Balance Before', 'Balance After', 'Description', 'Created At']);
            
            // Data rows
            foreach ($logs as $log) {
                fputcsv($file, [
                    $log->id,
                    $log->user?->name ?? 'N/A',
                    $log->user?->email ?? 'N/A',
                    $log->type->getLabel(),
                    $log->amount,
                    $log->balance_before,
                    $log->balance_after,
                    $log->description ?? '',
                    $log->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            
            fclose($file);
        }, 200, $headers);
    }

    /**
     * Get the base logs query.
     */
    protected function getLogsQuery()
    {
        return CreditLog::query()
            ->with('user')
            ->when($this->search, fn($q) => $q->whereHas('user', fn($uq) => $uq->where('name', 'like', "%{$this->search}%")
                ->orWhere('email', 'like', "%{$this->search}%")))
            ->when($this->typeFilter, fn($q) => $q->where('type', $this->typeFilter))
            ->when($this->userFilter, fn($q) => $q->where('user_id', $this->userFilter))
            ->when($this->dateFrom, fn($q) => $q->whereDate('created_at', '>=', $this->dateFrom))
            ->when($this->dateTo, fn($q) => $q->whereDate('created_at', '<=', $this->dateTo))
            ->latest();
    }

    #[On('refreshCreditLogs')]
    public function refreshCreditLogs(): void
    {
        // Refresh is handled automatically by Livewire
    }

    public function render()
    {
        $logs = $this->getLogsQuery()->paginate(20);
        $users = User::select('id', 'name', 'email')->orderBy('name')->get();

        return view('admin.livewire.credit-logs.index', [
            'logs' => $logs,
            'users' => $users,
            'types' => CreditLogType::toArray(),
        ])->layout('admin.layouts.app', ['title' => 'Credit Logs']);
    }
}

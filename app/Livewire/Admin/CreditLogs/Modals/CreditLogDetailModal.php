<?php

namespace App\Livewire\Admin\CreditLogs\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Models\CreditLog;

class CreditLogDetailModal extends ModalComponent
{
    public ?int $logId = null;
    public ?CreditLog $log = null;

    public function mount(int $logId): void
    {
        $this->logId = $logId;
        $this->log = CreditLog::with(['user', 'reference'])->findOrFail($logId);
    }

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }

    public function render()
    {
        return view('admin.livewire.credit-logs.modals.credit-log-detail-modal');
    }
}

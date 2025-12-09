<?php

namespace App\Livewire\App\Account\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use Illuminate\Support\Facades\Auth;

/**
 * Modal for showing recovery codes.
 */
class ShowRecoveryCodesModal extends ModalComponent
{
    public array $recoveryCodes = [];

    public function mount(): void
    {
        $this->recoveryCodes = Auth::user()->two_factor_recovery_codes ?? [];
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render()
    {
        return view('livewire.app.account.modals.show-recovery-codes-modal');
    }
}

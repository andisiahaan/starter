<?php

namespace App\Livewire\App\Account\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Services\TwoFactorService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Modal for disabling Two-Factor Authentication.
 */
class DisableTwoFactorModal extends ModalComponent
{
    public string $password = '';

    public function disable(): void
    {
        $this->validate([
            'password' => ['required'],
        ]);

        $user = Auth::user();

        if (!Hash::check($this->password, $user->password)) {
            $this->addError('password', __('The provided password is incorrect.'));
            return;
        }

        $service = new TwoFactorService();
        $service->disable($user);

        $this->dispatch('two-factor-disabled');
        session()->flash('success', __('Two-factor authentication has been disabled.'));
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }

    public function render()
    {
        return view('livewire.app.account.modals.disable-two-factor-modal');
    }
}

<?php

namespace App\Livewire\App\Account;

use App\Services\TwoFactorService;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

/**
 * Two-Factor Authentication management component.
 */
class TwoFactorAuth extends Component
{
    // Methods for opening modals are handled directly in the view via $dispatch
    // to strictly follow the package implementation and reduce roundtrips.

    public function regenerateRecoveryCodes(): void
    {
        $user = Auth::user();
        $service = new TwoFactorService();
        $service->regenerateRecoveryCodes($user);

        session()->flash('success', __('Recovery codes regenerated successfully.'));
        $this->dispatch('openModal', 'app.account.modals.show-recovery-codes-modal');
    }

    public function render()
    {
        return view('livewire.app.account.two-factor-auth', [
            'user' => Auth::user(),
            'enabled' => Auth::user()->hasTwoFactorEnabled(),
            'recoveryCodesCount' => count(Auth::user()->two_factor_recovery_codes ?? []),
        ]);
    }
}

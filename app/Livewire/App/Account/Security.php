<?php

namespace App\Livewire\App\Account;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

/**
 * Security settings component (password change, email change).
 */
class Security extends Component
{
    // Password change
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function changePassword(): void
    {
        $minLength = setting('auth.min_password_length', 8);
        $isStrong = setting('auth.is_strong_password_required', false);

        $passwordRule = Password::min($minLength);
        if ($isStrong) {
            $passwordRule = $passwordRule->mixedCase()->numbers()->symbols();
        }

        $this->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', $passwordRule],
        ]);

        $user = Auth::user();
        $user->password = Hash::make($this->password);
        $user->save();

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->log('Changed password');

        $this->reset(['current_password', 'password', 'password_confirmation']);
        session()->flash('success', __('Password changed successfully.'));
    }

    public function openEmailChangeModal(): void
    {
        $this->dispatch('openModal', component: 'app.account.modals.change-email-modal');
    }

    public function render()
    {
        return view('livewire.app.account.security', [
            'user' => Auth::user(),
        ]);
    }
}

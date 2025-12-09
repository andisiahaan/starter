<?php

namespace App\Livewire\App\Account\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Models\PendingEmailChange;
use App\Notifications\VerifyEmailChange;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Modal for changing email address.
 */
class ChangeEmailModal extends ModalComponent
{
    public string $new_email = '';
    public string $password = '';
    public bool $emailSent = false;

    public function changeEmail(): void
    {
        $this->validate([
            'new_email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
        ]);

        $user = Auth::user();

        if (!Hash::check($this->password, $user->password)) {
            $this->addError('password', __('The provided password is incorrect.'));
            return;
        }

        // Delete any existing pending changes
        $user->pendingEmailChanges()->delete();

        // Create new pending change
        $pendingChange = PendingEmailChange::create([
            'user_id' => $user->id,
            'new_email' => $this->new_email,
            'token' => Str::random(64),
            'expires_at' => now()->addHours(24),
        ]);

        // Send verification email to NEW email address (not user's current email)
        \Illuminate\Support\Facades\Notification::route('mail', $this->new_email)
            ->notify(new VerifyEmailChange($pendingChange));

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->withProperties(['new_email' => $this->new_email])
            ->log('Requested email change');

        $this->emailSent = true;
    }

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }

    public function render()
    {
        return view('livewire.app.account.modals.change-email-modal');
    }
}

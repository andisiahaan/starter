<?php

namespace App\Livewire\App\Account;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

/**
 * Profile editing component.
 */
class Profile extends Component
{
    public string $name = '';

    public function mount(): void
    {
        $this->name = Auth::user()->name;
    }

    public function updateProfile(): void
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user = Auth::user();
        $user->name = $this->name;
        $user->save();

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->log('Updated profile name');

        $this->dispatch('profile-updated');
        session()->flash('success', __('Profile updated successfully.'));
    }

    public function render()
    {
        return view('livewire.app.account.profile');
    }
}

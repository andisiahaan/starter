<?php

namespace App\Livewire\Admin\Users\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use App\Models\User;

class DeleteUserModal extends ModalComponent
{
    public ?int $userId = null;
    public ?User $user = null;

    public function mount(int $userId): void
    {
        $this->userId = $userId;
        $this->user = User::findOrFail($userId);
    }

    public function delete(): void
    {
        if (!$this->user) {
            return;
        }

        if ($this->user->id === auth()->id()) {
            Toast::error('You cannot delete your own account.');
            $this->closeModal();
            return;
        }

        $this->user->delete();
        Toast::success('User deleted successfully.');

        $this->dispatch('refreshUsers');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render()
    {
        return view('admin.livewire.users.modals.delete-user-modal');
    }
}

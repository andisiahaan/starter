<?php

namespace App\Livewire\Admin\Users\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use App\Models\User;

class BanUserModal extends ModalComponent
{
    public ?int $userId = null;
    public ?User $user = null;
    public string $banReason = '';

    public function mount(int $userId): void
    {
        $this->userId = $userId;
        $this->user = User::findOrFail($userId);
    }

    public function ban(): void
    {
        if (!$this->user) {
            return;
        }

        if ($this->user->id === auth()->id()) {
            Toast::error('You cannot ban your own account.');
            $this->closeModal();
            return;
        }

        $this->user->ban($this->banReason, auth()->id());
        Toast::success('User has been banned.');

        $this->dispatch('refreshUsers');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render()
    {
        return view('admin.livewire.users.modals.ban-user-modal');
    }
}

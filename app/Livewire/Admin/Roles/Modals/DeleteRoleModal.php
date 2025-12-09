<?php

namespace App\Livewire\Admin\Roles\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use Spatie\Permission\Models\Role;

class DeleteRoleModal extends ModalComponent
{
    public ?int $roleId = null;
    public ?Role $role = null;

    public function mount(int $roleId): void
    {
        $this->roleId = $roleId;
        $this->role = Role::findOrFail($roleId);
    }

    public function delete(): void
    {
        if (!$this->role) {
            return;
        }

        if ($this->role->name === 'superadmin') {
            Toast::error('Cannot delete the superadmin role.');
            $this->closeModal();
            return;
        }

        $this->role->delete();
        Toast::success('Role deleted successfully.');

        $this->dispatch('refreshRoles');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render()
    {
        return view('admin.livewire.roles.modals.delete-role-modal');
    }
}

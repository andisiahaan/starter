<?php

namespace App\Livewire\Admin\Permissions\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use Spatie\Permission\Models\Permission;

class DeletePermissionModal extends ModalComponent
{
    public ?int $permissionId = null;
    public ?Permission $permission = null;

    public function mount(int $permissionId): void
    {
        $this->permissionId = $permissionId;
        $this->permission = Permission::withCount('roles')->findOrFail($permissionId);
    }

    public function delete(): void
    {
        if (!$this->permission) {
            return;
        }

        $this->permission->delete();
        Toast::success('Permission deleted successfully.');

        $this->dispatch('refreshPermissions');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render()
    {
        return view('admin.livewire.permissions.modals.delete-permission-modal');
    }
}

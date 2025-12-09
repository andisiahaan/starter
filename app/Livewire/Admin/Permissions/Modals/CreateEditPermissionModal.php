<?php

namespace App\Livewire\Admin\Permissions\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateEditPermissionModal extends ModalComponent
{
    public ?int $permissionId = null;
    public string $name = '';
    public string $guard_name = 'web';
    public array $selectedRoles = [];

    public function mount(?int $permissionId = null): void
    {
        $this->permissionId = $permissionId;

        if ($permissionId) {
            $permission = Permission::with('roles')->findOrFail($permissionId);
            $this->name = $permission->name;
            $this->guard_name = $permission->guard_name;
            $this->selectedRoles = $permission->roles->pluck('name')->toArray();
        }
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'guard_name' => 'required|string|max:255',
            'selectedRoles' => 'array',
        ]);

        if ($this->permissionId) {
            $permission = Permission::findOrFail($this->permissionId);
            $permission->update([
                'name' => $this->name,
                'guard_name' => $this->guard_name,
            ]);
            Toast::success('Permission updated successfully.');
        } else {
            $permission = Permission::create([
                'name' => $this->name,
                'guard_name' => $this->guard_name,
            ]);
            Toast::success('Permission created successfully.');
        }

        $permission->syncRoles($this->selectedRoles);

        $this->dispatch('refreshPermissions');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }

    public function render()
    {
        return view('admin.livewire.permissions.modals.create-edit-permission-modal', [
            'roles' => Role::orderBy('name')->get(),
        ]);
    }
}

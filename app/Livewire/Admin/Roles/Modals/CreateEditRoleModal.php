<?php

namespace App\Livewire\Admin\Roles\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CreateEditRoleModal extends ModalComponent
{
    public ?int $roleId = null;
    public string $name = '';
    public string $guard_name = 'web';
    public array $selectedPermissions = [];

    public function mount(?int $roleId = null): void
    {
        $this->roleId = $roleId;

        if ($roleId) {
            $role = Role::with('permissions')->findOrFail($roleId);
            $this->name = $role->name;
            $this->guard_name = $role->guard_name;
            $this->selectedPermissions = $role->permissions->pluck('name')->toArray();
        }
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'guard_name' => 'required|string|max:255',
            'selectedPermissions' => 'array',
        ]);

        if ($this->roleId) {
            $role = Role::findOrFail($this->roleId);
            $role->update([
                'name' => $this->name,
                'guard_name' => $this->guard_name,
            ]);
            Toast::success('Role updated successfully.');
        } else {
            $role = Role::create([
                'name' => $this->name,
                'guard_name' => $this->guard_name,
            ]);
            Toast::success('Role created successfully.');
        }

        $role->syncPermissions($this->selectedPermissions);

        $this->dispatch('refreshRoles');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }

    public function render()
    {
        return view('admin.livewire.roles.modals.create-edit-role-modal', [
            'permissions' => Permission::orderBy('name')->get(),
        ]);
    }
}

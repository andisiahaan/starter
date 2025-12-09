<?php

namespace App\Livewire\Admin\Permissions;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('refreshPermissions')]
    public function refreshPermissions(): void
    {
        // This will trigger a re-render
    }

    public function render()
    {
        $permissions = Permission::withCount('roles')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->paginate(15);

        return view('admin.livewire.permissions.index', [
            'permissions' => $permissions,
        ])->layout('admin.layouts.app', ['title' => 'Manage Permissions']);
    }
}

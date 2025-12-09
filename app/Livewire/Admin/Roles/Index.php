<?php

namespace App\Livewire\Admin\Roles;

use App\Helpers\Toast;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('refreshRoles')]
    public function refreshRoles(): void
    {
        // This will trigger a re-render
    }

    public function render()
    {
        $roles = Role::withCount('users', 'permissions')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->paginate(10);

        return view('admin.livewire.roles.index', [
            'roles' => $roles,
        ])->layout('admin.layouts.app', ['title' => 'Manage Roles']);
    }
}

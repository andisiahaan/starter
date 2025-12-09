<?php

namespace App\Livewire\Admin\Users;

use App\Helpers\Toast;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $roleFilter = '';
    public string $statusFilter = '';
    
    // Bulk actions
    public array $selected = [];
    public bool $selectAll = false;

    protected $queryString = ['search', 'roleFilter', 'statusFilter'];

    public function updatingSearch()
    {
        $this->resetPage();
        $this->selected = [];
        $this->selectAll = false;
    }

    public function updatingRoleFilter()
    {
        $this->resetPage();
        $this->selected = [];
        $this->selectAll = false;
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
        $this->selected = [];
        $this->selectAll = false;
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selected = $this->getUsersQuery()->pluck('id')->map(fn($id) => (string) $id)->toArray();
        } else {
            $this->selected = [];
        }
    }

    public function unbanUser(int $userId)
    {
        $user = User::findOrFail($userId);
        $user->unban();
        Toast::success('User has been unbanned.');
    }

    /**
     * Bulk ban selected users.
     */
    public function bulkBan()
    {
        if (empty($this->selected)) {
            Toast::error('No users selected.');
            return;
        }

        $count = User::whereIn('id', $this->selected)
            ->whereNull('banned_at')
            ->update(['banned_at' => now()]);

        $this->selected = [];
        $this->selectAll = false;
        
        Toast::success("{$count} users have been banned.");
    }

    /**
     * Bulk unban selected users.
     */
    public function bulkUnban()
    {
        if (empty($this->selected)) {
            Toast::error('No users selected.');
            return;
        }

        $count = User::whereIn('id', $this->selected)
            ->whereNotNull('banned_at')
            ->update(['banned_at' => null, 'banned_reason' => null]);

        $this->selected = [];
        $this->selectAll = false;
        
        Toast::success("{$count} users have been unbanned.");
    }

    /**
     * Export users to CSV.
     */
    public function exportCsv(): StreamedResponse
    {
        $users = $this->getUsersQuery()->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="users_export_' . date('Y-m-d_His') . '.csv"',
        ];

        return response()->stream(function () use ($users) {
            $file = fopen('php://output', 'w');
            
            // Header row
            fputcsv($file, ['ID', 'Name', 'Email', 'Phone', 'Role', 'Credit', 'Status', 'Registered At']);
            
            // Data rows
            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->phone ?? '',
                    $user->roles->pluck('name')->implode(', '),
                    $user->credit ?? 0,
                    $user->banned_at ? 'Banned' : 'Active',
                    $user->created_at->format('Y-m-d H:i:s'),
                ]);
            }
            
            fclose($file);
        }, 200, $headers);
    }

    /**
     * Get the base users query.
     */
    protected function getUsersQuery()
    {
        return User::with('roles')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->roleFilter, function ($query) {
                $query->whereHas('roles', function ($q) {
                    $q->where('name', $this->roleFilter);
                });
            })
            ->when($this->statusFilter === 'banned', fn($q) => $q->whereNotNull('banned_at'))
            ->when($this->statusFilter === 'active', fn($q) => $q->whereNull('banned_at'))
            ->orderBy('created_at', 'desc');
    }

    #[On('refreshUsers')]
    public function refreshUsers(): void
    {
        // This will trigger a re-render
    }

    public function render()
    {
        $users = $this->getUsersQuery()->paginate(10);

        return view('admin.livewire.users.index', [
            'users' => $users,
            'roles' => Role::all(),
        ])->layout('admin.layouts.app', ['title' => 'Manage Users']);
    }
}

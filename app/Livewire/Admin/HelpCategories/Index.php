<?php

namespace App\Livewire\Admin\HelpCategories;

use App\Helpers\Toast;
use App\Models\HelpCategory;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $status = '';

    protected $queryString = ['search', 'status'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    #[On('refreshCategories')]
    public function refreshCategories()
    {
        // This will trigger a re-render
    }

    public function toggleActive(int $id)
    {
        $category = HelpCategory::findOrFail($id);
        $category->update(['is_active' => !$category->is_active]);
        Toast::success(__('help.admin.categories.messages.updated'));
    }

    public function delete(int $id)
    {
        $category = HelpCategory::findOrFail($id);
        $category->delete();
        Toast::success(__('help.admin.categories.messages.deleted'));
    }

    public function render()
    {
        $categories = HelpCategory::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->when($this->status !== '', fn($q) => $q->where('is_active', $this->status === 'active'))
            ->withCount('articles')
            ->orderBy('order_column')
            ->paginate(15);

        return view('admin.livewire.help-categories.index', [
            'categories' => $categories,
        ])->layout('admin.layouts.app', [
            'title' => __('help.admin.categories.title'),
            ]);
    }
}

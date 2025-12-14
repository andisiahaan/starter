<?php

namespace App\Livewire\Admin\Blog\Categories;

use App\Helpers\Toast;
use App\Models\BlogCategory;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('refreshCategories')]
    public function refreshCategories()
    {
        // This will trigger a re-render
    }

    public function delete(int $id)
    {
        $category = BlogCategory::findOrFail($id);
        
        if ($category->posts()->count() > 0) {
            Toast::error('Cannot delete category with posts. Remove posts first.');
            return;
        }
        
        $category->delete();
        Toast::success('Category deleted successfully.');
    }

    public function render()
    {
        $categories = BlogCategory::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->withCount('posts')
            ->orderBy('order')
            ->paginate(15);

        return view('admin.livewire.blog.categories.index', [
            'categories' => $categories,
        ])->layout('admin.layouts.app')->title(__('blog.categories.title'));
    }
}

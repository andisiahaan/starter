<?php

namespace App\Livewire\Admin\ProductCategories;

use App\Models\ProductCategory;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function delete(int $id): void
    {
        ProductCategory::findOrFail($id)->delete();
        session()->flash('success', 'Category deleted successfully.');
    }

    public function toggleActive(int $id): void
    {
        $category = ProductCategory::findOrFail($id);
        $category->update(['is_active' => !$category->is_active]);
    }

    #[On('refreshCategories')]
    public function refreshCategories(): void
    {
        // This will trigger a re-render
    }

    public function render()
    {
        $categories = ProductCategory::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->latest()
            ->paginate(10);

        return view('admin.livewire.product-categories.index', [
            'categories' => $categories,
        ])->layout('admin.layouts.app', ['title' => 'Product Categories']);
    }
}

<?php

namespace App\Livewire\Admin\Pages;

use App\Helpers\Toast;
use App\Models\Page;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function togglePublish(int $pageId)
    {
        $page = Page::findOrFail($pageId);
        $page->update(['is_published' => !$page->is_published]);
        Toast::success($page->is_published ? 'Page published.' : 'Page unpublished.');
    }

    #[On('refreshPages')]
    public function refreshPages(): void
    {
        // This will trigger a re-render
    }

    public function render()
    {
        $pages = Page::when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
                ->orWhere('slug', 'like', '%' . $this->search . '%');
        })
            ->orderBy('order')
            ->orderBy('title')
            ->paginate(10);

        return view('admin.livewire.pages.index', [
            'pages' => $pages,
        ])->layout('admin.layouts.app', ['title' => 'Manage Pages']);
    }
}

<?php

namespace App\Livewire\Admin\News;

use App\Helpers\Toast;
use App\Models\News;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $typeFilter = '';

    protected $queryString = ['search', 'typeFilter'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function togglePin(int $newsId)
    {
        $news = News::findOrFail($newsId);
        $news->update(['is_pinned' => !$news->is_pinned]);
    }

    #[On('refreshNews')]
    public function refreshNews(): void
    {
        // This will trigger a re-render
    }

    public function render()
    {
        $news = News::with('author')
            ->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->when($this->typeFilter, fn($q) => $q->where('type', $this->typeFilter))
            ->orderByDesc('is_pinned')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.livewire.news.index', [
            'newsList' => $news,
            'types' => News::types(),
        ])->layout('admin.layouts.app', ['title' => 'Manage News']);
    }
}

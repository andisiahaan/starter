<?php

namespace App\Livewire\Admin\HelpArticles;

use App\Helpers\Toast;
use App\Models\HelpArticle;
use App\Models\HelpCategory;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $category = '';
    public string $status = '';

    protected $queryString = ['search', 'category', 'status'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingStatus()
    {
        $this->resetPage();
    }

    public function toggleActive(int $id)
    {
        $article = HelpArticle::findOrFail($id);
        $article->update(['is_active' => !$article->is_active]);
        Toast::success(__('help.admin.articles.messages.updated'));
    }

    public function delete(int $id)
    {
        HelpArticle::findOrFail($id)->delete();
        Toast::success(__('help.admin.articles.messages.deleted'));
    }

    public function render()
    {
        $articles = HelpArticle::query()
            ->with('category')
            ->when($this->search, fn($q) => $q->where('title', 'like', "%{$this->search}%"))
            ->when($this->category, fn($q) => $q->where('help_category_id', $this->category))
            ->when($this->status === 'published', fn($q) => $q->published())
            ->when($this->status === 'draft', fn($q) => $q->where(function($qq) {
                $qq->where('is_active', false)
                    ->orWhereNull('published_at')
                    ->orWhere('published_at', '>', now());
            }))
            ->orderByDesc('created_at')
            ->paginate(15);

        $categories = HelpCategory::active()->ordered()->get();

        return view('admin.livewire.help-articles.index', [
            'articles' => $articles,
            'categories' => $categories,
        ])->layout('admin.layouts.app', [
            'title' => __('help.admin.articles.title'),
            ]);
    }
}

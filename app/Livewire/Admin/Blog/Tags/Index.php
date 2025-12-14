<?php

namespace App\Livewire\Admin\Blog\Tags;

use App\Helpers\Toast;
use App\Models\BlogTag;
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

    #[On('refreshTags')]
    public function refreshTags()
    {
        // This will trigger a re-render
    }

    public function delete(int $id)
    {
        BlogTag::findOrFail($id)->delete();
        Toast::success('Tag deleted successfully.');
    }

    public function render()
    {
        $tags = BlogTag::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->withCount('posts')
            ->orderBy('name')
            ->paginate(15);

        return view('admin.livewire.blog.tags.index', [
            'tags' => $tags,
        ])->layout('admin.layouts.app')->title(__('blog.tags.title'));
    }
}

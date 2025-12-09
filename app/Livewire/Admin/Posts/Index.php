<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $statusFilter = '';

    protected $queryString = ['search', 'statusFilter'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function togglePublish(int $postId)
    {
        $post = Post::findOrFail($postId);
        $post->update([
            'is_published' => !$post->is_published,
            'published_at' => !$post->is_published ? now() : $post->published_at,
        ]);
    }

    #[On('refreshPosts')]
    public function refreshPosts(): void
    {
        // This will trigger a re-render
    }

    public function render()
    {
        $posts = Post::with('author')
            ->when($this->search, fn($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->when($this->statusFilter === 'published', fn($q) => $q->where('is_published', true))
            ->when($this->statusFilter === 'draft', fn($q) => $q->where('is_published', false))
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.livewire.posts.index', [
            'posts' => $posts,
        ])->layout('admin.layouts.app', ['title' => 'Manage Posts']);
    }
}

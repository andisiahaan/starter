<?php

namespace App\Livewire\Admin\Blog\Posts;

use App\Models\BlogPost;
use Livewire\Component;
use Livewire\WithPagination;

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

    public function delete(int $id)
    {
        BlogPost::findOrFail($id)->delete();
        session()->flash('success', 'Post deleted successfully.');
    }

    public function render()
    {
        $posts = BlogPost::query()
            ->with(['author', 'categories'])
            ->when($this->search, fn($q) => $q->where('title', 'like', "%{$this->search}%"))
            ->when($this->status, fn($q) => $q->where('status', $this->status))
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.livewire.blog.posts.index', [
            'posts' => $posts,
        ])->layout('admin.layouts.app')->title(__('blog.posts.title'));
    }
}

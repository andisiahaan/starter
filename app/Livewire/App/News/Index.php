<?php

namespace App\Livewire\App\News;

use App\Models\News;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $typeFilter = '';

    public function render()
    {
        $news = News::published()
            ->when($this->typeFilter, fn($q) => $q->where('type', $this->typeFilter))
            ->orderByDesc('is_pinned')
            ->orderByDesc('published_at')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('livewire.app.news.index', [
            'newsList' => $news,
            'types' => News::types(),
        ])->layout('layouts.app', ['title' => 'News & Announcements']);
    }
}

<?php

namespace App\Livewire\App\News;

use App\Models\News;
use Livewire\Component;

class Show extends Component
{
    public News $news;

    public function mount(News $news)
    {
        if (!$news->isActive()) {
            abort(404);
        }
        $this->news = $news;
    }

    public function render()
    {
        return view('livewire.app.news.show')
            ->layout('layouts.app', ['title' => $this->news->title]);
    }
}

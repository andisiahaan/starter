<?php

namespace App\Livewire\Admin\News\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use App\Models\News;
use Illuminate\Support\Str;

class CreateEditNewsModal extends ModalComponent
{
    public ?int $newsId = null;
    public string $title = '';
    public string $slug = '';
    public string $content = '';
    public string $type = 'info';
    public bool $is_published = false;
    public bool $is_pinned = false;
    public ?string $published_at = null;
    public ?string $expires_at = null;

    public function mount(?int $newsId = null): void
    {
        $this->newsId = $newsId;

        if ($newsId) {
            $news = News::findOrFail($newsId);
            $this->title = $news->title;
            $this->slug = $news->slug;
            $this->content = $news->content;
            $this->type = $news->type;
            $this->is_published = $news->is_published;
            $this->is_pinned = $news->is_pinned;
            $this->published_at = $news->published_at?->format('Y-m-d\TH:i');
            $this->expires_at = $news->expires_at?->format('Y-m-d\TH:i');
        }
    }

    public function save(): void
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:news,slug,' . $this->newsId,
            'content' => 'required|string',
            'type' => 'required|in:info,warning,maintenance,update',
            'published_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:published_at',
        ]);

        $data = [
            'title' => $this->title,
            'slug' => $this->slug ?: Str::slug($this->title),
            'content' => $this->content,
            'type' => $this->type,
            'is_published' => $this->is_published,
            'is_pinned' => $this->is_pinned,
            'published_at' => $this->published_at ?: null,
            'expires_at' => $this->expires_at ?: null,
            'author_id' => auth()->id(),
        ];

        if ($this->newsId) {
            News::findOrFail($this->newsId)->update($data);
            Toast::success('News updated successfully.');
        } else {
            News::create($data);
            Toast::success('News created successfully.');
        }

        $this->dispatch('refreshNews');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function render()
    {
        return view('admin.livewire.news.modals.create-edit-news-modal', [
            'types' => News::types(),
        ]);
    }
}

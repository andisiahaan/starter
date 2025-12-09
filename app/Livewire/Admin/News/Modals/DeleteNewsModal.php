<?php

namespace App\Livewire\Admin\News\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use App\Models\News;

class DeleteNewsModal extends ModalComponent
{
    public ?int $newsId = null;
    public ?News $news = null;

    public function mount(int $newsId): void
    {
        $this->newsId = $newsId;
        $this->news = News::findOrFail($newsId);
    }

    public function delete(): void
    {
        if (!$this->news) {
            return;
        }

        $this->news->delete();
        Toast::success('News deleted successfully.');

        $this->dispatch('refreshNews');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render()
    {
        return view('admin.livewire.news.modals.delete-news-modal');
    }
}

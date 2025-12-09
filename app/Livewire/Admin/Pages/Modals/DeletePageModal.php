<?php

namespace App\Livewire\Admin\Pages\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use App\Models\Page;

class DeletePageModal extends ModalComponent
{
    public ?int $pageId = null;
    public ?Page $page = null;

    public function mount(int $pageId): void
    {
        $this->pageId = $pageId;
        $this->page = Page::findOrFail($pageId);
    }

    public function delete(): void
    {
        if (!$this->page) {
            return;
        }

        $this->page->delete();
        Toast::success('Page deleted successfully.');

        $this->dispatch('refreshPages');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render()
    {
        return view('admin.livewire.pages.modals.delete-page-modal');
    }
}

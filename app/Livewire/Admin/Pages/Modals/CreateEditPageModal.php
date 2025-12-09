<?php

namespace App\Livewire\Admin\Pages\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use App\Models\Page;

class CreateEditPageModal extends ModalComponent
{
    public ?int $pageId = null;
    public string $title = '';
    public string $slug = '';
    public string $content = '';
    public string $meta_title = '';
    public string $meta_description = '';
    public bool $is_published = false;
    public string $layout = 'default';
    public int $order = 0;

    public function mount(?int $pageId = null): void
    {
        $this->pageId = $pageId;

        if ($pageId) {
            $page = Page::findOrFail($pageId);
            $this->title = $page->title;
            $this->slug = $page->slug;
            $this->content = $page->content ?? '';
            $this->meta_title = $page->meta_title ?? '';
            $this->meta_description = $page->meta_description ?? '';
            $this->is_published = $page->is_published;
            $this->layout = $page->layout;
            $this->order = $page->order;
        }
    }

    public function save(): void
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug,' . $this->pageId,
            'content' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'layout' => 'required|string|in:default,full-width,sidebar',
            'order' => 'required|integer|min:0',
        ]);

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'is_published' => $this->is_published,
            'layout' => $this->layout,
            'order' => $this->order,
        ];

        if ($this->pageId) {
            Page::findOrFail($this->pageId)->update($data);
            Toast::success('Page updated successfully.');
        } else {
            Page::create($data);
            Toast::success('Page created successfully.');
        }

        $this->dispatch('refreshPages');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function render()
    {
        return view('admin.livewire.pages.modals.create-edit-page-modal');
    }
}

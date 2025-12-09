<?php

namespace App\Livewire\Admin\ProductCategories\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class CreateEditCategoryModal extends ModalComponent
{
    public ?int $categoryId = null;
    public string $name = '';
    public string $slug = '';
    public string $description = '';
    public bool $is_active = true;

    public function mount(?int $categoryId = null): void
    {
        $this->categoryId = $categoryId;

        if ($categoryId) {
            $category = ProductCategory::findOrFail($categoryId);
            $this->name = $category->name;
            $this->slug = $category->slug;
            $this->description = $category->description ?? '';
            $this->is_active = $category->is_active;
        }
    }

    public function updatedName($value): void
    {
        if (!$this->categoryId) {
            $this->slug = Str::slug($value);
        }
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:product_categories,slug,' . $this->categoryId,
            'description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
        ];
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description ?: null,
            'is_active' => $this->is_active,
        ];

        if ($this->categoryId) {
            ProductCategory::find($this->categoryId)->update($data);
            Toast::success('Category updated successfully.');
        } else {
            ProductCategory::create($data);
            Toast::success('Category created successfully.');
        }

        $this->dispatch('refreshCategories');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render()
    {
        return view('admin.livewire.product-categories.modals.create-edit-category-modal');
    }
}

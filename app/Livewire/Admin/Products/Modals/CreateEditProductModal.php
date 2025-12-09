<?php

namespace App\Livewire\Admin\Products\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use App\Models\Product;
use App\Models\ProductCategory;

class CreateEditProductModal extends ModalComponent
{
    public ?int $productId = null;
    public string $name = '';
    public string $description = '';
    public ?int $category_id = null;
    public string $price = '';
    public string $credit_amount = '';
    public string $bonus_credit = '0';
    public bool $is_active = true;

    public function mount(?int $productId = null): void
    {
        $this->productId = $productId;

        if ($productId) {
            $product = Product::findOrFail($productId);
            $this->name = $product->name;
            $this->description = $product->description ?? '';
            $this->category_id = $product->category_id;
            $this->price = (string) $product->price;
            $this->credit_amount = (string) ($product->credit_amount ?? '');
            $this->bonus_credit = (string) ($product->bonus_credit ?? '0');
            $this->is_active = $product->is_active;
        }
    }

    protected function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'nullable|exists:product_categories,id',
            'price' => 'required|numeric|min:0',
            'credit_amount' => 'nullable|numeric|min:0',
            'bonus_credit' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
        ];
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description ?: null,
            'category_id' => $this->category_id ?: null,
            'price' => $this->price,
            'credit_amount' => $this->credit_amount ?: null,
            'bonus_credit' => $this->bonus_credit ?: 0,
            'is_active' => $this->is_active,
        ];

        if ($this->productId) {
            Product::find($this->productId)->update($data);
            Toast::success('Product updated successfully.');
        } else {
            Product::create($data);
            Toast::success('Product created successfully.');
        }

        $this->dispatch('refreshProducts');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }

    public function render()
    {
        return view('admin.livewire.products.modals.create-edit-product-modal', [
            'categories' => ProductCategory::active()->get(),
        ]);
    }
}

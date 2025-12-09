<?php

namespace App\Livewire\Admin\PaymentMethods;

use App\Models\PaymentMethod;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public string $typeFilter = '';
    public string $providerFilter = '';

    public array $types = [
        'bank' => 'Bank Transfer',
        'e_wallet' => 'E-Wallet',
        'card' => 'Credit/Debit Card',
        'other' => 'Other',
    ];

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingTypeFilter(): void
    {
        $this->resetPage();
    }

    public function updatingProviderFilter(): void
    {
        $this->resetPage();
    }

    public function toggleActive(int $id): void
    {
        $method = PaymentMethod::findOrFail($id);
        $method->update(['is_active' => !$method->is_active]);
    }

    public function delete(int $id): void
    {
        PaymentMethod::findOrFail($id)->delete();
        session()->flash('success', 'Payment method deleted successfully.');
    }

    #[On('refreshPaymentMethods')]
    public function refreshPaymentMethods(): void
    {
        // This will trigger a re-render
    }

    public function render()
    {
        $methods = PaymentMethod::query()
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")
                ->orWhere('code', 'like', "%{$this->search}%"))
            ->when($this->typeFilter, fn($q) => $q->where('type', $this->typeFilter))
            ->when($this->providerFilter, fn($q) => $q->where('provider', $this->providerFilter))
            ->latest()
            ->paginate(10);

        return view('admin.livewire.payment-methods.index', [
            'methods' => $methods,
            'providers' => PaymentMethod::$providers,
        ])->layout('admin.layouts.app', ['title' => 'Payment Methods']);
    }
}

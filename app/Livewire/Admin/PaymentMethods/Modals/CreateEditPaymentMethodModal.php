<?php

namespace App\Livewire\Admin\PaymentMethods\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use App\Models\PaymentMethod;

class CreateEditPaymentMethodModal extends ModalComponent
{
    public ?int $paymentMethodId = null;
    public string $code = '';
    public string $provider = 'MANUAL';
    public string $name = '';
    public string $type = 'bank';
    public string $flow = 'both';
    public string $description = '';
    public string $min_amount = '';
    public string $max_amount = '';
    public string $fee_flat = '0';
    public string $fee_percent = '0';
    public bool $is_active = true;

    public array $types = [
        'bank' => 'Bank Transfer',
        'e_wallet' => 'E-Wallet',
        'card' => 'Credit/Debit Card',
        'other' => 'Other',
    ];

    public array $flows = [
        'deposit' => 'Deposit Only',
        'withdraw' => 'Withdraw Only',
        'both' => 'Both (Deposit & Withdraw)',
    ];

    public function mount(?int $paymentMethodId = null): void
    {
        $this->paymentMethodId = $paymentMethodId;

        if ($paymentMethodId) {
            $method = PaymentMethod::findOrFail($paymentMethodId);
            $this->code = $method->code;
            $this->provider = $method->provider ?? 'MANUAL';
            $this->name = $method->name;
            $this->type = $method->type;
            $this->flow = $method->flow ?? 'both';
            $this->description = $method->description ?? '';
            $this->min_amount = (string) ($method->min_amount ?? '');
            $this->max_amount = (string) ($method->max_amount ?? '');
            $this->fee_flat = (string) ($method->fee_flat ?? '0');
            $this->fee_percent = (string) ($method->fee_percent ?? '0');
            $this->is_active = $method->is_active;
        }
    }

    protected function rules(): array
    {
        return [
            'code' => 'required|string|max:50|unique:payment_methods,code,' . $this->paymentMethodId,
            'provider' => 'required|in:TRIPAY,MANUAL',
            'name' => 'required|string|max:255',
            'type' => 'required|in:bank,e_wallet,card,other',
            'flow' => 'required|in:deposit,withdraw,both',
            'description' => 'nullable|string',
            'min_amount' => 'nullable|numeric|min:0',
            'max_amount' => 'nullable|numeric|min:0',
            'fee_flat' => 'nullable|numeric|min:0',
            'fee_percent' => 'nullable|numeric|min:0|max:100',
            'is_active' => 'boolean',
        ];
    }

    public function save(): void
    {
        $this->validate();

        $data = [
            'code' => strtoupper($this->code),
            'provider' => $this->provider,
            'name' => $this->name,
            'type' => $this->type,
            'flow' => $this->flow,
            'description' => $this->description ?: null,
            'min_amount' => $this->min_amount ?: null,
            'max_amount' => $this->max_amount ?: null,
            'fee_flat' => $this->fee_flat ?: 0,
            'fee_percent' => $this->fee_percent ?: 0,
            'is_active' => $this->is_active,
        ];

        if ($this->paymentMethodId) {
            PaymentMethod::find($this->paymentMethodId)->update($data);
            Toast::success('Payment method updated successfully.');
        } else {
            PaymentMethod::create($data);
            Toast::success('Payment method created successfully.');
        }

        $this->dispatch('refreshPaymentMethods');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }

    public function render()
    {
        return view('admin.livewire.payment-methods.modals.create-edit-payment-method-modal', [
            'providers' => PaymentMethod::$providers,
        ]);
    }
}

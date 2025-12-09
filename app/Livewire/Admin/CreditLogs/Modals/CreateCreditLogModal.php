<?php

namespace App\Livewire\Admin\CreditLogs\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Enums\CreditLogType;
use App\Helpers\Toast;
use App\Models\User;

class CreateCreditLogModal extends ModalComponent
{
    public ?int $userId = null;
    public string $userSearch = '';
    public array $userResults = [];
    public ?User $selectedUser = null;
    
    public float $amount = 0;
    public string $type = '';
    public string $description = '';

    protected function rules(): array
    {
        return [
            'userId' => 'required|exists:users,id',
            'amount' => 'required|numeric|not_in:0',
            'type' => 'required|in:' . implode(',', array_column(CreditLogType::getAdminCreatableTypes(), 'value')),
            'description' => 'nullable|string|max:500',
        ];
    }

    protected function messages(): array
    {
        return [
            'userId.required' => 'Silakan pilih user terlebih dahulu.',
            'amount.required' => 'Amount harus diisi.',
            'amount.not_in' => 'Amount tidak boleh 0.',
            'type.required' => 'Tipe transaksi harus dipilih.',
        ];
    }

    public function updatedUserSearch(): void
    {
        if (strlen($this->userSearch) >= 2) {
            $this->userResults = User::where(function ($query) {
                $query->where('name', 'like', "%{$this->userSearch}%")
                    ->orWhere('email', 'like', "%{$this->userSearch}%");
            })
            ->take(10)
            ->get(['id', 'name', 'email', 'credit'])
            ->toArray();
        } else {
            $this->userResults = [];
        }
    }

    public function selectUser(int $userId): void
    {
        $this->selectedUser = User::find($userId);
        if ($this->selectedUser) {
            $this->userId = $userId;
            $this->userSearch = '';
            $this->userResults = [];
        }
    }

    public function clearSelectedUser(): void
    {
        $this->selectedUser = null;
        $this->userId = null;
        $this->userSearch = '';
    }

    public function save(): void
    {
        $this->validate();

        $user = User::findOrFail($this->userId);
        $type = CreditLogType::from($this->type);
        $absoluteAmount = abs($this->amount);
        
        $description = $this->description ?: $type->getLabel() . ' oleh admin';

        try {
            if ($this->amount > 0) {
                // Adding credit
                $user->addCredit($absoluteAmount, $type, $description);
                Toast::success("Berhasil menambahkan " . number_format($absoluteAmount, 2) . " credit ke {$user->name}.");
            } else {
                // Deducting credit
                $result = $user->deductCredit($absoluteAmount, $type, $description);
                
                if ($result === null) {
                    Toast::error("Gagal: Credit {$user->name} tidak mencukupi.");
                    return;
                }
                
                Toast::success("Berhasil mengurangi " . number_format($absoluteAmount, 2) . " credit dari {$user->name}.");
            }

            $this->dispatch('refreshCreditLogs');
            $this->closeModal();
        } catch (\Exception $e) {
            Toast::error('Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }

    public function render()
    {
        return view('admin.livewire.credit-logs.modals.create-credit-log-modal', [
            'availableTypes' => CreditLogType::getAdminCreatableTypes(),
        ]);
    }
}

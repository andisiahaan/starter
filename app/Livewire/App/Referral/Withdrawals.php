<?php

namespace App\Livewire\App\Referral;

use App\Helpers\Toast;
use App\Models\PaymentMethod;
use App\Models\Withdrawal;
use App\Services\ReferralService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Withdrawals extends Component
{
    use WithPagination;

    public bool $showRequestModal = false;
    public ?int $paymentMethodId = null;
    public float $amount = 0;
    public string $bankName = '';
    public string $accountNumber = '';
    public string $accountHolder = '';

    public function openRequestModal(): void
    {
        $this->reset(['paymentMethodId', 'amount', 'bankName', 'accountNumber', 'accountHolder']);
        $this->showRequestModal = true;
    }

    public function closeRequestModal(): void
    {
        $this->showRequestModal = false;
    }

    public function requestWithdrawal(ReferralService $referralService): void
    {
        $user = Auth::user();

        $this->validate([
            'paymentMethodId' => ['nullable', 'exists:payment_methods,id'],
            'amount' => ['required', 'numeric', 'min:10000', 'max:' . $user->available_commission],
            'bankName' => ['required', 'string', 'max:100'],
            'accountNumber' => ['required', 'string', 'max:50'],
            'accountHolder' => ['required', 'string', 'max:100'],
        ], [
            'amount.min' => 'Minimum withdrawal is Rp 10,000',
            'amount.max' => 'Maximum withdrawal is your available commission',
        ]);

        if (!$user->hasEnoughCommission($this->amount)) {
            Toast::error('Insufficient available commission.');
            return;
        }

        DB::transaction(function () use ($user, $referralService) {
            // Create withdrawal request
            Withdrawal::create([
                'user_id' => $user->id,
                'payment_method_id' => $this->paymentMethodId,
                'amount' => $this->amount,
                'account_details' => [
                    'bank_name' => $this->bankName,
                    'account_number' => $this->accountNumber,
                    'account_holder' => $this->accountHolder,
                ],
                'status' => Withdrawal::STATUS_PENDING,
            ]);

            // Mark commissions as withdrawn
            $referralService->markCommissionsAsWithdrawn($user, $this->amount);
        });

        Toast::success('Withdrawal request submitted successfully!');
        $this->closeRequestModal();
    }

    public function render()
    {
        $user = Auth::user();

        $withdrawals = $user->withdrawals()
            ->with('paymentMethod')
            ->orderByDesc('created_at')
            ->paginate(10);

        $paymentMethods = PaymentMethod::active()->forWithdraw()->get();

        return view('livewire.app.referral.withdrawals', [
            'withdrawals' => $withdrawals,
            'paymentMethods' => $paymentMethods,
            'availableCommission' => $user->available_commission,
        ])->layout('layouts.app', ['title' => 'Withdrawal History']);
    }
}

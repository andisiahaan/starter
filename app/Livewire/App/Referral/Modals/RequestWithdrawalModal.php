<?php

namespace App\Livewire\App\Referral\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\Withdrawal;
use App\Services\ReferralService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RequestWithdrawalModal extends ModalComponent
{
    public ?int $paymentMethodId = null;
    public ?PaymentMethod $selectedPaymentMethod = null;
    public float $amount = 0;
    public string $bankName = '';
    public string $accountNumber = '';
    public string $accountHolder = '';
    public string $password = '';
    public string $otp = '';
    public bool $otpSent = false;
    public int $otpCooldown = 0;

    public function mount(): void
    {
        // Check if withdrawal is enabled
        if (!setting('referral.is_withdraw_enabled', true)) {
            Toast::error(__('referral.user.withdrawals.error.disabled'));
            $this->closeModal();
            return;
        }
    }

    public function updatedPaymentMethodId($value): void
    {
        if ($value) {
            $this->selectedPaymentMethod = PaymentMethod::find($value);
        } else {
            $this->selectedPaymentMethod = null;
        }
    }

    /**
     * Get the effective minimum amount based on settings and selected payment method.
     */
    public function getMinAmountProperty(): float
    {
        $settingMin = (float) setting('referral.min_withdrawal', 10000);
        
        if ($this->selectedPaymentMethod && $this->selectedPaymentMethod->min_amount) {
            return max($settingMin, (float) $this->selectedPaymentMethod->min_amount);
        }

        return $settingMin;
    }

    /**
     * Get the effective maximum amount based on settings, available balance and selected payment method.
     */
    public function getMaxAmountProperty(): float
    {
        $user = Auth::user();
        $availableBalance = (float) $user->available_commission;
        
        // Start with available balance as max
        $max = $availableBalance;

        // Apply setting max_withdrawal if set (0 = unlimited)
        $settingMax = (float) setting('referral.max_withdrawal', 0);
        if ($settingMax > 0) {
            $max = min($max, $settingMax);
        }

        // Apply payment method max if set
        if ($this->selectedPaymentMethod && $this->selectedPaymentMethod->max_amount) {
            $max = min($max, (float) $this->selectedPaymentMethod->max_amount);
        }

        return $max;
    }

    /**
     * Check if OTP is on cooldown.
     */
    public function getOtpOnCooldownProperty(): bool
    {
        $user = Auth::user();
        return Cache::has('withdrawal_otp_cooldown_' . $user->id);
    }

    /**
     * Get remaining cooldown seconds.
     */
    public function getRemainingCooldownProperty(): int
    {
        $user = Auth::user();
        $cooldownEnd = Cache::get('withdrawal_otp_cooldown_' . $user->id);
        
        if ($cooldownEnd) {
            return max(0, $cooldownEnd - now()->timestamp);
        }
        
        return 0;
    }

    /**
     * Send OTP to user's email.
     */
    public function sendOtp(): void
    {
        $user = Auth::user();

        // Check cooldown
        if ($this->otpOnCooldown) {
            Toast::error(__('referral.user.withdrawals.otp.cooldown', ['seconds' => $this->remainingCooldown]));
            return;
        }

        // Generate 6-digit OTP
        $otpCode = str_pad((string) random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        // Store OTP in cache for 10 minutes
        Cache::put('withdrawal_otp_' . $user->id, $otpCode, now()->addMinutes(10));

        // Set cooldown for 60 seconds
        Cache::put('withdrawal_otp_cooldown_' . $user->id, now()->addSeconds(60)->timestamp, now()->addSeconds(60));

        // Send OTP via reusable notification
        $user->notify(new \App\Notifications\OtpNotification(
            otp: $otpCode,
            purpose: 'withdrawal',
            context: [
                __('referral.user.withdrawals.modal.amount') => 'Rp ' . number_format($this->amount, 0, ',', '.'),
            ]
        ));

        $this->otpSent = true;
        Toast::success(__('referral.user.withdrawals.otp.sent'));
    }

    protected function rules(): array
    {
        $rules = [
            'paymentMethodId' => ['required', 'exists:payment_methods,id'],
            'amount' => ['required', 'numeric', 'min:' . $this->minAmount, 'max:' . $this->maxAmount],
            'bankName' => ['nullable', 'string', 'max:100'],
            'accountNumber' => ['required', 'string', 'max:50'],
            'accountHolder' => ['required', 'string', 'max:100'],
        ];

        // Add password rule if required
        if (setting('referral.is_withdraw_require_password', false)) {
            $rules['password'] = ['required', 'string'];
        }

        // Add OTP rule if required
        if (setting('referral.is_withdraw_require_otp', true)) {
            $rules['otp'] = ['required', 'string', 'size:6'];
        }

        return $rules;
    }

    protected function messages(): array
    {
        return [
            'paymentMethodId.required' => __('referral.user.withdrawals.validation.payment_method_required'),
            'amount.min' => __('referral.user.withdrawals.validation.min', ['amount' => 'Rp ' . number_format($this->minAmount, 0, ',', '.')]),
            'amount.max' => __('referral.user.withdrawals.validation.max', ['amount' => 'Rp ' . number_format($this->maxAmount, 0, ',', '.')]),
            'accountNumber.required' => __('referral.user.withdrawals.validation.account_number_required'),
            'accountHolder.required' => __('referral.user.withdrawals.validation.account_holder_required'),
            'password.required' => __('referral.user.withdrawals.validation.password_required'),
            'otp.required' => __('referral.user.withdrawals.validation.otp_required'),
            'otp.size' => __('referral.user.withdrawals.validation.otp_invalid'),
        ];
    }

    public function requestWithdrawal(): void
    {
        /** @var User $user */
        $user = Auth::user();

        $this->validate();

        // Verify password if required
        if (setting('referral.is_withdraw_require_password', false)) {
            if (!Hash::check($this->password, $user->password)) {
                $this->addError('password', __('referral.user.withdrawals.validation.password_incorrect'));
                return;
            }
        }

        // Verify OTP if required
        if (setting('referral.is_withdraw_require_otp', true)) {
            $cachedOtp = Cache::get('withdrawal_otp_' . $user->id);
            
            if (!$cachedOtp || $cachedOtp !== $this->otp) {
                $this->addError('otp', __('referral.user.withdrawals.validation.otp_incorrect'));
                return;
            }

            // Clear OTP after successful verification
            Cache::forget('withdrawal_otp_' . $user->id);
        }

        if (!$user->hasEnoughCommission($this->amount)) {
            Toast::error(__('referral.user.withdrawals.error.insufficient'));
            return;
        }

        DB::transaction(function () use ($user) {
            // Deduct from referral balance first
            $balanceLog = $user->deductReferralBalance(
                amount: $this->amount,
                type: \App\Enums\ReferralBalanceLogType::WITHDRAWAL_PENDING,
                description: __('referral.balance_log.withdrawal_pending'),
            );

            if (!$balanceLog) {
                throw new \Exception('Insufficient referral balance');
            }

            // Create withdrawal request
            $withdrawal = Withdrawal::create([
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

            // Link balance log to withdrawal
            $balanceLog->update([
                'reference_type' => Withdrawal::class,
                'reference_id' => $withdrawal->id,
            ]);

            // Send notifications (mandatory, no individual settings check)
            // Notify the user
            $user->notify(new \App\Notifications\Withdrawals\WithdrawalCreatedNotification($withdrawal));

            // Notify all admins
            $admins = \App\Models\User::role(['admin', 'superadmin'])->get();
            foreach ($admins as $admin) {
                $admin->notify(new \App\Notifications\Admin\AdminWithdrawalCreatedNotification($withdrawal));
            }
        });

        Toast::success(__('referral.user.withdrawals.success'));
        $this->dispatch('refreshWithdrawals');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }

    public function render()
    {
        $user = Auth::user();
        $paymentMethods = PaymentMethod::active()->forWithdraw()->get();

        return view('livewire.app.referral.modals.request-withdrawal-modal', [
            'paymentMethods' => $paymentMethods,
            'availableCommission' => $user->available_commission,
            'requirePassword' => setting('referral.is_withdraw_require_password', false),
            'requireOtp' => setting('referral.is_withdraw_require_otp', true),
        ]);
    }
}

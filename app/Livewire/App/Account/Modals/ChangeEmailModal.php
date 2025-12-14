<?php

namespace App\Livewire\App\Account\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Models\Otp;
use App\Models\PendingEmailChange;
use App\Notifications\OtpNotification;
use App\Notifications\VerifyEmailChange;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Modal for changing email address.
 * Flow: 
 * 1. Enter new email + password
 * 2. Send OTP to OLD email (with 60s cooldown)
 * 3. Enter OTP code
 * 4. Submit - sends verification link to NEW email
 */
class ChangeEmailModal extends ModalComponent
{
    public string $new_email = '';
    public string $password = '';
    public string $otp = '';
    public bool $otpSent = false;
    public int $otpCooldown = 0;
    public bool $emailSent = false;

    protected const OTP_PURPOSE = 'email_change';

    public function mount(): void
    {
        $this->checkCooldown();
    }

    /**
     * Check if user is still in cooldown period.
     */
    protected function checkCooldown(): void
    {
        $user = Auth::user();
        
        $this->otpCooldown = Otp::cooldownSeconds($user, self::OTP_PURPOSE);
        
        if ($this->otpCooldown > 0) {
            $this->otpSent = true;
            // Get the pending OTP to prefill email
            $latestOtp = Otp::getLatest($user, self::OTP_PURPOSE);
            if ($latestOtp) {
                $this->new_email = $latestOtp->identifier ?? '';
            }
        }
    }

    /**
     * Send OTP to old email.
     */
    public function sendOtp(): void
    {
        $this->validate([
            'new_email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
        ]);

        $user = Auth::user();

        // Verify password first
        if (!Hash::check($this->password, $user->password)) {
            $this->addError('password', __('account.security.password_incorrect'));
            return;
        }

        // Check cooldown
        $cooldown = Otp::cooldownSeconds($user, self::OTP_PURPOSE);
        if ($cooldown > 0) {
            $this->otpCooldown = $cooldown;
            return;
        }

        // Generate OTP using generic model
        $otp = Otp::generate($user, self::OTP_PURPOSE, $this->new_email);

        // Send OTP to OLD email
        $user->notify(new OtpNotification(
            $otp->code,
            'email_change',
            ['new_email' => $this->new_email]
        ));

        $this->otpSent = true;
        $this->otpCooldown = 60;

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->withProperties(['new_email' => $this->new_email])
            ->log('Email change OTP sent to old email');
    }

    /**
     * Verify OTP and send verification link to new email.
     */
    public function changeEmail(): void
    {
        $this->validate([
            'new_email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required'],
            'otp' => ['required', 'string', 'size:6'],
        ]);

        $user = Auth::user();

        // Verify password
        if (!Hash::check($this->password, $user->password)) {
            $this->addError('password', __('account.security.password_incorrect'));
            return;
        }

        // Verify OTP using generic model
        $verifiedOtp = Otp::verify($user, self::OTP_PURPOSE, $this->otp);

        if (!$verifiedOtp) {
            $this->addError('otp', __('account.modals.change_email.otp_invalid'));
            return;
        }

        // Check if OTP identifier matches the email
        if ($verifiedOtp->identifier !== $this->new_email) {
            $this->addError('new_email', __('account.modals.change_email.email_mismatch'));
            return;
        }

        // Delete any existing pending changes
        $user->pendingEmailChanges()->delete();

        // Create new pending change with token for email verification
        $pendingChange = PendingEmailChange::create([
            'user_id' => $user->id,
            'new_email' => $this->new_email,
            'token' => Str::random(64),
            'expires_at' => now()->addHours(24),
        ]);

        // Send verification email to NEW email address
        \Illuminate\Support\Facades\Notification::route('mail', $this->new_email)
            ->notify(new VerifyEmailChange($pendingChange));

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->withProperties(['new_email' => $this->new_email])
            ->log('Requested email change (OTP verified)');

        $this->emailSent = true;
    }

    public static function modalMaxWidth(): string
    {
        return 'sm';
    }

    public function render()
    {
        return view('livewire.app.account.modals.change-email-modal');
    }
}

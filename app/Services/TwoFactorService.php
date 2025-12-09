<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Str;
use PragmaRX\Google2FA\Google2FA;

class TwoFactorService
{
    protected Google2FA $google2fa;

    public function __construct()
    {
        $this->google2fa = new Google2FA();
    }

    /**
     * Generate a new 2FA secret key.
     */
    public function generateSecretKey(): string
    {
        return $this->google2fa->generateSecretKey();
    }

    /**
     * Get the QR code URL for the authenticator app.
     */
    public function getQRCodeUrl(User $user, string $secret): string
    {
        $companyName = setting('main.name', config('app.name'));

        return $this->google2fa->getQRCodeUrl(
            $companyName,
            $user->email,
            $secret
        );
    }

    /**
     * Verify a TOTP code.
     */
    public function verify(string $secret, string $code): bool
    {
        return $this->google2fa->verifyKey($secret, $code);
    }

    /**
     * Generate recovery codes.
     */
    public function generateRecoveryCodes(int $count = 8): array
    {
        $codes = [];

        for ($i = 0; $i < $count; $i++) {
            $codes[] = Str::random(4) . '-' . Str::random(4) . '-' . Str::random(4);
        }

        return $codes;
    }

    /**
     * Verify and consume a recovery code.
     */
    public function verifyRecoveryCode(User $user, string $code): bool
    {
        $recoveryCodes = $user->two_factor_recovery_codes ?? [];

        if (!is_array($recoveryCodes)) {
            return false;
        }

        // Normalize the code (remove dashes and uppercase)
        $normalizedCode = str_replace('-', '', strtoupper($code));

        foreach ($recoveryCodes as $index => $recoveryCode) {
            $normalizedRecoveryCode = str_replace('-', '', strtoupper($recoveryCode));

            if (hash_equals($normalizedRecoveryCode, $normalizedCode)) {
                // Remove the used code
                unset($recoveryCodes[$index]);
                $user->two_factor_recovery_codes = array_values($recoveryCodes);
                $user->save();

                return true;
            }
        }

        return false;
    }

    /**
     * Enable 2FA for a user.
     */
    public function enable(User $user, string $secret): array
    {
        $recoveryCodes = $this->generateRecoveryCodes();

        $user->forceFill([
            'two_factor_secret' => $secret,
            'two_factor_recovery_codes' => $recoveryCodes,
            'two_factor_confirmed_at' => now(),
        ])->save();

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->log('Enabled two-factor authentication');

        return $recoveryCodes;
    }

    /**
     * Disable 2FA for a user.
     */
    public function disable(User $user): void
    {
        $user->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ])->save();

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->log('Disabled two-factor authentication');
    }

    /**
     * Regenerate recovery codes for a user.
     */
    public function regenerateRecoveryCodes(User $user): array
    {
        $recoveryCodes = $this->generateRecoveryCodes();

        $user->forceFill([
            'two_factor_recovery_codes' => $recoveryCodes,
        ])->save();

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->log('Regenerated two-factor recovery codes');

        return $recoveryCodes;
    }
}

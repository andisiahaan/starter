<?php

namespace App\Livewire\App\Account;

use App\Helpers\Toast;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use PragmaRX\Google2FA\Google2FA;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class TwoFactor extends Component
{
    public bool $showEnableModal = false;
    public bool $showDisableModal = false;
    public bool $showRecoveryCodes = false;

    public string $confirmationCode = '';
    public string $password = '';
    public ?string $qrCodeSvg = null;
    public ?string $secretKey = null;
    public array $recoveryCodes = [];

    public function enableTwoFactor()
    {
        $this->resetErrorBag();

        $google2fa = new Google2FA();
        $this->secretKey = $google2fa->generateSecretKey();

        // Generate QR Code
        $qrCodeUrl = $google2fa->getQRCodeUrl(
            config('app.name'),
            Auth::user()->email,
            $this->secretKey
        );

        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);
        $this->qrCodeSvg = $writer->writeString($qrCodeUrl);

        $this->showEnableModal = true;
    }

    public function confirmEnableTwoFactor()
    {
        $this->validate([
            'confirmationCode' => 'required|string|size:6',
        ]);

        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($this->secretKey, $this->confirmationCode);

        if (!$valid) {
            $this->addError('confirmationCode', 'The provided code is invalid.');
            return;
        }

        // Generate recovery codes
        $this->recoveryCodes = $this->generateRecoveryCodes();

        $user = Auth::user();
        $user->update([
            'two_factor_secret' => $this->secretKey,
            'two_factor_confirmed_at' => now(),
            'two_factor_recovery_codes' => $this->recoveryCodes,
        ]);

        $this->showEnableModal = false;
        $this->showRecoveryCodes = true;
        $this->confirmationCode = '';

        Toast::success('Two-factor authentication has been enabled.');
    }

    public function disableTwoFactor()
    {
        $this->resetErrorBag();
        $this->password = '';
        $this->showDisableModal = true;
    }

    public function confirmDisableTwoFactor()
    {
        $this->validate([
            'password' => 'required|string',
        ]);

        if (!\Hash::check($this->password, Auth::user()->password)) {
            $this->addError('password', 'The provided password is incorrect.');
            return;
        }

        Auth::user()->update([
            'two_factor_secret' => null,
            'two_factor_confirmed_at' => null,
            'two_factor_recovery_codes' => null,
        ]);

        session()->forget('two_factor_authenticated');

        $this->showDisableModal = false;
        $this->password = '';

        Toast::success('Two-factor authentication has been disabled.');
    }

    public function regenerateRecoveryCodes()
    {
        $this->recoveryCodes = $this->generateRecoveryCodes();

        Auth::user()->update([
            'two_factor_recovery_codes' => $this->recoveryCodes,
        ]);

        $this->showRecoveryCodes = true;
        Toast::success('Recovery codes have been regenerated.');
    }

    private function generateRecoveryCodes(): array
    {
        $codes = [];
        for ($i = 0; $i < 8; $i++) {
            $codes[] = Str::random(10);
        }
        return $codes;
    }

    public function closeModals()
    {
        $this->showEnableModal = false;
        $this->showDisableModal = false;
        $this->showRecoveryCodes = false;
        $this->confirmationCode = '';
        $this->password = '';
        $this->qrCodeSvg = null;
        $this->secretKey = null;
    }

    public function render()
    {
        return view('livewire.app.account.two-factor', [
            'user' => Auth::user(),
            'twoFactorEnabled' => Auth::user()->hasTwoFactorEnabled(),
        ]);
    }
}

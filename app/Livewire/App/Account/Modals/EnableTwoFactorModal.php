<?php

namespace App\Livewire\App\Account\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Services\TwoFactorService;
use Illuminate\Support\Facades\Auth;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

/**
 * Modal for enabling Two-Factor Authentication.
 */
class EnableTwoFactorModal extends ModalComponent
{
    public string $secret = '';
    public string $code = '';
    public string $qrCodeSvg = '';
    public array $recoveryCodes = [];
    public bool $showRecoveryCodes = false;

    public function mount(): void
    {
        $service = new TwoFactorService();
        $this->secret = $service->generateSecretKey();
        $this->generateQRCode();
    }

    protected function generateQRCode(): void
    {
        $service = new TwoFactorService();
        $url = $service->getQRCodeUrl(Auth::user(), $this->secret);

        $renderer = new ImageRenderer(
            new RendererStyle(192),
            new SvgImageBackEnd()
        );
        $writer = new Writer($renderer);

        $this->qrCodeSvg = $writer->writeString($url);
    }

    public function enable(): void
    {
        $this->validate([
            'code' => ['required', 'string', 'size:6'],
        ]);

        $service = new TwoFactorService();

        if (!$service->verify($this->secret, $this->code)) {
            $this->addError('code', __('account.two_factor.code_invalid'));
            return;
        }

        $user = Auth::user();
        $this->recoveryCodes = $service->enable($user, $this->secret);
        $this->showRecoveryCodes = true;

        // Send security notification
        $user->notify(new \App\Notifications\Account\TwoFactorEnabledNotification());
    }

    public function finish(): void
    {
        $this->dispatch('two-factor-enabled');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public function render()
    {
        return view('livewire.app.account.modals.enable-two-factor-modal');
    }
}

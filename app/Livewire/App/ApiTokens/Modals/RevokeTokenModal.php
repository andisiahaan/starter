<?php

namespace App\Livewire\App\ApiTokens\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;

class RevokeTokenModal extends ModalComponent
{
    public int $tokenId;
    public string $tokenName = '';

    public function mount(int $tokenId): void
    {
        $this->tokenId = $tokenId;
        
        // Get token name for display
        $token = auth()->user()->tokens()->where('id', $tokenId)->first();
        $this->tokenName = $token?->name ?? 'Unknown Token';
    }

    public function revoke(): void
    {
        auth()->user()->tokens()->where('id', $this->tokenId)->delete();
        
        Toast::success('Token revoked successfully.');
        $this->dispatch('refreshApiTokens');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    public function render()
    {
        return view('livewire.app.api-tokens.modals.revoke-token-modal');
    }
}

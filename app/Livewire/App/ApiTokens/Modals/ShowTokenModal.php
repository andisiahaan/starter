<?php

namespace App\Livewire\App\ApiTokens\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;

class ShowTokenModal extends ModalComponent
{
    public string $plainTextToken = '';

    public function mount(string $token): void
    {
        $this->plainTextToken = $token;
    }

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }

    public static function closeModalOnClickAway(): bool
    {
        return false; // Prevent accidental close
    }

    public function render()
    {
        return view('livewire.app.api-tokens.modals.show-token-modal');
    }
}

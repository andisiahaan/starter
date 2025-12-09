<?php

namespace App\Livewire\App\ApiTokens\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Enums\ApiTokenAbility;
use Carbon\Carbon;

class CreateTokenModal extends ModalComponent
{
    public string $tokenName = '';
    public array $selectedAbilities = ['read'];
    public string $expiresAt = ''; // empty = never expires

    protected function rules(): array
    {
        return [
            'tokenName' => 'required|string|max:255',
            'selectedAbilities' => 'required|array|min:1',
            'selectedAbilities.*' => 'in:' . implode(',', ApiTokenAbility::values()),
            'expiresAt' => 'nullable|in:7,30,60,90,365,never',
        ];
    }

    protected function messages(): array
    {
        return [
            'tokenName.required' => 'Token name is required.',
            'selectedAbilities.required' => 'Please select at least one ability.',
            'selectedAbilities.min' => 'Please select at least one ability.',
        ];
    }

    /**
     * Get expiration options.
     */
    public function getExpirationOptionsProperty(): array
    {
        return [
            '' => 'Never expires',
            '7' => '7 days',
            '30' => '30 days',
            '60' => '60 days',
            '90' => '90 days',
            '365' => '1 year',
        ];
    }

    public function create(): void
    {
        $this->validate();

        // Calculate expiration date
        $expiresAt = null;
        if ($this->expiresAt && $this->expiresAt !== 'never') {
            $expiresAt = Carbon::now()->addDays((int) $this->expiresAt);
        }

        $token = auth()->user()->createToken(
            $this->tokenName, 
            $this->selectedAbilities,
            $expiresAt
        );
        
        $this->dispatch('tokenCreated', plainTextToken: $token->plainTextToken);
        $this->dispatch('refreshApiTokens');
        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }

    public function render()
    {
        return view('livewire.app.api-tokens.modals.create-token-modal', [
            'abilities' => ApiTokenAbility::toArray(),
        ]);
    }
}

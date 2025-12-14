<?php

namespace App\Livewire\App\ApiTokens;

use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public ?string $newToken = null;

    /**
     * Re-render when tokens are updated.
     */
    #[On('refreshApiTokens')]
    public function refreshApiTokens(): void
    {
        // Re-render is handled automatically by Livewire
    }

    /**
     * Handle token created event to display the token.
     */
    #[On('tokenCreated')]
    public function onTokenCreated(string $plainTextToken): void
    {
        $this->newToken = $plainTextToken;
    }

    public function render()
    {
        return view('livewire.app.api-tokens.index', [
            'tokens' => auth()->user()->tokens()->orderByDesc('created_at')->get(),
        ])->layout('layouts.app', ['title' => 'API Tokens']);
    }
}

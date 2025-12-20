<?php

namespace App\Livewire\App\Dashboard;

use App\Helpers\Toast;
use App\Services\FreeCreditService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FreeCreditWidget extends Component
{
    public bool $canClaim = false;
    public bool $hasClaimed = false;
    public float $amount = 0;
    public ?string $claimedAt = null;
    public string $periodDisplay = '';
    public bool $enabled = false;

    protected FreeCreditService $service;

    public function boot(FreeCreditService $service)
    {
        $this->service = $service;
    }

    public function mount()
    {
        $this->loadClaimInfo();
    }

    public function loadClaimInfo()
    {
        $user = Auth::user();
        $info = $this->service->getClaimInfo($user);

        $this->enabled = $info['enabled'];
        $this->amount = $info['amount'];
        $this->canClaim = $info['can_claim'];
        $this->hasClaimed = $info['has_claimed'];
        $this->claimedAt = $info['claimed_at']?->format('d M Y, H:i');
        $this->periodDisplay = $info['period_display'];
    }

    public function claim()
    {
        $user = Auth::user();
        $claim = $this->service->claim($user);

        if ($claim) {
            Toast::success(__('free_credit.success', ['amount' => number_format($claim->amount, 0, ',', '.')]));
            $this->loadClaimInfo();
            $this->dispatch('credit-claimed');
        } else {
            Toast::error(__('free_credit.error'));
        }
    }

    public function render()
    {
        return view('livewire.app.dashboard.free-credit-widget');
    }
}

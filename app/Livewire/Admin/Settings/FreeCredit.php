<?php

namespace App\Livewire\Admin\Settings;

use App\Helpers\Toast;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class FreeCredit extends Component
{
    public array $state = [];

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        $setting = Setting::firstOrCreate(
            ['section' => 'free_credit'],
            ['config' => $this->getDefaults()]
        );

        $this->state = array_merge($this->getDefaults(), $setting->config ?? []);
    }

    public function getDefaults(): array
    {
        return [
            'enabled' => false,
            'amount' => 1000,
        ];
    }

    public function save()
    {
        $this->validate([
            'state.enabled' => 'boolean',
            'state.amount' => 'required|numeric|min:0',
        ]);

        Setting::updateOrCreate(
            ['section' => 'free_credit'],
            ['config' => $this->state]
        );

        Cache::forget('settings.free_credit');
        Toast::success(__('free_credit.settings.saved'));
    }

    public function render()
    {
        return view('admin.livewire.settings.free-credit');
    }
}

<?php

namespace App\Livewire\Admin\Settings;

use App\Helpers\Toast;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Referral extends Component
{
    public array $state = [];

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        $setting = Setting::firstOrCreate(
            ['section' => 'referral'],
            ['config' => $this->getDefaults()]
        );

        $this->state = array_merge($this->getDefaults(), $setting->config ?? []);
    }

    public function getDefaults(): array
    {
        return [
            'is_enabled' => true,
            'referral_cookie_days' => 60,
            'referral_expiry_days' => 30,
            'commission_fixed' => 1000,
            'commission_percent' => 20,
            'min_withdrawal' => 10000,
        ];
    }

    public function save()
    {
        $this->validate([
            'state.referral_cookie_days' => 'required|integer|min:1|max:365',
            'state.referral_expiry_days' => 'required|integer|min:0|max:365',
            'state.commission_fixed' => 'required|numeric|min:0',
            'state.commission_percent' => 'required|numeric|min:0|max:100',
            'state.min_withdrawal' => 'required|numeric|min:0',
        ]);

        Setting::updateOrCreate(
            ['section' => 'referral'],
            ['config' => $this->state]
        );

        Cache::forget('settings.referral');
        Toast::success('Referral settings saved successfully.');
    }

    public function render()
    {
        return view('admin.livewire.settings.referral');
    }
}

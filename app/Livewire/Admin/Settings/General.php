<?php

namespace App\Livewire\Admin\Settings;

use App\Helpers\Toast;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithFileUploads;

class General extends Component
{
    use WithFileUploads;

    public array $state = [];
    public $logo;
    public $favicon;

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        $setting = Setting::firstOrCreate(
            ['section' => 'main'],
            ['config' => $this->getDefaults()]
        );

        $this->state = array_merge($this->getDefaults(), $setting->config ?? []);
    }

    public function getDefaults(): array
    {
        return [
            'name' => config('app.name'),
            'description' => 'A great application.',
            'logo' => null,
            'favicon' => null,
            'default_language' => 'en',
            'theme' => 'dark',
            'timezone' => 'Asia/Jakarta',
            'currency' => 'IDR',
        ];
    }

    public function save()
    {
        $this->validate([
            'state.name' => 'required|string|max:255',
            'state.description' => 'nullable|string|max:1000',
            'logo' => 'nullable|image|max:2048',
            'favicon' => 'nullable|image|max:1024',
        ]);

        if ($this->logo) {
            $path = $this->logo->store('settings', 'public');
            $this->state['logo'] = $path;
        }
        if ($this->favicon) {
            $path = $this->favicon->store('settings', 'public');
            $this->state['favicon'] = $path;
        }

        Setting::updateOrCreate(
            ['section' => 'main'],
            ['config' => $this->state]
        );

        Cache::forget('settings.main');
        Toast::success('General settings saved successfully.');

        $this->logo = null;
        $this->favicon = null;
    }

    public function render()
    {
        return view('admin.livewire.settings.general', [
            'languages' => \App\Services\LanguageService::getAvailableLanguages(),
        ]);
    }
}

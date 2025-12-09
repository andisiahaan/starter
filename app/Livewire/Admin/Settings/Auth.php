<?php

namespace App\Livewire\Admin\Settings;

use App\Helpers\Toast;
use Spatie\Permission\Models\Role;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Auth extends Component
{
    public array $state = [];
    public $roles;

    public function mount()
    {
        $this->loadSettings();
        $this->roles = Role::all();
    }

    public function loadSettings()
    {
        $setting = Setting::firstOrCreate(
            ['section' => 'auth'],
            ['config' => $this->getDefaults()]
        );

        $this->state = array_merge($this->getDefaults(), $setting->config ?? []);
    }

    public function getDefaults(): array
    {
        return [
            'default_role' => 'user',
            'is_login_enabled' => true,
            'is_phone_required' => false,
            'max_login_attempts' => 3,
            'min_password_length' => 8,
            'is_remember_me_enabled' => true,
            'is_registration_enabled' => true,
            'lockout_duration_minutes' => 30,
            'is_account_deletion_enabled' => false,
            'is_login_with_email_enabled' => true,
            'is_strong_password_required' => false,
            'is_login_with_google_enabled' => false,
            'is_email_verification_required' => true,
            'is_login_with_username_enabled' => false,
            'is_registration_with_google_enabled' => false,
        ];
    }

    public function save()
    {
        $this->validate([
            'state.default_role' => 'required|string|max:50',
            'state.max_login_attempts' => 'required|integer|min:1|max:10',
            'state.min_password_length' => 'required|integer|min:6|max:32',
            'state.lockout_duration_minutes' => 'required|integer|min:1|max:1440',
        ]);

        Setting::updateOrCreate(
            ['section' => 'auth'],
            ['config' => $this->state]
        );

        Cache::forget('settings.auth');
        Toast::success('Authentication settings saved successfully.');
    }

    public function render()
    {
        return view('admin.livewire.settings.auth');
    }
}

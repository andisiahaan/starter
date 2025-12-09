<?php

namespace App\Livewire\Admin\Settings;

use App\Enums\NotificationChannel;
use App\Enums\NotificationType;
use App\Helpers\Toast;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\On;
use Livewire\Component;

class Notifications extends Component
{
    public array $channels = [];
    public array $types = [];

    public function mount(): void
    {
        $this->loadSettings();
    }

    public function loadSettings(): void
    {
        $setting = Setting::firstOrCreate(
            ['section' => 'notifications'],
            ['config' => $this->getDefaults()]
        );

        $config = array_merge($this->getDefaults(), $setting->config ?? []);
        $this->channels = $config['channels'] ?? [];
        $this->types = $config['types'] ?? [];
    }

    /**
     * Get default settings from enums.
     */
    public function getDefaults(): array
    {
        return [
            'channels' => NotificationChannel::getDefaults(),
            'types' => NotificationType::getDefaults(),
        ];
    }

    /**
     * Toggle a notification channel.
     */
    public function toggleChannel(string $channel): void
    {
        $channelEnum = NotificationChannel::tryFrom($channel);
        
        if (!$channelEnum) {
            Toast::error('Invalid channel.');
            return;
        }

        // Cannot disable required channels
        if ($channelEnum->isRequired()) {
            Toast::warning("{$channelEnum->getLabel()} channel cannot be disabled.");
            return;
        }

        $this->channels[$channel] = !($this->channels[$channel] ?? false);
        $this->saveSettings();
        Toast::success('Channel settings updated.');
    }

    /**
     * Toggle a notification type.
     */
    public function toggleType(string $type): void
    {
        $typeEnum = NotificationType::tryFrom($type);
        
        if (!$typeEnum) {
            Toast::error('Invalid notification type.');
            return;
        }

        // Security critical types cannot be disabled
        if ($typeEnum->isSecurityCritical()) {
            Toast::warning("{$typeEnum->getLabel()} is a security notification and cannot be disabled.");
            return;
        }

        $this->types[$type] = !($this->types[$type] ?? true);
        $this->saveSettings();
        Toast::success('Notification type updated.');
    }

    /**
     * Enable all types in a category.
     */
    public function enableCategory(string $category): void
    {
        foreach (NotificationType::cases() as $type) {
            if ($type->getCategory() === $category) {
                $this->types[$type->value] = true;
            }
        }
        $this->saveSettings();
        Toast::success('All notifications in category enabled.');
    }

    /**
     * Disable all types in a category (except security critical).
     */
    public function disableCategory(string $category): void
    {
        foreach (NotificationType::cases() as $type) {
            if ($type->getCategory() === $category && !$type->isSecurityCritical()) {
                $this->types[$type->value] = false;
            }
        }
        $this->saveSettings();
        Toast::success('Non-critical notifications in category disabled.');
    }

    /**
     * Save settings to database.
     */
    protected function saveSettings(): void
    {
        Setting::updateOrCreate(
            ['section' => 'notifications'],
            ['config' => [
                'channels' => $this->channels,
                'types' => $this->types,
            ]]
        );

        Cache::forget('settings.notifications');
    }

    #[On('refreshNotifications')]
    public function refreshNotifications(): void
    {
        $this->loadSettings();
    }

    public function render()
    {
        return view('admin.livewire.settings.notifications', [
            'channelEnums' => NotificationChannel::cases(),
            'categories' => NotificationType::getCategories(),
        ]);
    }
}

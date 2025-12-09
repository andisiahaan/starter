<?php

namespace App\Livewire\App\Account;

use App\Enums\NotificationChannel;
use App\Enums\NotificationType;
use App\Helpers\Toast;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

/**
 * User Notification Preferences component.
 */
class Notifications extends Component
{
    // These MUST be arrays, never null
    public array $userPreferences = [
        'channels' => [],
        'types' => [],
    ];
    
    public array $globalSettings = [
        'channels' => [],
        'types' => [],
    ];
    
    public array $pushSubscriptions = [];

    public function mount(): void
    {
        $this->loadSettings();
    }

    public function loadSettings(): void
    {
        $user = Auth::user();
        
        // Get global notification settings with proper defaults
        $storedSettings = setting('notifications');
        
        // Ensure globalSettings always has proper structure
        $this->globalSettings = [
            'channels' => array_merge(
                NotificationChannel::getDefaults(),
                is_array($storedSettings) && isset($storedSettings['channels']) ? $storedSettings['channels'] : []
            ),
            'types' => array_merge(
                NotificationType::getDefaults(),
                is_array($storedSettings) && isset($storedSettings['types']) ? $storedSettings['types'] : []
            ),
        ];
        
        // Get user preferences - ensure never null
        $preferences = $user->preferences;
        
        // Ensure userPreferences always has proper structure
        $this->userPreferences = [
            'channels' => [],
            'types' => [],
        ];
        
        if (is_array($preferences) && isset($preferences['notifications']) && is_array($preferences['notifications'])) {
            $notifPrefs = $preferences['notifications'];
            if (isset($notifPrefs['channels']) && is_array($notifPrefs['channels'])) {
                $this->userPreferences['channels'] = $notifPrefs['channels'];
            }
            if (isset($notifPrefs['types']) && is_array($notifPrefs['types'])) {
                $this->userPreferences['types'] = $notifPrefs['types'];
            }
        } else {
            // Set defaults
            $this->userPreferences = $this->getDefaultPreferences();
        }
        
        // Load push subscriptions
        $this->pushSubscriptions = $user->pushSubscriptions()
            ->orderByDesc('created_at')
            ->get()
            ->map(fn($sub) => [
                'id' => $sub->id,
                'endpoint' => $sub->endpoint,
                'created_at' => $sub->created_at->diffForHumans(),
            ])
            ->toArray();
    }

    /**
     * Get default preferences based on global settings.
     */
    protected function getDefaultPreferences(): array
    {
        $defaults = [
            'channels' => [],
            'types' => [],
        ];
        
        // Set default channels (database always on)
        foreach (NotificationChannel::cases() as $channel) {
            if ($this->globalSettings['channels'][$channel->value] ?? false) {
                $defaults['channels'][$channel->value] = $channel->isRequired();
            }
        }
        
        // Set default type preferences (all enabled by default)
        foreach (NotificationType::cases() as $type) {
            if ($this->globalSettings['types'][$type->value] ?? true) {
                $defaults['types'][$type->value] = true;
            }
        }
        
        return $defaults;
    }

    /**
     * Toggle a channel preference.
     */
    public function toggleChannel(string $channelValue): void
    {
        $channel = NotificationChannel::tryFrom($channelValue);
        
        if (!$channel) {
            Toast::error('Invalid channel.');
            return;
        }

        if ($channel->isRequired()) {
            Toast::warning("{$channel->getLabel()} notifications are required and cannot be disabled.");
            return;
        }
        
        $current = $this->userPreferences['channels'][$channelValue] ?? false;
        $this->userPreferences['channels'][$channelValue] = !$current;
        $this->savePreferences();
    }

    /**
     * Toggle a notification type preference.
     */
    public function toggleType(string $typeValue): void
    {
        $type = NotificationType::tryFrom($typeValue);
        
        if (!$type) {
            Toast::error('Invalid notification type.');
            return;
        }

        if ($type->isSecurityCritical()) {
            Toast::warning("{$type->getLabel()} is a security notification and cannot be disabled.");
            return;
        }

        $current = $this->userPreferences['types'][$typeValue] ?? true;
        $this->userPreferences['types'][$typeValue] = !$current;
        $this->savePreferences();
    }

    /**
     * Enable all types in a category.
     */
    public function enableCategory(string $category): void
    {
        foreach (NotificationType::forCategory($category) as $type) {
            if ($this->globalSettings['types'][$type->value] ?? true) {
                $this->userPreferences['types'][$type->value] = true;
            }
        }
        $this->savePreferences();
    }

    /**
     * Disable all types in a category (except security critical).
     */
    public function disableCategory(string $category): void
    {
        foreach (NotificationType::forCategory($category) as $type) {
            if (($this->globalSettings['types'][$type->value] ?? true) && !$type->isSecurityCritical()) {
                $this->userPreferences['types'][$type->value] = false;
            }
        }
        $this->savePreferences();
    }

    /**
     * Save user preferences.
     */
    protected function savePreferences(): void
    {
        $user = Auth::user();
        $preferences = is_array($user->preferences) ? $user->preferences : [];
        $preferences['notifications'] = $this->userPreferences;
        $user->preferences = $preferences;
        $user->save();
        
        Toast::success('Notification preferences saved.');
    }

    /**
     * Delete a push subscription.
     */
    public function deletePushSubscription(int $id): void
    {
        Auth::user()->pushSubscriptions()->where('id', $id)->delete();
        $this->loadSettings();
        Toast::success('Push subscription removed.');
    }

    /**
     * Handle push subscription from frontend.
     */
    public function savePushSubscription(array $subscription): void
    {
        Auth::user()->updatePushSubscription(
            $subscription['endpoint'],
            $subscription['keys']['p256dh'],
            $subscription['keys']['auth']
        );
        
        $this->loadSettings();
        Toast::success('Push notifications enabled!');
    }

    public function render()
    {
        $user = Auth::user();
        $isAdmin = $user->hasRole(['admin', 'superadmin']);
        
        // Pre-compute categorized notification types to avoid nested loops in blade
        // Show user categories to all users, plus admin categories if user is admin
        $categorizedTypes = [];
        
        // Get categories based on user role
        $categories = NotificationType::getUserCategories();
        if ($isAdmin) {
            // Merge admin categories for admin users
            $categories = array_merge($categories, NotificationType::getAdminCategories());
        }
        
        foreach ($categories as $categoryKey => $category) {
            $typesInCategory = NotificationType::forCategory($categoryKey);
            $enabledTypes = [];
            
            foreach ($typesInCategory as $type) {
                $globalEnabled = $this->globalSettings['types'][$type->value] ?? true;
                if ($globalEnabled) {
                    $enabledTypes[] = [
                        'value' => $type->value,
                        'label' => $type->getLabel(),
                        'description' => $type->getDescription(),
                        'isSecurityCritical' => $type->isSecurityCritical(),
                        'userEnabled' => $this->userPreferences['types'][$type->value] ?? true,
                    ];
                }
            }
            
            if (count($enabledTypes) > 0) {
                $categorizedTypes[] = [
                    'key' => $categoryKey,
                    'label' => $category['label'] ?? ucfirst($categoryKey),
                    'icon' => $category['icon'] ?? 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9',
                    'color' => $category['color'] ?? ['bg' => 'bg-slate-100', 'text' => 'text-slate-500'],
                    'types' => $enabledTypes,
                ];
            }
        }

        return view('livewire.app.account.notifications', [
            'categorizedTypes' => $categorizedTypes,
            'channels' => NotificationChannel::cases(),
        ]);
    }
}

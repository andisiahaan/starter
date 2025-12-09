<?php

namespace App\Livewire\App\Components;

use App\Enums\NotificationType;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class NotificationDropdown extends Component
{
    public int $unreadCount = 0;
    public array $notifications = [];

    public function mount(): void
    {
        $this->loadNotifications();
    }

    #[On('notificationRead')]
    #[On('refreshNotifications')]
    public function loadNotifications(): void
    {
        $user = Auth::user();
        
        if (!$user) {
            return;
        }
        
        // Get unread count
        $this->unreadCount = $user->unreadNotifications()->count();
        
        // Get latest 10 notifications
        $this->notifications = $user->notifications()
            ->take(10)
            ->get()
            ->map(function ($notification) {
                $typeValue = $notification->data['type'] ?? null;
                $typeEnum = $typeValue ? NotificationType::tryFrom($typeValue) : null;
                
                return [
                    'id' => $notification->id,
                    'type' => $typeValue,
                    'title' => $notification->data['title'] ?? $typeEnum?->getLabel() ?? 'Notification',
                    'message' => $notification->data['message'] ?? $typeEnum?->getDescription() ?? '',
                    'icon' => $typeEnum?->getIcon() ?? $this->getDefaultIcon(),
                    'color' => $typeEnum?->getColor() ?? $this->getDefaultColor(),
                    'url' => $notification->data['url'] ?? null,
                    'read_at' => $notification->read_at,
                    'created_at' => $notification->created_at->diffForHumans(),
                ];
            })
            ->toArray();
    }

    public function markAsRead(string $notificationId): void
    {
        $notification = Auth::user()->notifications()->find($notificationId);
        
        if ($notification && !$notification->read_at) {
            $notification->markAsRead();
            $this->loadNotifications();
        }
    }

    public function markAllAsRead(): void
    {
        Auth::user()->unreadNotifications->markAsRead();
        $this->loadNotifications();
    }

    /**
     * Get default icon for unknown notification types.
     */
    protected function getDefaultIcon(): string
    {
        return 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9';
    }

    /**
     * Get default color classes for unknown notification types.
     */
    protected function getDefaultColor(): array
    {
        return [
            'bg' => 'bg-slate-100 dark:bg-slate-700',
            'text' => 'text-slate-600 dark:text-slate-400',
        ];
    }

    public function render()
    {
        return view('livewire.app.components.notification-dropdown');
    }
}

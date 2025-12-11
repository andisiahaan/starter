<?php

namespace App\Livewire\App\Notifications;

use App\Enums\NotificationType;
use App\Helpers\Toast;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $filter = ''; // all, unread, read
    public array $selected = [];
    public bool $selectAll = false;

    protected $queryString = ['filter'];

    public function updatingFilter(): void
    {
        $this->resetPage();
        $this->selected = [];
        $this->selectAll = false;
    }

    public function updatedSelectAll(bool $value): void
    {
        if ($value) {
            $this->selected = $this->getNotificationsQuery()
                ->pluck('id')
                ->map(fn ($id) => (string) $id)
                ->toArray();
        } else {
            $this->selected = [];
        }
    }

    public function markAsRead(string $notificationId): void
    {
        $notification = Auth::user()->notifications()->find($notificationId);
        
        if ($notification && !$notification->read_at) {
            $notification->markAsRead();
            Toast::success(__('notifications.marked_as_read'));
            $this->dispatch('refreshNotifications');
        }
    }

    public function markAsUnread(string $notificationId): void
    {
        $notification = Auth::user()->notifications()->find($notificationId);
        
        if ($notification && $notification->read_at) {
            $notification->update(['read_at' => null]);
            Toast::success(__('notifications.marked_as_unread'));
            $this->dispatch('refreshNotifications');
        }
    }

    public function markSelectedAsRead(): void
    {
        if (empty($this->selected)) {
            return;
        }

        Auth::user()
            ->unreadNotifications()
            ->whereIn('id', $this->selected)
            ->update(['read_at' => now()]);

        Toast::success(__('notifications.bulk_marked_read', ['count' => count($this->selected)]));
        $this->selected = [];
        $this->selectAll = false;
        $this->dispatch('refreshNotifications');
    }

    public function markSelectedAsUnread(): void
    {
        if (empty($this->selected)) {
            return;
        }

        Auth::user()
            ->notifications()
            ->whereIn('id', $this->selected)
            ->update(['read_at' => null]);

        Toast::success(__('notifications.bulk_marked_unread', ['count' => count($this->selected)]));
        $this->selected = [];
        $this->selectAll = false;
        $this->dispatch('refreshNotifications');
    }

    public function markAllAsRead(): void
    {
        Auth::user()->unreadNotifications->markAsRead();
        Toast::success(__('notifications.all_marked_read'));
        $this->dispatch('refreshNotifications');
    }

    public function delete(string $notificationId): void
    {
        $notification = Auth::user()->notifications()->find($notificationId);
        
        if ($notification) {
            $notification->delete();
            Toast::success(__('notifications.deleted'));
            $this->dispatch('refreshNotifications');
        }
    }

    public function deleteSelected(): void
    {
        if (empty($this->selected)) {
            return;
        }

        Auth::user()
            ->notifications()
            ->whereIn('id', $this->selected)
            ->delete();

        Toast::success(__('notifications.bulk_deleted', ['count' => count($this->selected)]));
        $this->selected = [];
        $this->selectAll = false;
        $this->dispatch('refreshNotifications');
    }

    public function deleteAllRead(): void
    {
        $count = Auth::user()
            ->readNotifications()
            ->delete();

        Toast::success(__('notifications.all_read_deleted', ['count' => $count]));
        $this->dispatch('refreshNotifications');
    }

    protected function getNotificationsQuery()
    {
        $query = Auth::user()->notifications();

        return match ($this->filter) {
            'unread' => $query->whereNull('read_at'),
            'read' => $query->whereNotNull('read_at'),
            default => $query,
        };
    }

    public function render()
    {
        $notifications = $this->getNotificationsQuery()
            ->orderByDesc('created_at')
            ->paginate(15);

        // Transform notifications for view
        $transformedNotifications = $notifications->through(function ($notification) {
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
                'created_at_full' => $notification->created_at->format('M d, Y H:i'),
            ];
        });

        $unreadCount = Auth::user()->unreadNotifications()->count();

        return view('livewire.app.notifications.index', [
            'notifications' => $transformedNotifications,
            'unreadCount' => $unreadCount,
        ])
            ->layout('layouts.app')
            ->title(__('notifications.title'));
    }

    protected function getDefaultIcon(): string
    {
        return 'M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9';
    }

    protected function getDefaultColor(): array
    {
        return [
            'bg' => 'bg-slate-100 dark:bg-slate-700',
            'text' => 'text-slate-600 dark:text-slate-400',
        ];
    }
}

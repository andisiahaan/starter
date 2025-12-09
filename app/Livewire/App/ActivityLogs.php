<?php

namespace App\Livewire\App;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

/**
 * Activity Logs page component.
 * Route: /app/activity-logs
 */
class ActivityLogs extends Component
{
    use WithPagination;

    public string $search = '';

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $activities = Activity::query()
            ->where(function ($query) {
                $query->where('causer_type', 'App\Models\User')
                    ->where('causer_id', Auth::id());
            })
            ->orWhere(function ($query) {
                $query->where('subject_type', 'App\Models\User')
                    ->where('subject_id', Auth::id());
            })
            ->when($this->search, function ($query) {
                $query->where('description', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(15);

        return view('livewire.app.activity-logs', [
            'activities' => $activities,
        ])
            ->layout('layouts.app')
            ->title(__('Activity Logs'));
    }
}

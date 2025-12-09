<?php

namespace App\Livewire\App\Account;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Active sessions management component.
 */
class Sessions extends Component
{
    public function logoutSession(string $sessionId): void
    {
        $user = Auth::user();
        $currentSessionId = session()->getId();

        // Don't allow logging out current session
        if ($sessionId === $currentSessionId) {
            session()->flash('error', __('You cannot logout your current session.'));
            return;
        }

        // Delete the session from database
        DB::table('sessions')
            ->where('id', $sessionId)
            ->where('user_id', $user->id)
            ->delete();

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->withProperties(['session_id' => substr($sessionId, 0, 8) . '...'])
            ->log('Logged out remote session');

        session()->flash('success', __('Session logged out successfully.'));
    }

    public function logoutAllOtherSessions(): void
    {
        $user = Auth::user();
        $currentSessionId = session()->getId();

        // Delete all sessions except current
        $count = DB::table('sessions')
            ->where('user_id', $user->id)
            ->where('id', '!=', $currentSessionId)
            ->delete();

        activity()
            ->causedBy($user)
            ->performedOn($user)
            ->withProperties(['count' => $count])
            ->log('Logged out all other sessions');

        session()->flash('success', __(':count session(s) logged out successfully.', ['count' => $count]));
    }

    public function render()
    {
        $currentSessionId = session()->getId();

        $sessions = DB::table('sessions')
            ->where('user_id', Auth::id())
            ->orderByDesc('last_activity')
            ->get()
            ->map(function ($session) use ($currentSessionId) {
                $agent = $this->parseUserAgent($session->user_agent);

                return (object) [
                    'id' => $session->id,
                    'ip_address' => $session->ip_address,
                    'browser' => $agent['browser'],
                    'platform' => $agent['platform'],
                    'device' => $agent['device'],
                    'last_activity' => \Carbon\Carbon::createFromTimestamp($session->last_activity),
                    'is_current' => $session->id === $currentSessionId,
                ];
            });

        return view('livewire.app.account.sessions', [
            'sessions' => $sessions,
        ]);
    }

    /**
     * Parse user agent string.
     */
    protected function parseUserAgent(?string $userAgent): array
    {
        $result = [
            'browser' => 'Unknown',
            'platform' => 'Unknown',
            'device' => 'desktop',
        ];

        if (!$userAgent) {
            return $result;
        }

        // Detect browser
        if (str_contains($userAgent, 'Firefox')) {
            $result['browser'] = 'Firefox';
        } elseif (str_contains($userAgent, 'Edg')) {
            $result['browser'] = 'Edge';
        } elseif (str_contains($userAgent, 'Chrome')) {
            $result['browser'] = 'Chrome';
        } elseif (str_contains($userAgent, 'Safari')) {
            $result['browser'] = 'Safari';
        } elseif (str_contains($userAgent, 'Opera') || str_contains($userAgent, 'OPR')) {
            $result['browser'] = 'Opera';
        }

        // Detect platform
        if (str_contains($userAgent, 'Windows')) {
            $result['platform'] = 'Windows';
        } elseif (str_contains($userAgent, 'Mac')) {
            $result['platform'] = 'macOS';
        } elseif (str_contains($userAgent, 'Linux')) {
            $result['platform'] = 'Linux';
        } elseif (str_contains($userAgent, 'Android')) {
            $result['platform'] = 'Android';
            $result['device'] = 'mobile';
        } elseif (str_contains($userAgent, 'iPhone') || str_contains($userAgent, 'iPad')) {
            $result['platform'] = 'iOS';
            $result['device'] = str_contains($userAgent, 'iPad') ? 'tablet' : 'mobile';
        }

        return $result;
    }
}

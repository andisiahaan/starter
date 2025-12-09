<?php

namespace App\Livewire\App\Account\Modals;

use AndiSiahaan\LivewireModal\ModalComponent;
use App\Helpers\Toast;
use Illuminate\Support\Facades\Auth;

/**
 * Modal for managing push notification subscriptions.
 */
class PushSubscriptionsModal extends ModalComponent
{
    public array $subscriptions = [];
    
    public function mount(): void
    {
        $this->loadSubscriptions();
    }

    public function loadSubscriptions(): void
    {
        $this->subscriptions = Auth::user()
            ->pushSubscriptions()
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
     * Save a new push subscription from frontend.
     */
    public function savePushSubscription(string $endpoint, string $p256dh, string $auth): void
    {
        try {
            Auth::user()->updatePushSubscription($endpoint, $p256dh, $auth);
            $this->loadSubscriptions();
            
            // Dispatch event to parent component
            $this->dispatch('push-subscription-saved');
            
            Toast::success('Browser registered for push notifications!');
        } catch (\Exception $e) {
            Toast::error('Failed to save subscription: ' . $e->getMessage());
        }
    }

    /**
     * Delete a push subscription.
     */
    public function deleteSubscription(int $id): void
    {
        Auth::user()->pushSubscriptions()->where('id', $id)->delete();
        $this->loadSubscriptions();
        
        // Dispatch event to parent component  
        $this->dispatch('push-subscription-deleted');
        
        Toast::success('Subscription removed.');
    }

    public static function modalMaxWidth(): string
    {
        return '2xl';
    }

    public function render()
    {
        return view('livewire.app.account.modals.push-subscriptions-modal');
    }
}

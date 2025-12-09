<div class="flex flex-col bg-white dark:bg-dark-elevated rounded-lg overflow-hidden" x-data="pushSubscriptionManager()">
    {{-- Header --}}
    <div class="flex items-center justify-between px-5 py-4 border-b border-slate-200 dark:border-dark-border">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Push Notifications</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400">Manage browser subscriptions</p>
            </div>
        </div>
        <button wire:click="$dispatch('closeModal')" class="p-1.5 rounded-lg text-slate-400 hover:text-slate-600 hover:bg-slate-100 dark:hover:text-white dark:hover:bg-white/10 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    {{-- Body --}}
    <div class="p-5 space-y-4 max-h-96 overflow-y-auto">
        {{-- Add Current Browser Section --}}
        <div class="p-4 bg-slate-50 dark:bg-dark-soft rounded-lg border border-dashed border-slate-300 dark:border-dark-border">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-900 dark:text-white">This Browser</p>
                        <p class="text-xs text-slate-500 dark:text-slate-400" x-text="statusText"></p>
                    </div>
                </div>
                <template x-if="!isSubscribed && !isLoading">
                    <button @click="enablePush()" class="px-3 py-1.5 text-xs font-medium text-white bg-primary-600 hover:bg-primary-700 rounded transition-colors">
                        Enable
                    </button>
                </template>
                <template x-if="isLoading">
                    <span class="px-3 py-1.5 text-xs font-medium text-slate-500">
                        <svg class="animate-spin h-4 w-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                        </svg>
                    </span>
                </template>
                <template x-if="isSubscribed && !isLoading">
                    <span class="px-2 py-1 text-xs font-medium text-green-700 dark:text-green-400 bg-green-100 dark:bg-green-900/30 rounded">
                        Active
                    </span>
                </template>
            </div>
        </div>

        {{-- Subscriptions List --}}
        @if(count($subscriptions) > 0)
        <div class="space-y-2">
            <p class="text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Registered Devices ({{ count($subscriptions) }})</p>
            @foreach($subscriptions as $subscription)
            <div class="flex items-center justify-between p-3 bg-white dark:bg-dark-muted rounded-lg border border-slate-200 dark:border-dark-border" wire:key="sub-{{ $subscription['id'] }}">
                <div class="flex items-center gap-3 min-w-0 flex-1">
                    <div class="w-8 h-8 rounded-full bg-green-100 dark:bg-green-900/30 flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="text-sm font-medium text-slate-900 dark:text-white truncate" title="{{ $subscription['endpoint'] }}">
                            {{ Str::limit($subscription['endpoint'], 40) }}
                        </p>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Added {{ $subscription['created_at'] }}</p>
                    </div>
                </div>
                <button wire:click="deleteSubscription({{ $subscription['id'] }})" 
                        wire:confirm="Are you sure you want to remove this subscription?"
                        class="p-2 text-red-500 hover:text-red-700 dark:hover:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 rounded transition-colors shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-6">
            <svg class="w-12 h-12 mx-auto text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">No devices registered yet</p>
            <p class="text-xs text-slate-400 dark:text-slate-500">Enable push notifications to get started</p>
        </div>
        @endif
    </div>

    {{-- Footer --}}
    <div class="flex items-center justify-end gap-3 px-5 py-4 border-t border-slate-200 dark:border-dark-border bg-slate-50 dark:bg-dark-soft">
        <button wire:click="$dispatch('closeModal')" class="btn btn-ghost">
            Close
        </button>
    </div>
</div>

@script
<script>
    Alpine.data('pushSubscriptionManager', () => ({
        isSubscribed: false,
        isLoading: true,
        statusText: 'Checking...',

        async init() {
            await this.checkSubscription();
        },

        async checkSubscription() {
            this.isLoading = true;
            
            if (!('serviceWorker' in navigator) || !('PushManager' in window)) {
                this.statusText = 'Not supported';
                this.isLoading = false;
                return;
            }

            try {
                const registration = await navigator.serviceWorker.ready;
                const subscription = await registration.pushManager.getSubscription();
                this.isSubscribed = subscription !== null;
                this.statusText = this.isSubscribed ? 'Already registered' : 'Not registered yet';
            } catch (error) {
                console.error('Error checking subscription:', error);
                this.statusText = 'Error checking status';
            }
            
            this.isLoading = false;
        },

        async enablePush() {
            if (!('serviceWorker' in navigator) || !('PushManager' in window)) {
                alert('Push notifications are not supported in this browser.');
                return;
            }

            this.isLoading = true;
            this.statusText = 'Enabling...';

            try {
                const permission = await Notification.requestPermission();
                if (permission !== 'granted') {
                    alert('Please allow notifications to enable push notifications.');
                    this.statusText = 'Permission denied';
                    this.isLoading = false;
                    return;
                }

                const registration = await navigator.serviceWorker.ready;
                
                const vapidPublicKey = '{{ config("webpush.vapid.public_key") }}';
                if (!vapidPublicKey) {
                    alert('Push notifications are not configured. Please contact support.');
                    this.statusText = 'Not configured';
                    this.isLoading = false;
                    return;
                }

                const subscription = await registration.pushManager.subscribe({
                    userVisibleOnly: true,
                    applicationServerKey: this.urlBase64ToUint8Array(vapidPublicKey)
                });

                const subscriptionData = subscription.toJSON();
                
                // Call Livewire method with separate parameters
                await $wire.savePushSubscription(
                    subscriptionData.endpoint,
                    subscriptionData.keys.p256dh,
                    subscriptionData.keys.auth
                );
                
                this.isSubscribed = true;
                this.statusText = 'Already registered';
            } catch (error) {
                console.error('Failed to enable push:', error);
                alert('Failed to enable push notifications. Please try again.');
                this.statusText = 'Failed to enable';
            }
            
            this.isLoading = false;
        },

        urlBase64ToUint8Array(base64String) {
            const padding = '='.repeat((4 - base64String.length % 4) % 4);
            const base64 = (base64String + padding)
                .replace(/-/g, '+')
                .replace(/_/g, '/');

            const rawData = window.atob(base64);
            const outputArray = new Uint8Array(rawData.length);

            for (let i = 0; i < rawData.length; ++i) {
                outputArray[i] = rawData.charCodeAt(i);
            }
            return outputArray;
        }
    }));
</script>
@endscript

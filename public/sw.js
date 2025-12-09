/**
 * Service Worker for Push Notifications
 * Gramsea Application
 */

// Cache name for versioning
const CACHE_NAME = 'gramsea-v1';

// Assets to cache on install
const STATIC_ASSETS = [
    '/offline.html'
];

// Install event - cache static assets
self.addEventListener('install', (event) => {
    console.log('[ServiceWorker] Installing...');
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            console.log('[ServiceWorker] Caching static assets');
            return cache.addAll(STATIC_ASSETS).catch(() => {
                // Ignore if offline.html doesn't exist
                console.log('[ServiceWorker] Some assets failed to cache');
            });
        })
    );
    // Activate immediately
    self.skipWaiting();
});

// Activate event - cleanup old caches
self.addEventListener('activate', (event) => {
    console.log('[ServiceWorker] Activating...');
    event.waitUntil(
        caches.keys().then((cacheNames) => {
            return Promise.all(
                cacheNames
                    .filter((name) => name !== CACHE_NAME)
                    .map((name) => caches.delete(name))
            );
        })
    );
    // Take control of all pages immediately
    self.clients.claim();
});

// Fetch event - network first, fallback to cache
self.addEventListener('fetch', (event) => {
    // Skip non-GET requests
    if (event.request.method !== 'GET') return;
    
    // Skip requests to different origins
    if (!event.request.url.startsWith(self.location.origin)) return;
    
    // For navigation requests, use network first
    if (event.request.mode === 'navigate') {
        event.respondWith(
            fetch(event.request).catch(() => {
                return caches.match('/offline.html');
            })
        );
        return;
    }
});

// Push notification received
self.addEventListener('push', (event) => {
    console.log('[ServiceWorker] Push received');
    
    let data = {
        title: 'Gramsea',
        body: 'You have a new notification',
        icon: '/favicon.ico',
        badge: '/favicon.ico',
        data: {}
    };
    
    try {
        if (event.data) {
            const payload = event.data.json();
            data = {
                title: payload.title || data.title,
                body: payload.body || data.body,
                icon: payload.icon || data.icon,
                badge: payload.badge || data.badge,
                data: payload.data || {}
            };
        }
    } catch (e) {
        console.error('[ServiceWorker] Error parsing push data:', e);
    }
    
    const options = {
        body: data.body,
        icon: data.icon,
        badge: data.badge,
        data: data.data,
        vibrate: [100, 50, 100],
        requireInteraction: false,
        actions: []
    };
    
    // Add actions if provided
    if (data.data.actions) {
        options.actions = data.data.actions;
    }
    
    event.waitUntil(
        self.registration.showNotification(data.title, options)
    );
});

// Notification click handler
self.addEventListener('notificationclick', (event) => {
    console.log('[ServiceWorker] Notification clicked');
    
    event.notification.close();
    
    // Get the URL to open
    let url = '/app/notifications';
    if (event.notification.data && event.notification.data.url) {
        url = event.notification.data.url;
    }
    
    // Handle action button clicks
    if (event.action) {
        const action = event.notification.data.actions?.find(a => a.action === event.action);
        if (action && action.url) {
            url = action.url;
        }
    }
    
    // Open or focus the app
    event.waitUntil(
        clients.matchAll({ type: 'window', includeUncontrolled: true }).then((clientList) => {
            // Check if there's already a window open
            for (const client of clientList) {
                if (client.url.includes(self.location.origin) && 'focus' in client) {
                    client.navigate(url);
                    return client.focus();
                }
            }
            // Open a new window
            if (clients.openWindow) {
                return clients.openWindow(url);
            }
        })
    );
});

// Notification close handler
self.addEventListener('notificationclose', (event) => {
    console.log('[ServiceWorker] Notification closed');
});

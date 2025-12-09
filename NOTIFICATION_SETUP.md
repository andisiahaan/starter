# Notification System Setup

Dokumentasi lengkap untuk sistem notifikasi Gramsea.

## Struktur Folder

```
app/
├── Notifications/
│   ├── Orders/
│   │   ├── OrderCreatedNotification.php
│   │   ├── OrderStatusChangedNotification.php
│   │   └── CreditAddedNotification.php
│   ├── Credits/
│   │   ├── LowBalanceNotification.php
│   │   └── CreditDeductedNotification.php
│   ├── Account/
│   │   ├── LoginAlertNotification.php
│   │   ├── PasswordChangedNotification.php
│   │   └── EmailChangedNotification.php
│   └── System/
│       ├── MaintenanceNotification.php
│       └── AnnouncementNotification.php
├── Support/
│   └── NotificationHelper.php
├── Observers/
│   └── OrderObserver.php
└── Enums/
    ├── NotificationType.php
    └── NotificationChannel.php
```

## Registrasi Observer

Tambahkan di `app/Providers/AppServiceProvider.php`:

```php
use App\Models\Order;
use App\Observers\OrderObserver;

public function boot(): void
{
    Order::observe(OrderObserver::class);
}
```

## Penggunaan NotificationHelper

### Send Safely (Synchronous, No Exception)

```php
use App\Support\NotificationHelper;
use App\Notifications\Orders\OrderCreatedNotification;

// Tidak akan throw exception jika gagal
$success = NotificationHelper::sendSafely(
    $user,
    new OrderCreatedNotification($order)
);

if (!$success) {
    // Handle failure (optional)
}
```

### Send Async (Queue dengan afterCommit)

```php
// Notifikasi akan dikirim SETELAH database commit
NotificationHelper::sendAsync(
    $user,
    new OrderCreatedNotification($order)
);
```

### Send to Many

```php
use App\Models\User;

$users = User::where('role', 'admin')->get();

$results = NotificationHelper::sendToMany(
    $users,
    new SystemAnnouncementNotification($message)
);

// $results = ['success' => 10, 'failed' => 2, 'failures' => [5, 8]]
```

## Flow: Create Order → Send Notification

```php
// OrderController.php
public function store(Request $request)
{
    DB::transaction(function () use ($request) {
        $order = Order::create([...]);
        
        // Observer akan otomatis kirim notifikasi
        // SETELAH transaction commit (afterCommit = true)
    });
    
    return redirect()->route('orders.show', $order);
}
```

## Flow: Update Status → Trigger Notification

```php
// Admin mengubah status order
$order->update(['status' => 'verified']);

// OrderObserver akan:
// 1. Detect status isDirty
// 2. Kirim OrderStatusChangedNotification
// 3. Jika verified, proses credit giving (idempotent)
// 4. Kirim CreditAddedNotification
```

## Notification Class Template

```php
<?php

namespace App\Notifications\Orders;

use App\Enums\NotificationChannel;
use App\Enums\NotificationType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class MyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $afterCommit = true;  // <-- PENTING!

    protected NotificationType $type;

    public function __construct(/* params */)
    {
        $this->type = NotificationType::MY_TYPE;
    }

    public function via(object $notifiable): array
    {
        // Mengambil channel dari settings
        $channels = [];
        $settings = setting('notifications');
        
        foreach (NotificationChannel::cases() as $channel) {
            if ($settings['channels'][$channel->value] ?? false) {
                $channels[] = $channel->getChannelClass();
            }
        }
        
        return $channels ?: ['database'];
    }

    public function toArray(object $notifiable): array
    {
        return [
            'type' => $this->type->value,
            'category' => $this->type->getCategory(),
            'title' => 'My Title',
            'message' => 'My message',
            'url' => route('my.route'),
        ];
    }
}
```

## Queue Worker Setup

```bash
# Development
php artisan queue:work

# Production (dengan Supervisor)
php artisan queue:work --sleep=3 --tries=3 --max-time=3600
```

**Supervisor config** (`/etc/supervisor/conf.d/gramsea-worker.conf`):

```ini
[program:gramsea-worker]
process_name=%(program_name)s_%(process_num)02d
command=php /path/to/gramsea/artisan queue:work --sleep=3 --tries=3 --max-time=3600
autostart=true
autorestart=true
stopasgroup=true
killasgroup=true
numprocs=2
redirect_stderr=true
stdout_logfile=/path/to/gramsea/storage/logs/worker.log
```

## Testing

### Test Synchronous

```php
// Tanpa queue, langsung kirim
$user->notify(new OrderCreatedNotification($order)->onConnection('sync'));
```

### Test via Tinker

```bash
php artisan tinker
```

```php
$user = User::first();
$order = Order::first();
$user->notify(new \App\Notifications\Orders\OrderCreatedNotification($order));
```

### Test Queue Worker

```bash
# Jalankan worker
php artisan queue:work --once

# Cek jobs di database
SELECT * FROM jobs;
SELECT * FROM failed_jobs;
```

## Troubleshooting

### 1. Notifikasi Tidak Terkirim

- Cek `jobs` table apakah job dibuat
- Cek `failed_jobs` table untuk error
- Pastikan queue worker berjalan

### 2. Double Notification

- Cek `afterCommit = true` sudah di-set
- Pastikan tidak ada duplicate event trigger

### 3. Credit Diberikan Dua Kali

- OrderObserver menggunakan `credit_given_at` untuk idempotency
- Cek field ini di database

### 4. Email/Push Tidak Keluar

- Cek settings di Admin Panel → Notifications
- Pastikan channel enabled
- Untuk push: pastikan user punya subscription

## Environment Variables

```env
# Queue
QUEUE_CONNECTION=database

# Mail (untuk email notifications)
MAIL_MAILER=smtp
MAIL_HOST=...
MAIL_PORT=...

# Web Push (untuk push notifications)
VAPID_PUBLIC_KEY=...
VAPID_PRIVATE_KEY=...
```

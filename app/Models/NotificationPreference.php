<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NotificationPreference extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'channel',
        'enabled',
        'subscribed_at',
        'subscription_data',
    ];

    protected $casts = [
        'enabled' => 'boolean',
        'subscribed_at' => 'datetime',
        'subscription_data' => 'array',
    ];

    /**
     * Get the user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Available notification channels.
     */
    public static function channels(): array
    {
        return [
            'database' => 'In-App Notifications',
            'email' => 'Email Notifications',
            'push' => 'Push Notifications',
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ReferralCommission extends Model
{
    protected $fillable = [
        'user_id',
        'referred_user_id',
        'amount',
        'type',
        'commissionable_type',
        'commissionable_id',
        'status',
        'available_at',
        'expired_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'available_at' => 'datetime',
            'expired_at' => 'datetime',
        ];
    }

    /**
     * Status constants.
     */
    public const STATUS_PENDING = 'pending';
    public const STATUS_AVAILABLE = 'available';
    public const STATUS_WITHDRAWN = 'withdrawn';
    public const STATUS_EXPIRED = 'expired';
    public const STATUS_CANCELED = 'canceled';

    /**
     * Get the referrer (user who gets the commission).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the referred user.
     */
    public function referredUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referred_user_id');
    }

    /**
     * Get the commissionable model (Order, etc).
     */
    public function commissionable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Scope for pending commissions.
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope for available commissions.
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', self::STATUS_AVAILABLE);
    }

    /**
     * Scope for commissions that should become available.
     */
    public function scopeShouldBeAvailable($query)
    {
        return $query->where('status', self::STATUS_PENDING)
            ->where(function ($q) {
                $q->whereNull('available_at')
                    ->orWhere('available_at', '<=', now());
            });
    }

    /**
     * Scope for expired commissions.
     */
    public function scopeShouldExpire($query)
    {
        return $query->where('status', self::STATUS_PENDING)
            ->whereNotNull('expired_at')
            ->where('expired_at', '<=', now());
    }

    /**
     * Scope for user's commissions.
     */
    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Check if commission is pending.
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if commission is available.
     */
    public function isAvailable(): bool
    {
        return $this->status === self::STATUS_AVAILABLE;
    }

    /**
     * Mark commission as available.
     */
    public function markAsAvailable(): bool
    {
        return $this->update(['status' => self::STATUS_AVAILABLE]);
    }

    /**
     * Mark commission as expired.
     */
    public function markAsExpired(): bool
    {
        return $this->update(['status' => self::STATUS_EXPIRED]);
    }

    /**
     * Mark commission as withdrawn.
     */
    public function markAsWithdrawn(): bool
    {
        return $this->update(['status' => self::STATUS_WITHDRAWN]);
    }

    /**
     * Mark commission as canceled.
     */
    public function markAsCanceled(): bool
    {
        return $this->update(['status' => self::STATUS_CANCELED]);
    }
}

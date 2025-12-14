<?php

namespace App\Models;

use App\Enums\ReferralBalanceLogType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ReferralBalanceLog extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'balance_before',
        'balance_after',
        'type',
        'description',
        'reference_type',
        'reference_id',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'balance_before' => 'decimal:2',
            'balance_after' => 'decimal:2',
            'type' => ReferralBalanceLogType::class,
        ];
    }

    /**
     * Get the user for this log entry.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the reference model (polymorphic).
     */
    public function reference(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Check if this is an addition.
     */
    public function isAddition(): bool
    {
        return $this->amount > 0;
    }

    /**
     * Check if this is a deduction.
     */
    public function isDeduction(): bool
    {
        return $this->amount < 0;
    }

    /**
     * Get formatted amount with sign.
     */
    public function getFormattedAmountAttribute(): string
    {
        $prefix = $this->amount >= 0 ? '+' : '';
        return $prefix . number_format($this->amount, 2);
    }

    /**
     * Scope for user's logs.
     */
    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope for specific type.
     */
    public function scopeOfType($query, ReferralBalanceLogType $type)
    {
        return $query->where('type', $type);
    }
}

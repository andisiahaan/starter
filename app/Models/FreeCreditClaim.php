<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FreeCreditClaim extends Model
{
    protected $fillable = [
        'user_id',
        'amount',
        'period',
        'credit_log_id',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
        ];
    }

    /**
     * Get the user who made this claim.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the associated credit log.
     */
    public function creditLog(): BelongsTo
    {
        return $this->belongsTo(CreditLog::class);
    }

    /**
     * Scope for filtering by period.
     */
    public function scopeForPeriod($query, string $period)
    {
        return $query->where('period', $period);
    }

    /**
     * Scope for filtering by user.
     */
    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Get the current period string (YYYY-MM format).
     */
    public static function getCurrentPeriod(): string
    {
        return now()->format('Y-m');
    }

    /**
     * Check if a user has claimed for a specific period.
     */
    public static function hasClaimedForPeriod(int $userId, ?string $period = null): bool
    {
        $period = $period ?? self::getCurrentPeriod();
        
        return self::where('user_id', $userId)
            ->where('period', $period)
            ->exists();
    }
}

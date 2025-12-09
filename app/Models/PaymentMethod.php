<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    use SoftDeletes;

    // Provider constants
    public const PROVIDER_TRIPAY = 'TRIPAY';
    public const PROVIDER_MANUAL = 'MANUAL';

    public static array $providers = [
        self::PROVIDER_TRIPAY => 'Tripay',
        self::PROVIDER_MANUAL => 'Manual',
    ];

    protected $fillable = [
        'code',
        'provider',
        'name',
        'type',
        'flow',
        'description',
        'logo',
        'min_amount',
        'max_amount',
        'fee_flat',
        'fee_percent',
        'is_active',
        'meta',
    ];

    protected function casts(): array
    {
        return [
            'min_amount' => 'decimal:2',
            'max_amount' => 'decimal:2',
            'fee_flat' => 'decimal:2',
            'fee_percent' => 'decimal:2',
            'is_active' => 'boolean',
            'meta' => 'array',
        ];
    }

    /**
     * Get the orders using this payment method.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Calculate fee for a given amount.
     */
    public function calculateFee(float $amount): float
    {
        $flatFee = $this->fee_flat ?? 0;
        $percentFee = ($this->fee_percent ?? 0) / 100 * $amount;

        return round($flatFee + $percentFee, 2);
    }

    /**
     * Check if amount is within limits.
     */
    public function isAmountValid(float $amount): bool
    {
        if ($this->min_amount !== null && $amount < $this->min_amount) {
            return false;
        }

        if ($this->max_amount !== null && $amount > $this->max_amount) {
            return false;
        }

        return true;
    }

    /**
     * Scope for active payment methods.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for payment methods by type.
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope for payment methods by provider.
     */
    public function scopeOfProvider($query, string $provider)
    {
        return $query->where('provider', $provider);
    }

    /**
     * Check if this payment method uses Tripay provider.
     */
    public function isTripay(): bool
    {
        return $this->provider === self::PROVIDER_TRIPAY;
    }

    /**
     * Check if this payment method is manual.
     */
    public function isManual(): bool
    {
        return $this->provider === self::PROVIDER_MANUAL;
    }

    /**
     * Scope for payment methods that can be used for deposits.
     */
    public function scopeForDeposit($query)
    {
        return $query->whereIn('flow', ['deposit', 'both']);
    }

    /**
     * Scope for payment methods that can be used for withdrawals.
     */
    public function scopeForWithdraw($query)
    {
        return $query->whereIn('flow', ['withdraw', 'both']);
    }

    /**
     * Check if this payment method can be used for deposits.
     */
    public function canDeposit(): bool
    {
        return in_array($this->flow, ['deposit', 'both']);
    }

    /**
     * Check if this payment method can be used for withdrawals.
     */
    public function canWithdraw(): bool
    {
        return in_array($this->flow, ['withdraw', 'both']);
    }
}

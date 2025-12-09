<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'product_id',
        'payment_method_id',
        'product_name',
        'product_price',
        'credit_amount',
        'payment_method_code',
        'subtotal',
        'fee_amount',
        'total_amount',
        'status',
        'verified_at',
        'credit_given_at',
        'expires_at',
        'gateway_reference',
        'payment_reference',
        'gateway_data',
        'payment_details',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'product_price' => 'decimal:2',
            'credit_amount' => 'decimal:2',
            'subtotal' => 'decimal:2',
            'fee_amount' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'verified_at' => 'datetime',
            'credit_given_at' => 'datetime',
            'expires_at' => 'datetime',
            'gateway_data' => 'array',
            'payment_details' => 'array',
        ];
    }

    /**
     * Boot method for model events.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            if (empty($order->order_number)) {
                $order->order_number = static::generateOrderNumber();
            }
        });
    }

    /**
     * Generate unique order number.
     */
    public static function generateOrderNumber(): string
    {
        do {
            $number = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(6));
        } while (static::where('order_number', $number)->exists());

        return $number;
    }

    /**
     * Get the user who placed this order.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the product for this order.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the payment method for this order.
     */
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Get the credit logs for this order.
     */
    public function creditLogs(): MorphMany
    {
        return $this->morphMany(CreditLog::class, 'reference');
    }

    /**
     * Scope for pending orders.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope for verified orders.
     */
    public function scopeVerified($query)
    {
        return $query->where('status', 'verified');
    }

    /**
     * Scope for failed orders.
     */
    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Scope for cancelled orders.
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', 'cancelled');
    }

    /**
     * Scope for orders by status.
     */
    public function scopeStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Check if order is pending.
     */
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    /**
     * Check if order is verified.
     */
    public function isVerified(): bool
    {
        return $this->status === 'verified';
    }

    /**
     * Check if credit was already given.
     */
    public function isCreditGiven(): bool
    {
        return $this->credit_given_at !== null;
    }

    /**
     * Check if order is expired.
     */
    public function isExpired(): bool
    {
        return $this->expires_at !== null && $this->expires_at->isPast();
    }

    /**
     * Mark order as verified.
     */
    public function markAsVerified(?string $gatewayReference = null): bool
    {
        return $this->update([
            'status' => 'verified',
            'verified_at' => now(),
            'gateway_reference' => $gatewayReference ?? $this->gateway_reference,
        ]);
    }

    /**
     * Mark order as failed.
     */
    public function markAsFailed(?string $notes = null): bool
    {
        return $this->update([
            'status' => 'failed',
            'notes' => $notes ?? $this->notes,
        ]);
    }

    /**
     * Mark order as cancelled.
     */
    public function markAsCancelled(?string $notes = null): bool
    {
        return $this->update([
            'status' => 'cancelled',
            'notes' => $notes ?? $this->notes,
        ]);
    }
}

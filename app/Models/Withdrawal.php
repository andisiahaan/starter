<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Withdrawal extends Model
{
    protected $fillable = [
        'user_id',
        'payment_method_id',
        'amount',
        'account_details',
        'status',
        'admin_notes',
        'processed_by',
        'processed_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'account_details' => 'array',
            'processed_at' => 'datetime',
        ];
    }

    /**
     * Status constants.
     */
    public const STATUS_PENDING = 'pending';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_REJECTED = 'rejected';

    /**
     * Get the user who requested the withdrawal.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the payment method used.
     */
    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    /**
     * Get the admin who processed this withdrawal.
     */
    public function processedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'processed_by');
    }

    /**
     * Scope for pending withdrawals.
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope for processing withdrawals.
     */
    public function scopeProcessing($query)
    {
        return $query->where('status', self::STATUS_PROCESSING);
    }

    /**
     * Scope for completed withdrawals.
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    /**
     * Scope for user's withdrawals.
     */
    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Check if withdrawal is pending.
     */
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if withdrawal is completed.
     */
    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    /**
     * Mark as processing.
     */
    public function markAsProcessing(): bool
    {
        return $this->update([
            'status' => self::STATUS_PROCESSING,
        ]);
    }

    /**
     * Mark as completed.
     */
    public function markAsCompleted(int $processedBy, ?string $notes = null): bool
    {
        $oldStatus = $this->status;
        
        $result = $this->update([
            'status' => self::STATUS_COMPLETED,
            'processed_by' => $processedBy,
            'processed_at' => now(),
            'admin_notes' => $notes,
        ]);

        // Notify user about status change
        if ($result && $this->user) {
            $this->user->notify(new \App\Notifications\Withdrawals\WithdrawalStatusUpdatedNotification($this, $oldStatus));
        }

        return $result;
    }

    /**
     * Mark as rejected and restore user's referral balance.
     */
    public function markAsRejected(int $processedBy, ?string $notes = null): bool
    {
        $oldStatus = $this->status;
        
        $result = $this->update([
            'status' => self::STATUS_REJECTED,
            'processed_by' => $processedBy,
            'processed_at' => now(),
            'admin_notes' => $notes,
        ]);

        if ($result && $this->user) {
            // Restore referral balance
            $this->user->addReferralBalance(
                amount: (float) $this->amount,
                type: \App\Enums\ReferralBalanceLogType::WITHDRAWAL_REJECTED,
                description: __('referral.balance_log.withdrawal_rejected'),
                reference: $this
            );

            // Notify user about status change
            $this->user->notify(new \App\Notifications\Withdrawals\WithdrawalStatusUpdatedNotification($this, $oldStatus));
        }

        return $result;
    }

    /**
     * Get formatted account details for display.
     */
    public function getFormattedAccountDetailsAttribute(): string
    {
        $details = $this->account_details;
        if (empty($details)) {
            return '-';
        }

        $parts = [];
        if (isset($details['bank_name'])) {
            $parts[] = $details['bank_name'];
        }
        if (isset($details['account_number'])) {
            $parts[] = $details['account_number'];
        }
        if (isset($details['account_holder'])) {
            $parts[] = '(' . $details['account_holder'] . ')';
        }

        return implode(' - ', $parts) ?: '-';
    }
}

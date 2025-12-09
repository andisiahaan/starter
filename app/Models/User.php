<?php

namespace App\Models;

use App\Traits\HasNotificationPreferences;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use NotificationChannels\WebPush\HasPushSubscriptions;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles, LogsActivity, HasApiTokens, HasPushSubscriptions, HasNotificationPreferences;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'username',
        'referral_code',
        'referrer_id',
        'email',
        'password',
        'phone',
        'credit',
        'preferences',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
        'banned_at',
        'ban_reason',
        'banned_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'credit' => 'decimal:2',
            'preferences' => 'array',
            'two_factor_confirmed_at' => 'datetime',
            'two_factor_secret' => 'encrypted',
            'two_factor_recovery_codes' => 'encrypted:array',
            'banned_at' => 'datetime',
        ];
    }

    /**
     * Get the user's orders.
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Get the user's credit logs.
     */
    public function creditLogs(): HasMany
    {
        return $this->hasMany(CreditLog::class);
    }

    // ==========================================
    // Referral System
    // ==========================================

    /**
     * Get the user who referred this user.
     */
    public function referrer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    /**
     * Get users referred by this user.
     */
    public function referrals(): HasMany
    {
        return $this->hasMany(User::class, 'referrer_id');
    }

    /**
     * Get referral commissions earned by this user.
     */
    public function referralCommissions(): HasMany
    {
        return $this->hasMany(ReferralCommission::class);
    }

    /**
     * Get user's withdrawals.
     */
    public function withdrawals(): HasMany
    {
        return $this->hasMany(Withdrawal::class);
    }

    /**
     * Get the user's referral URL.
     */
    public function getReferralUrlAttribute(): string
    {
        return url('/ref/' . $this->referral_code);
    }

    /**
     * Get total available commission for withdrawal.
     */
    public function getAvailableCommissionAttribute(): float
    {
        return (float) $this->referralCommissions()
            ->where('status', ReferralCommission::STATUS_AVAILABLE)
            ->sum('amount');
    }

    /**
     * Get total pending commission.
     */
    public function getPendingCommissionAttribute(): float
    {
        return (float) $this->referralCommissions()
            ->where('status', ReferralCommission::STATUS_PENDING)
            ->sum('amount');
    }

    /**
     * Get total withdrawn commission.
     */
    public function getWithdrawnCommissionAttribute(): float
    {
        return (float) $this->referralCommissions()
            ->where('status', ReferralCommission::STATUS_WITHDRAWN)
            ->sum('amount');
    }

    /**
     * Get total earnings (all commissions except canceled/expired).
     */
    public function getTotalEarningsAttribute(): float
    {
        return (float) $this->referralCommissions()
            ->whereNotIn('status', [ReferralCommission::STATUS_CANCELED, ReferralCommission::STATUS_EXPIRED])
            ->sum('amount');
    }

    /**
     * Check if user has enough available commission for withdrawal.
     */
    public function hasEnoughCommission(float $amount): bool
    {
        return $this->available_commission >= $amount;
    }

    /**
     * Check if user has enough credit.
     */
    public function hasEnoughCredit(float $amount): bool
    {
        return $this->credit >= $amount;
    }

    /**
     * Add credit to user account.
     *
     * @param float $amount Amount to add (positive)
     * @param \App\Enums\CreditLogType $type Transaction type
     * @param string|null $description Transaction description
     * @param Model|null $reference Related model (polymorphic)
     * @param array|null $meta Additional metadata
     * @return CreditLog
     */
    public function addCredit(
        float $amount,
        \App\Enums\CreditLogType $type,
        ?string $description = null,
        ?Model $reference = null,
        ?array $meta = null
    ): CreditLog {
        return DB::transaction(function () use ($amount, $type, $description, $reference, $meta) {
            $balanceBefore = $this->credit;
            $this->increment('credit', abs($amount));
            $this->refresh();

            return $this->creditLogs()->create([
                'amount' => abs($amount),
                'balance_before' => $balanceBefore,
                'balance_after' => $this->credit,
                'type' => $type,
                'description' => $description,
                'reference_type' => $reference ? get_class($reference) : null,
                'reference_id' => $reference?->id,
                'meta' => $meta,
            ]);
        });
    }

    /**
     * Deduct credit from user account.
     *
     * @param float $amount Amount to deduct (positive)
     * @param \App\Enums\CreditLogType $type Transaction type
     * @param string|null $description Transaction description
     * @param Model|null $reference Related model (polymorphic)
     * @param array|null $meta Additional metadata
     * @return CreditLog|null Returns null if insufficient credit
     */
    public function deductCredit(
        float $amount,
        \App\Enums\CreditLogType $type,
        ?string $description = null,
        ?Model $reference = null,
        ?array $meta = null
    ): ?CreditLog {
        if (!$this->hasEnoughCredit($amount)) {
            return null;
        }

        return DB::transaction(function () use ($amount, $type, $description, $reference, $meta) {
            $balanceBefore = $this->credit;
            $this->decrement('credit', abs($amount));
            $this->refresh();

            return $this->creditLogs()->create([
                'amount' => -abs($amount),
                'balance_before' => $balanceBefore,
                'balance_after' => $this->credit,
                'type' => $type,
                'description' => $description,
                'reference_type' => $reference ? get_class($reference) : null,
                'reference_id' => $reference?->id,
                'meta' => $meta,
            ]);
        });
    }

    /**
     * Get formatted credit balance.
     */
    public function getFormattedCreditAttribute(): string
    {
        return number_format($this->credit, 2);
    }

    /**
     * Configure activity logging options.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['name', 'email'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(fn(string $eventName) => "User {$eventName}");
    }

    /**
     * Check if user has 2FA enabled.
     */
    public function hasTwoFactorEnabled(): bool
    {
        return !is_null($this->two_factor_confirmed_at);
    }

    /**
     * Get the user's pending email changes.
     */
    public function pendingEmailChanges(): HasMany
    {
        return $this->hasMany(PendingEmailChange::class);
    }

    /**
     * Get the user's latest pending email change.
     */
    public function latestPendingEmailChange()
    {
        return $this->pendingEmailChanges()
            ->where('expires_at', '>', now())
            ->latest()
            ->first();
    }

    // ==========================================
    // Ban/Suspend System
    // ==========================================

    /**
     * Get the admin who banned this user.
     */
    public function bannedByAdmin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'banned_by');
    }

    /**
     * Check if user is banned.
     */
    public function isBanned(): bool
    {
        return !is_null($this->banned_at);
    }

    /**
     * Ban the user.
     */
    public function ban(?string $reason = null, ?int $bannedBy = null): bool
    {
        return $this->update([
            'banned_at' => now(),
            'ban_reason' => $reason,
            'banned_by' => $bannedBy ?? auth()->id(),
        ]);
    }

    /**
     * Unban the user.
     */
    public function unban(): bool
    {
        return $this->update([
            'banned_at' => null,
            'ban_reason' => null,
            'banned_by' => null,
        ]);
    }
}

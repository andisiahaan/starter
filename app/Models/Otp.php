<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Generic OTP model for various verification purposes.
 * 
 * Usage:
 * // Generate OTP
 * $otp = Otp::generate($user, 'email_change', 'new@email.com');
 * 
 * // Verify OTP
 * $otp = Otp::verify($user, 'email_change', '123456');
 * 
 * // Check cooldown
 * if (Otp::canSend($user, 'email_change')) { ... }
 */
class Otp extends Model
{
    protected $fillable = [
        'user_id',
        'purpose',
        'identifier',
        'code',
        'expires_at',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'expires_at' => 'datetime',
            'verified_at' => 'datetime',
        ];
    }

    /**
     * Get the user that owns this OTP.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if this OTP is still valid (not expired and not used).
     */
    public function isValid(): bool
    {
        return $this->expires_at->isFuture() && is_null($this->verified_at);
    }

    /**
     * Check if this OTP has expired.
     */
    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    /**
     * Mark this OTP as verified/used.
     */
    public function markAsVerified(): bool
    {
        return $this->update(['verified_at' => now()]);
    }

    /**
     * Generate a new OTP for the given user and purpose.
     */
    public static function generate(
        $user,
        string $purpose,
        ?string $identifier = null,
        int $expiryMinutes = 10
    ): self {
        // Delete any existing unverified OTPs for this purpose
        static::where('user_id', $user->id)
            ->where('purpose', $purpose)
            ->whereNull('verified_at')
            ->delete();

        // Generate 6-digit code
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        return static::create([
            'user_id' => $user->id,
            'purpose' => $purpose,
            'identifier' => $identifier,
            'code' => $code,
            'expires_at' => now()->addMinutes($expiryMinutes),
        ]);
    }

    /**
     * Verify an OTP for the given user and purpose.
     * Returns the OTP if valid, null otherwise.
     */
    public static function verify($user, string $purpose, string $code): ?self
    {
        $otp = static::where('user_id', $user->id)
            ->where('purpose', $purpose)
            ->where('code', trim($code))
            ->whereNull('verified_at')
            ->where('expires_at', '>', now())
            ->first();

        if ($otp) {
            $otp->markAsVerified();
        }

        return $otp;
    }

    /**
     * Check if user can send a new OTP (cooldown check).
     * Returns remaining cooldown seconds or 0 if can send.
     * Only checks UNVERIFIED OTPs within the cooldown window.
     */
    public static function cooldownSeconds($user, string $purpose, int $cooldownSeconds = 60): int
    {
        // Only look at unverified OTPs created within the cooldown period
        $lastOtp = static::where('user_id', $user->id)
            ->where('purpose', $purpose)
            ->whereNull('verified_at') // Only unverified
            ->where('created_at', '>', now()->subSeconds($cooldownSeconds)) // Within cooldown window
            ->orderByDesc('created_at')
            ->first();

        if (!$lastOtp) {
            return 0;
        }

        $secondsSinceSent = (int) now()->diffInSeconds($lastOtp->created_at);
        
        if ($secondsSinceSent < $cooldownSeconds) {
            return $cooldownSeconds - $secondsSinceSent;
        }

        return 0;
    }

    /**
     * Check if user can send a new OTP.
     */
    public static function canSend($user, string $purpose, int $cooldownSeconds = 60): bool
    {
        return static::cooldownSeconds($user, $purpose, $cooldownSeconds) === 0;
    }

    /**
     * Get the latest unverified OTP for a user and purpose.
     */
    public static function getLatest($user, string $purpose): ?self
    {
        return static::where('user_id', $user->id)
            ->where('purpose', $purpose)
            ->whereNull('verified_at')
            ->where('expires_at', '>', now())
            ->orderByDesc('created_at')
            ->first();
    }

    /**
     * Scope to get only valid (non-expired, unverified) OTPs.
     */
    public function scopeValid($query)
    {
        return $query
            ->whereNull('verified_at')
            ->where('expires_at', '>', now());
    }

    /**
     * Scope to filter by purpose.
     */
    public function scopeForPurpose($query, string $purpose)
    {
        return $query->where('purpose', $purpose);
    }
}

<?php

namespace App\Observers;

use App\Enums\NotificationType;
use App\Models\User;
use App\Notifications\Admin\AdminUserRegisteredNotification;
use App\Support\NotificationHelper;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class UserObserver
{
    /**
     * Handle the User "creating" event.
     * Auto-generate username and referral_code from name.
     */
    public function creating(User $user): void
    {
        // Generate username from name if not provided
        if (empty($user->username)) {
            $user->username = $this->generateUniqueUsername($user->name);
        }

        // Generate referral code if not provided
        if (empty($user->referral_code)) {
            $user->referral_code = $this->generateUniqueReferralCode($user->name);
        }
    }

    /**
     * Handle the User "created" event.
     * Notifies admins when a new user registers.
     */
    public function created(User $user): void
    {
        // Don't notify for admin-created users or seeded users
        if (app()->runningInConsole() && !app()->runningUnitTests()) {
            return;
        }

        // Notify admins about new user registration
        NotificationHelper::sendToAdmins(
            new AdminUserRegisteredNotification($user),
            NotificationType::ADMIN_USER_REGISTERED->value
        );

        Log::info('[UserObserver] Admin notification sent for new user registration', [
            'user_id' => $user->id,
            'email' => $user->email,
        ]);
    }

    /**
     * Generate a unique username from name.
     */
    private function generateUniqueUsername(string $name): string
    {
        // Buat base username dari nama: lowercase, ganti spasi dengan underscore
        $baseUsername = Str::slug($name, '_');
        
        // Jika terlalu panjang, potong
        if (strlen($baseUsername) > 20) {
            $baseUsername = substr($baseUsername, 0, 20);
        }

        // Pastikan unique
        $username = $baseUsername;
        $counter = 1;
        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        return $username;
    }

    /**
     * Generate a unique referral code from name.
     */
    private function generateUniqueReferralCode(string $name): string
    {
        // Ambil 3 huruf pertama dari nama (uppercase) + 5 karakter random
        $prefix = strtoupper(substr(preg_replace('/[^a-zA-Z]/', '', $name), 0, 3));
        
        // Jika prefix kurang dari 3 huruf, tambahkan karakter random
        while (strlen($prefix) < 3) {
            $prefix .= strtoupper(Str::random(1));
        }

        // Generate unique code
        do {
            $code = $prefix . strtoupper(Str::random(5));
        } while (User::where('referral_code', $code)->exists());

        return $code;
    }
}

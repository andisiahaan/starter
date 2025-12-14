<?php

use App\Services\ReferralService;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// ==========================================
// Scheduled Commands
// ==========================================

// Cancel expired pending orders every 5 minutes
Schedule::command('orders:cancel-expired')->everyFiveMinutes();

// Process referral commissions (make pending commissions available)
Schedule::call(function () {
    app(ReferralService::class)->processAvailableCommissions();
})->hourly()->name('referral:process-available');

// Process expired referral commissions (mark as expired)
Schedule::call(function () {
    app(ReferralService::class)->processExpiredCommissions();
})->daily()->name('referral:process-expired');


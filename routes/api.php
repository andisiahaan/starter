<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Callback\TripayCallbackController;
use App\Http\Controllers\Api\V1\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Webhook/Callback routes (no auth)
Route::post('/callback/tripay', [TripayCallbackController::class, 'handle'])
    ->name('api.callback.tripay');

/*
|--------------------------------------------------------------------------
| API V1 Routes (Sanctum Protected)
|--------------------------------------------------------------------------
*/
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    // User endpoints
    Route::get('/user', [UserController::class, 'profile'])->name('api.v1.user.profile');
    Route::get('/user/credit', [UserController::class, 'credit'])->name('api.v1.user.credit');
});

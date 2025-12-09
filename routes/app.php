<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\App\Dashboard;
use App\Livewire\App\Account\Index as AccountIndex;
use App\Livewire\App\ActivityLogs;
use App\Livewire\App\Credits\Index as CreditsIndex;
use App\Livewire\App\Credits\History as CreditsHistory;
use App\Livewire\App\Orders\Index as OrdersIndex;
use App\Livewire\App\Orders\Show as OrdersShow;
use App\Livewire\App\Tickets\Index as TicketsIndex;
use App\Livewire\App\Tickets\Create as TicketsCreate;
use App\Livewire\App\Tickets\Show as TicketsShow;
use App\Livewire\App\ApiTokens\Index as ApiTokensIndex;
use App\Livewire\App\News\Index as NewsIndex;
use App\Livewire\App\News\Show as NewsShow;

// Dashboard
Route::get('/', Dashboard::class)->name('index');

// Account Settings
Route::get('/account', AccountIndex::class)->name('account');

// Activity Logs
Route::get('/activity-logs', ActivityLogs::class)->name('activity-logs');

// Credit System Routes
Route::get('/credits', CreditsIndex::class)->name('credits.index');
Route::get('/credits/history', CreditsHistory::class)->name('credits.history');

// Orders
Route::get('/orders', OrdersIndex::class)->name('orders.index');
Route::get('/orders/{order}', OrdersShow::class)->name('orders.show');

// Support Tickets
Route::get('/tickets', TicketsIndex::class)->name('tickets.index');
Route::get('/tickets/create', TicketsCreate::class)->name('tickets.create');
Route::get('/tickets/{ticket}', TicketsShow::class)->name('tickets.show');

// API Tokens
Route::get('/api-tokens', ApiTokensIndex::class)->name('api-tokens.index');

// News & Announcements
Route::get('/news', NewsIndex::class)->name('news.index');
Route::get('/news/{news}', NewsShow::class)->name('news.show');

// Referral System
Route::get('/referral', \App\Livewire\App\Referral\Index::class)->name('referral.index');
Route::get('/referral/withdrawals', \App\Livewire\App\Referral\Withdrawals::class)->name('referral.withdrawals');

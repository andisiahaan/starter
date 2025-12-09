<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Users\Index as UsersIndex;
use App\Livewire\Admin\Roles\Index as RolesIndex;
use App\Livewire\Admin\Permissions\Index as PermissionsIndex;
use App\Livewire\Admin\Settings\Index as SettingsIndex;
use App\Livewire\Admin\ProductCategories\Index as ProductCategoriesIndex;
use App\Livewire\Admin\Products\Index as ProductsIndex;
use App\Livewire\Admin\PaymentMethods\Index as PaymentMethodsIndex;
use App\Livewire\Admin\Orders\Index as OrdersIndex;
use App\Livewire\Admin\CreditLogs\Index as CreditLogsIndex;
use App\Livewire\Admin\Pages\Index as PagesIndex;
use App\Livewire\Admin\News\Index as NewsIndex;
use App\Livewire\Admin\Tickets\Index as TicketsIndex;
use App\Livewire\Admin\Tickets\Show as TicketsShow;
use App\Livewire\Admin\Posts\Index as PostsIndex;

Route::get('/', Dashboard::class)->name('index');
Route::get('/users', UsersIndex::class)->name('users.index');
Route::get('/roles', RolesIndex::class)->name('roles.index');
Route::get('/permissions', PermissionsIndex::class)->name('permissions.index');
Route::get('/settings', SettingsIndex::class)->name('settings');

// Credit System Routes
Route::get('/product-categories', ProductCategoriesIndex::class)->name('product-categories.index');
Route::get('/products', ProductsIndex::class)->name('products.index');
Route::get('/payment-methods', PaymentMethodsIndex::class)->name('payment-methods.index');
Route::get('/orders', OrdersIndex::class)->name('orders.index');
Route::get('/credit-logs', CreditLogsIndex::class)->name('credit-logs.index');

// Content Management
Route::get('/pages', PagesIndex::class)->name('pages.index');
Route::get('/news', NewsIndex::class)->name('news.index');
Route::get('/posts', PostsIndex::class)->name('posts.index');

// Support
Route::get('/tickets', TicketsIndex::class)->name('tickets.index');
Route::get('/tickets/{ticket}', TicketsShow::class)->name('tickets.show');

// Referral System
Route::get('/referrals', \App\Livewire\Admin\Referrals\Index::class)->name('referrals.index');
Route::get('/commissions', \App\Livewire\Admin\Referrals\Commissions::class)->name('commissions.index');
Route::get('/withdrawals', \App\Livewire\Admin\Withdrawals\Index::class)->name('withdrawals.index');


<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::middleware('web')
                ->group(function () {
                    Route::middleware(['auth', 'role:admin|superadmin'])
                        ->prefix('admin')
                        ->name('admin.')
                        ->group(base_path('routes/admin.php'));

                    Route::middleware(['auth', 'verified.dynamic'])
                        ->prefix('app')
                        ->name('app.')
                        ->group(base_path('routes/app.php'));
                });

            // Blog routes (public, no auth required)
            Route::middleware('web')
                ->group(base_path('routes/blog.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Append SetLocale to web middleware group
        $middleware->web(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);

        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'verified.dynamic' => \App\Http\Middleware\EnsureEmailIsVerified::class,
            'locale' => \App\Http\Middleware\SetLocale::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

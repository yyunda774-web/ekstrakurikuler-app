<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {

        // Register middleware aliases
        $middleware->alias([
            'auth' => Illuminate\Auth\Middleware\Authenticate::class,
            'guest' => Illuminate\Auth\Middleware\RedirectIfAuthenticated::class,
            'throttle' => Illuminate\Routing\Middleware\ThrottleRequests::class,

            // middleware custom
            'admin' => App\Http\Middleware\AdminMiddleware::class,
            'pembina' => App\Http\Middleware\PembinaMiddleware::class, // ✅ TAMBAHKAN INI
        ]);

        // Middleware group WEB
        $middleware->group('web', [
            Illuminate\Cookie\Middleware\EncryptCookies::class,
            Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            Illuminate\Session\Middleware\StartSession::class,
            Illuminate\View\Middleware\ShareErrorsFromSession::class,
            Illuminate\Routing\Middleware\SubstituteBindings::class,
            // App\Http\Middleware\VerifyCsrfToken::class,
        ]);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })

->create();
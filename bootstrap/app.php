<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\RedirectIfAuthenticated;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Configure aliases for middleware
        $middleware->alias([
            'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
            'guest' => \Illuminate\Auth\Middleware\RedirectIfAuthenticated::class,
        ]);

        // Laravel 11/12 way to handle guard-specific redirects for unauthenticated users
        Authenticate::redirectUsing(function (Request $request) {
            if (!$request->expectsJson()) {
                // Determine which login route to use based on the URL pattern
                if ($request->is('admin/*') || $request->is('admin')) {
                    return route('admin.login');
                } elseif ($request->is('seller/*') || $request->is('seller')) {
                    return route('seller.login');
                }
                return route('login');
            }

            return null;
        });

        // Configure RedirectIfAuthenticated middleware for different guards
        RedirectIfAuthenticated::redirectUsing(function (Request $request) {
            // Since only the request object is passed, we inspect its route
            // to determine which guard triggered the 'guest' middleware.
            $middleware = collect($request->route()->middleware())->first(function ($middleware) {
                return str_starts_with($middleware, 'guest:');
            });

            $guard = $middleware ? substr($middleware, 6) : null;

            switch ($guard) {
                case 'admin':
                    return route('admin.dashboard');
                case 'seller':
                    return route('seller.dashboard');
                default:
                    return route('buyer.home');
            }
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
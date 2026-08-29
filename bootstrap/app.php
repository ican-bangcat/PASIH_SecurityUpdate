<?php

use App\Http\Middleware\EnsureUserRole;
use App\Http\Middleware\LogUserActivity;
use App\Http\Middleware\XssSanitization;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Exceptions\PostTooLargeException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            XssSanitization::class,
            LogUserActivity::class,
        ]);

        $middleware->alias([
            'role' => EnsureUserRole::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (PostTooLargeException $e) {
            return response()->view('errors.413', [], 413);
        });
    })->create();

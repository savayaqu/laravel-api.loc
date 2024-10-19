<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        apiPrefix: 'api',
    )
    ->withMiddleware(function (Middleware $middleware) {
       // throw new \App\Exceptions\ApiException(401, 'Unauthorized');
        $middleware->redirectTo(fn() => throw new \App\Exceptions\ApiException(401, 'Вы не авторизированы'));
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

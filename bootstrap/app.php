<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CacheHeaders;
use App\Http\Middleware\RedirectMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Регистрируем алиасы
        $middleware->alias([
            'admin' => AdminMiddleware::class,
            'cache.headers' => CacheHeaders::class,
            'redirect' => RedirectMiddleware::class,
        ]);
        
        // Добавляем middleware глобально для всех web-маршрутов
        $middleware->web(append: [
            CacheHeaders::class,
            RedirectMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
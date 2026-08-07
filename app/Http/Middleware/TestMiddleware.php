<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Пишем в лог при вызове
        \Log::info('🔥 TEST MIDDLEWARE CALLED for: ' . $request->getPathInfo());
        
        $response = $next($request);
        
        // Добавляем тестовый заголовок
        $response->headers->set('X-Test-Middleware', 'Working!');
        
        return $response;
    }
}
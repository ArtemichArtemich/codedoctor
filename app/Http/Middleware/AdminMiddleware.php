<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            // Для API или JSON запросов
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Не авторизован'], 401);
            }
            return redirect()->route('login');
        }

        // Проверяем, является ли пользователь администратором
        if (!Auth::user()->is_admin) {
            // Для API или JSON запросов
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Доступ запрещен. Требуются права администратора.'], 403);
            }
            abort(403, 'Доступ запрещен. Только для администраторов.');
        }

        return $next($request);
    }
}
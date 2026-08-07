<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Redirect;
use Illuminate\Http\Request;

class RedirectMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Получаем полный путь
        $path = $request->path();
        
        // Ищем точное совпадение
        $redirect = Redirect::where('from_url', $path)
                            ->where('is_active', true)
                            ->first();
        
        if ($redirect) {
            $redirect->increment('hits');
            return redirect($redirect->to_url, $redirect->status_code);
        }
        
        return $next($request);
    }
}
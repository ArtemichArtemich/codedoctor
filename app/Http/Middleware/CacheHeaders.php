<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CacheHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        
        // Для всех GET запросов
        if ($request->isMethod('GET')) {
            $path = $request->getPathInfo();
            
            // Полностью очищаем старые заголовки кэширования
            $response->headers->remove('Cache-Control');
            $response->headers->remove('Pragma');
            $response->headers->remove('Expires');
            
            // Статические ресурсы - долгий кэш
            if (preg_match('/\.(js|css|png|jpg|jpeg|gif|ico|webp|svg|woff2|ttf|eot)$/', $path)) {
                $response->headers->set('Cache-Control', 'public, max-age=31536000, immutable');
                $response->headers->set('Expires', gmdate('D, d M Y H:i:s \G\M\T', time() + 31536000));
            }
            // HTML страницы - короткий кэш
            else {
                $response->headers->set('Cache-Control', 'public, max-age=3600, stale-while-revalidate=86400');
                $response->headers->set('Expires', gmdate('D, d M Y H:i:s \G\M\T', time() + 3600));
            }
        }
        
        return $response;
    }
}
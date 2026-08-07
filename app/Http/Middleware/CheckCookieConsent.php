<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCookieConsent
{
    public function handle(Request $request, Closure $next)
    {
        // Проверяем согласие на cookies
        $consent = $request->cookie('cookie_consent');
        $consentDate = $request->cookie('cookie_consent_date');
        
        // Если согласие есть и не просрочено - пропускаем
        if ($consent && $consentDate) {
            $oneWeekAgo = time() - (7 * 24 * 60 * 60);
            if ((int)$consentDate > $oneWeekAgo) {
                return $next($request);
            }
        }
        
        // Передаем информацию о необходимости согласия в представление
        $request->attributes->set('show_cookie_consent', true);
        
        return $next($request);
    }
}
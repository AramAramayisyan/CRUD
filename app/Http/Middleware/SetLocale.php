<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = $request->session()->get('locale', config('app.locale'));
        App::setLocale($locale);

        $fallbackLocale = config('app.fallback_locale', 'en');
        App::setFallbackLocale($fallbackLocale);

        setlocale(LC_TIME, $locale);

        if (function_exists('setlocale')) {
            setlocale(LC_ALL, $locale . '.UTF-8');
        }

        return $next($request);
    }
}

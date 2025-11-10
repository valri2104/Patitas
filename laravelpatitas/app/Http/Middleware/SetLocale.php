<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $sessionLocale  = Session::get('locale');
        $defaultLocale  = Config::get('app.locale', 'es');
        $selectedLocale = in_array($sessionLocale, ['es', 'en'], true) ? $sessionLocale : $defaultLocale;

        App::setLocale($selectedLocale);

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLanguage
{
    /**
     * Set locale (language) of a single incoming request during runtime.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->get('language', app()->getLocale());
        // Modify the default language for a single HTTP request at runtime
        // using the setLocale method provided by the App facade:
        App::setLocale($locale);
        $request->headers->set('Accept-Language', $locale);
        return $next($request);
    }
}

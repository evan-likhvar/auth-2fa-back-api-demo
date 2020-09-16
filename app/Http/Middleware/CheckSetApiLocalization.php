<?php

namespace App\Http\Middleware;

use Closure;
use App;

class CheckSetApiLocalization
{
    /**
     * Handle an incoming request.
     *
     * Если заголовок запроса содержит ключ Localization
     * устанавливаем locale соответственно запрошенному ключу
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if( in_array($request->header('Localization'), config('app.locales'))) {
            App::setLocale($request->header('Localization'));
        }

        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Repositories\Google\Google2FAAuthenticator;
use Closure;
use Illuminate\Http\Request;

class Google2FAMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $input = $request->all();
        if (array_key_exists('2fa_code',$input) && empty($input['2fa_code'])) {
            $input['2fa_code'] = '111111';
        }
        $request->replace($input);

        $authentication = app(Google2FAAuthenticator::class)->boot($request);

        if ($authentication->isAuthenticated()) {
            return $next($request);
        }

        return $authentication->makeRequestOneTimePasswordResponse();
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class HeadersMiddleware
{
    /**
     * Handle an incoming request.
     * Set default request header to api query.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->isJson()){
            $request->headers->set('Accept', 'application/json');
            $request->headers->set('Content-Type', 'application/json');
        }
        //$request->headers->set('Access-Control-Allow-Origin','*');
        $request->headers->set('Access-Control-Allow-Methods','GET, POST, PUT, DELETE, OPTIONS');

        return $next($request);
    }
}

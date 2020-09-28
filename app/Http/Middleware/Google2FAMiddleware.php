<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Hash;
use Illuminate\Http\JsonResponse as IlluminateJsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class Google2FAMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var User $user */
        $user = $request->user();

        // по 2аф роутам юзеры ВСЕГДА должны быть авторизированными
        if (empty($user))
            return new IlluminateJsonResponse('Non authenticate request', 403);

        // пользователь не включил 2fa, пробрасываем без проверки
        if (!$user->google2fa_enable)
            return $next($request);

        $token2f = $request->headers->get('usersecret', '');
        if (empty($token2f))
            return new IlluminateJsonResponse('Wrong token', 403);

        // проверяем время от последнего 2фа логина
        if (
            !$user->google2fa_login_at
            || Carbon::createFromFormat(
                'Y-m-d H:i:s',
                $user->google2fa_login_at
            )->addMinutes(config('param.2fa_login_time_out')) < Carbon::now())
            return new IlluminateJsonResponse('2fa login expired', 401);

        // проверяем токен
        if (!Hash::check($token2f, $user->google2fa_login_otp))
            return new IlluminateJsonResponse('Invalid credentials', 401);

        return $next($request);
    }
}

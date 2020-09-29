<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ApiG2FAController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function show2faActivate()
    {
        $user = Auth::user();

        $google2Fa = (new \PragmaRX\Google2FAQRCode\Google2FA());

        if (!$user->google2fa_secret) {
            $user->google2fa_secret = $google2Fa->generateSecretKey();
            $user->save();
        }
        $renderer = new ImageRenderer(new RendererStyle(400), new SvgImageBackEnd());
        $writer = new Writer($renderer);

        $code = $google2Fa->getQRCodeUrl(
            config('google2fa.company'),
            $user->email,
            $user->google2fa_secret
        );
        $inlineUrl = $writer->writeString($code);

        return response()->json([
            'google2fa_url' => $inlineUrl,
            'activation_status' => $user->google2fa_enable
        ]);
    }

    public function enable2fa(Request $request)
    {
        $request->validate(['pin' => 'required|digits:6']);
        $user = Auth::user();
        $google2Fa = new \PragmaRX\Google2FALaravel\Google2FA($request);
        if (!$google2Fa->verifyKey($user->google2fa_secret, $request->input('pin'), 8))
            return response()->json('Activation failed', 403);

        $user->google2fa_enable = 1;
        $user->save();
        //$google2Fa->login(); Логин в вендоре просто пишет в сессию признак :(
        return response()->json(['code' => $user->google2fa_secret, 'status' => $user->google2fa_enable], 200);
    }

    public function disable2fa(Request $request)
    {
        $request->validate(['pin' => 'required|digits:6']);
        $user = Auth::user();

        $google2Fa = new \PragmaRX\Google2FALaravel\Google2FA($request);

        if (!$google2Fa->verifyKey($user->google2fa_secret, $request->input('pin'), 8))
            return response()->json('2fa is not valid', 500);

        $user->google2fa_enable = 0;
        $user->save();

        return response()->json(['status' => $user->google2fa_enable], 200);
    }

    public function login2fa(Request $request)
    {
        $request->validate(['pin' => 'required|digits:6']);
        $user = Auth::user();
        $google2Fa = new \PragmaRX\Google2FALaravel\Google2FA($request);
        if (!$google2Fa->verifyKey($user->google2fa_secret, $request->input('pin'), 8))
            return response()->json('2FA verification failed', 403);

        $token2fa = Str::random();
        $user->google2fa_login_at = Carbon::now();
        $user->google2fa_login_otp = Hash::make($token2fa);
        $user->save();

        return response()->json( $token2fa, 200);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class G2FAController extends Controller
{
    public function verify()
    {
        if (!strpos(URL()->previous(), 'profile/2fa/verify')) {
            session(['url.intended' => url()->previous()]);
        }

        return redirect()->intended('/profile');
        //return redirect(session('url.intended') ?? '/profile');
        //return redirect(URL()->previous());
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

        //dd($code, $inlineUrl);

        return view('auth.google2fa-activate')->with([
            'user' => $user,
            'google2fa_url' => $inlineUrl,
            'activation_status' => $user->google2fa_enable
        ]);
    }

    public function enable2fa(Request $request)
    {
        session()->flash('2fa', '2fa');

        $request->validate([
            'pin' => 'required|digits:6'
        ]);

        $user = Auth::user();
        $google2Fa = new \PragmaRX\Google2FALaravel\Google2FA($request);

        if ($google2Fa->verifyKey($user->google2fa_secret, $request->input('pin'), 8)) {
            $user->google2fa_enable = 1;
            $user->save();
            $google2Fa->login();
            if ($request->ajax())
                return response()->json(['result' => 'success', 'data' => ['code' => $user->google2fa_secret]], 200);

            return redirect(route('profile.2fa.activate.show'))
                ->with('status', 'Please save you 2fa secret <b>' . $user->google2fa_secret . '</b>');

        } else {
            if ($request->ajax())
                return response()->json(['result' => 'error', 'errors' => ['error' => ['Activation failed']]], 500);
            return redirect(route('profile.2fa.activate.show'))->with('error', 'code activation failed');
        }

    }

//    public function disable2fa(Request $request)
//    {
//        session()->flash('2fa', '2fa');
//
//        $request->validate([
//            'pin' => 'required|digits:6'
//        ]);
//
//        $google2Fa = new \PragmaRX\Google2FALaravel\Google2FA($request);
//
//        if (!$google2Fa->verifyKey($this->user->passwordGoogleSecurity->google2fa_secret, $request->input('pin'), 8)) {
//            if ($request->ajax())
//                return response()->json(['result' => 'error', 'errors' => ['error' => ['2fa is not valid']]], 500);
//            return redirect(route('profile.settings.tabs'))->with('error', '2fa is not valid');
//        }
//
////    if (!(Hash::check($request->get('user_password'), $this->user->password))) {
////      if ($request->ajax())
////        return response()->json(['result' => 'error', 'errors' => ['error' => ['Wrong password']]], 500);
////      return redirect(route('profile.settings.tabs'))->with('error', 'Wrong password');
////    }
//
//        $this->user->passwordGoogleSecurity->google2fa_enable = 0;
//        $this->user->passwordGoogleSecurity->save();
//
//        $google2Fa->logout();
//        if ($request->ajax())
//            return response()->json(['result' => 'success', 'data' => ['code' => '2FA deactivated!']], 200);
//        return redirect(route('profile.settings.tabs'))->with('status-disabled', '2fa deactivated!');
//    }
//
}

<?php

namespace App\Http\Controllers;

use PragmaRX\Google2FA\Google2FA;

class ProfileGoogle2FAController extends Controller
{

//    public function index()
//      {
//        $google2Fa = (new Google2FA());
//        if (!$this->user->passwordGoogleSecurity) {
//          $this->user->passwordGoogleSecurity()->create(['google2fa_secret' => $google2Fa->generateSecretKey()]);
//          $this->user->refresh();
//        }
//        $inlineUrl = $google2Fa->getQRCodeInline(
//          config('google2fa.company'),
//          $this->user->email,
//          $this->user->passwordGoogleSecurity->google2fa_secret
//        );
//        return view('auth.google2fa-activate')
//          ->with(['google2fa_url' => $inlineUrl, 'activation_status' => $this->user->passwordGoogleSecurity->google2fa_enable]);
//      }

    public function verify()
    {
        if (!strpos(URL()->previous(), 'profile/2fa/verify')) {
            session(['url.intended' => url()->previous()]);
        }

        return redirect()->intended('/profile');
        //return redirect(session('url.intended') ?? '/profile');
        //return redirect(URL()->previous());
    }

}

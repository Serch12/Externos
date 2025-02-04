<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\Perfil;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    


    /**
     *Funcion que mostrara  la vista de reset 
     **/
    public function index(){
        // $imagen = Perfil::select('foto')->where('id',auth()->user()->id)->first();
        $imagen = new \stdClass();
        $imagen->foto = 'sinfoto';
            return view('auth.passwords.email')->with(['imagen' => $imagen]);
    }

    public function showResetForm($token, $email)
    {
        return view('auth.passwords.reset', ['token' => $token, 'email' => $email]);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function credentials(Request $request)
    {
        return [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'estatus' => 1, // Solo usuarios activos (estatus = 1)
        ];
    }

    /**
     * Sobrescribir el mensaje de error de login
     */
    protected function sendFailedLoginResponse(Request $request){
        $errors = [];

        $user = User::where('email', $request->email)->first();

        // Validar correo
        if (!$user) {
            $errors['email'] = 'El correo no está registrado.';
        } else {
            // Validar contraseña
            if (!Hash::check($request->password, $user->password)) {
                $errors['password'] = 'La contraseña es incorrecta.';
            }
        }

        // Si el usuario existe pero está inactivo
        if ($user && $user->estatus == 0) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'email' => ['Tu cuenta está inactiva. Contacta al administrador.'],
            ]);
        }

        if (!empty($errors)) {
            throw \Illuminate\Validation\ValidationException::withMessages($errors);
        }

        // Mensaje de respaldo si algo raro pasa
        throw \Illuminate\Validation\ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
}

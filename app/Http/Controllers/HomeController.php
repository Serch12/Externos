<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use DB;
use Hash;
use Cookie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        if (auth()->check()) {
            $info_usuario = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('roles.name as rol','users.*')
            ->where('users.id', auth()->user()->id)
            ->first();
            $rol_usuario = $info_usuario->rol;
            // $imagen = Perfil::select('foto')->where('id_user',auth()->user()->id)->first();
            return view('home')->with(['rol_usuario' => $rol_usuario]);
        }else {
            return view('auth.login');
        }
    }
}

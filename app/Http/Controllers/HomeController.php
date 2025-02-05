<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Usuarios;
use App\Models\Perfil;
use App\Models\Sedes;
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
            ->join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->select('roles.name as rol', 'users.id', 'users.name', 'users.email','users.sede', DB::raw('GROUP_CONCAT(permissions.name) as permisos'))
            ->where('users.id', auth()->user()->id)
            ->groupBy('users.id', 'users.name', 'users.email', 'roles.name','users.sede')
            ->first();
            $contraseña = Usuarios::select('acceso')->where('id',auth()->user()->id)->first();
            $password = $contraseña->acceso;
            $rol_usuario = $info_usuario->rol;
            $permisos = explode(',', $info_usuario->permisos);
            $imagen = Perfil::select('foto')->where('id',auth()->user()->id)->first();
            if ($imagen == null) {
                $imagen = new \stdClass();
                $imagen->foto = 'sinfoto';
            }
            if ($info_usuario->sede !=0) {
                $info = Sedes::select('nombre')->where('id_sede',$info_usuario->sede)->first();
                $sede = $info->nombre;
            }else{
                $sede = 'Proceso';
            }
            return view('home')->with(['rol_usuario' => $rol_usuario,'imagen' => $imagen,'sede'=>$sede,'permisos'=>$permisos,'password'=>$password]);
        }else {
            return view('auth.login');
        }
    }

    /**
     * FUNCION QUE ACTUALIZARA LA CONTRASEÑA DEL PERFIL
     **/
    public function cambioPassword(Request $request){
        $user = User::find($request->id);
        $user -> password = Hash::make($request->password);
        $user -> acceso = 1;
        $user->save();      
        return $user;
    }
}

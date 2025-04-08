<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Usuarios;
use App\Models\Perfil;
use App\Models\Sedes;
use App\Models\Jugadores;
use App\Models\Torneo;
use App\Models\Recordatorio;
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
            $existJugador = Jugadores::count() > 0;
            return view('home')->with(['rol_usuario' => $rol_usuario,'imagen' => $imagen,'sede'=>$sede,'permisos'=>$permisos,'password'=>$password,'existJugador'=>$existJugador]);
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

    /**
     * funcion que mostrara la informacion de cada seccion en el calendario
     **/
    public function Calendario(Request $request){
        $torneo = Torneo::select('*')->get();
        $nota = Recordatorio::select('*')->get();

        return response()->json(['calendario'=> [
            'torneo' => $torneo,
            'nota'=>$nota
        ]]);
    }

    /**
     * funcioon que mostrara la informacion de cada seccion en el calendario
     **/
    public function RecordatorioCreate(Request $request){
        $new = new Recordatorio();
        $new -> id_user = $request->id_user;
        $new -> titulo = $request->titulo;
        $new -> fecha_inicia = $request->fecha_inicia;
        $new -> fecha_termina = $request->fecha_fin;
        $new -> descripcion = $request->descripcion;
        $new -> estatus = 0;
        $new -> save();

        return $new;
    }

    /**
     * Funcion que editara el recordatorio
     **/
    public function RecordatorioUpdate(Request $request){
        $edit = Recordatorio::find($request->id_recordario);
        $edit -> titulo = $request->titulo;
        $edit -> fecha_inicia = $request->fecha_inicia;
        $edit -> fecha_termina = $request->fecha_termina;
        $edit -> descripcion = $request->descripcion;
        $edit -> save();

        return $edit;
    }

     /**
     * Funcion que editara el recordatorio
     **/
    public function RecordatorioDelete(Request $request){

        $delete = Recordatorio::find($request->id_recordario);

        $delete -> delete();

        return $delete;
    }
}

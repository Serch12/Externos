<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfil;
use App\Models\Sedes;
use DB;
use Cookie;

class PerfilController extends Controller
{
    /**
     * FUNCION QUE INICIA LA VISTA
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
            return view('Perfil.principal')->with(['rol_usuario' => $rol_usuario,'imagen' => $imagen,'sede'=>$sede,'permisos'=>$permisos]);
        }else {
            return view('auth.login');
        }
    }
    /**
     * FUNCION QUE MUESTRA EL PERFIL DEL USUARIO LOGUEADO 
     **/
    public function getPerfil(Request $request){

        $perfil = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->join('tbl_perfil','tbl_perfil.id','=','users.id')
            ->select('roles.name as rol', 'users.id', 'users.name','users.estatus', 'users.email','users.sede','tbl_perfil.*')
            ->where('users.id', $request->id)
            ->first();

        return response()->json(['perfil'=>$perfil]);
    }

    /**
     * FUNCIION QUE CREARA EL PERFIL
     **/
    public function createPerfil(Request $request){

        $perfil = new Perfil();
        $perfil -> id = $request->id;
        $perfil -> nombre = $request->nombre;
        $perfil -> apellido_paterno = $request->apellido_paterno;
        $perfil -> apellido_materno = $request->apellido_materno;
        $perfil -> direccion = $request->direccion;
        $perfil -> telefono = $request->telefono;
        $perfil -> cumpleaños = $request->cumpleaños;
        $file = $request->file('foto');
        if (isset($file)) {
            // \Storage::disk('perfil')->delete($request->foto_eliminar);
            $file = $request->file('foto');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $url = $request->id."/".$nombre;
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('perfil')->put($url,  \File::get($file));
            $perfil->foto = $url; 
        }
        $perfil -> save();
    }
}

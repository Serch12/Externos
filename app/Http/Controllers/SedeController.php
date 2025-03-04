<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sedes;
use App\Models\Perfil;
use App\Models\Usuarios;
use DB;
use Hash;

class SedeController extends Controller
{   
    /**
     * FUNCION QUE MUESTRA LA VISTA
     **/
    public function index(){
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
            return view('Sedes.principal')->with(['rol_usuario' => $rol_usuario,'imagen' => $imagen,'sede'=>$sede,'permisos'=>$permisos]);
        }else {
            return view('auth.login');
        }
    }

    /**
     * Funcion que muestra los roles
     **/

    public function Busqueda(){
        $sedes = Sedes::select('*')->get();
        foreach ($sedes as $s) {
            $s->total_usuarios = Usuarios::where('sede', $s->id_sede)->count();
        }
        
        return response()->json(['sedes' => $sedes]);
    }


    /**
     * FUNCION QUE CREARA LA SEDE
     **/
    public function createSede(Request $request){

        $new = new Sedes();
        $new -> nombre = $request->nombre;
        $new -> ubicacion = $request->ubicacion;
        $new -> lugar_entrenamiento = $request->lugar_entrenamiento;
        $new -> contactos = $request->contactos;
        $new -> fecha_registro = $request->fecha_registro;
        $new -> estatus_sede = 0;
        $new -> save();
        return $new;
    }

    /**
     * FUNCION QUE editara LA SEDE
     **/
    public function updateSede(Request $request){

        $new = Sedes::find($request->id_sede);
        $new -> nombre = $request->nombre;
        $new -> ubicacion = $request->ubicacion;
        $new -> lugar_entrenamiento = $request->lugar_entrenamiento;
        $new -> contactos = $request->contactos;
        $new -> fecha_registro = $request->fecha_registro;
        $new -> save();
        return $new;
    }

    /**
     * FUNCION QUE ELIMINARA LA SEDE
     **/
    public function deleteSede($id) {
        $delete = Sedes::find($id);
        $delete -> delete();
    }


    /**
     * FUNCION QUE MOSTRARA LA INFORMACION DE LA SEDE COMO QUIEN ESTA EN ESA SEDE Y LA CANTIDAD
     **/
    public function infoSede($id){
        $user = Usuarios::where('sede',$id)->get();
        return response()->json(['user'=>$user]);
    }
}

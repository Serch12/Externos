<?php


namespace App\Repositories;
use App\Models\Torneo;
use App\Models\DocumentosJugadores;
use Carbon\Carbon;
use Mail;
use DB;
use Hash;
use Cookie;

class TorneoRepository
{  

    /**
     * funcion que retorna el rol del usuario
     */
    public function rolUsuarioGeneral(){
        return DB::table('users')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
        ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
        ->select('roles.name as rol', 'users.id', 'users.name', 'users.email','users.sede', DB::raw('GROUP_CONCAT(permissions.name) as permisos'))
        ->where('users.id', auth()->user()->id)
        ->groupBy('users.id', 'users.name', 'users.email', 'roles.name','users.sede')
        ->first();

    }

    /**
     * FUNCION QUE MUESTRA LOS JUGADORES
     **/
    public function getTorneo($request){
        $rol = $request->rol;
        $sede = $request->sede;
        $parametro = $request->buscador;
        if ($rol == 'Root'||$rol == 'Administrador') {
            $respuesta = Torneo::select('*')
            ->where(function($query) use ($parametro) {
                $query->where('torneo','LIKE','%'.$parametro.'%');
            })
            ->orderBy('id_torneo','DESC')
            ->paginate(10); 
        }else{
            $respuesta = Torneo::select('*')
            ->where(function($query) use ($parametro) {
                $query->where('torneo','LIKE','%'.$parametro.'%');
            })
            ->where('sede',$sede)
            ->where('estatus',0)
            ->orderBy('id_torneo','DESC')
            ->paginate(10); 
        }
        return $respuesta;
    }

    
    /**
     * Funcion que creara el torneo
     **/
    public function createTorneo($request){
        $new = new Torneo();
        $new -> creacion = $request -> creacion;
        $new -> torneo = $request -> torneo;
        $new -> categoria = $request -> categoria;
        $new -> sede = $request -> sede;
        $new -> direccion = $request -> direccion;
        $new -> fecha_inicia = $request -> fecha_inicia;
        $new -> fecha_fin = $request -> fecha_fin;
        $new -> contacto = $request -> contacto;
        $new -> save ();
        return $new;
    }
}
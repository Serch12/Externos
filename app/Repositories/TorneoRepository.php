<?php


namespace App\Repositories;
use App\Models\Torneo;
use App\Models\Jugadores;
use App\Models\PlantillaJugador;
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

     /**
     * Funcion que creara el torneo
     **/
    public function updateTorneo($request){
        $edit = Torneo::find($request->id_torneo);
        $edit -> torneo = $request -> torneo;
        $edit -> categoria = $request -> categoria;
        $edit -> sede = $request -> sede;
        $edit -> direccion = $request -> direccion;
        $edit -> fecha_inicia = $request -> fecha_inicia;
        $edit -> fecha_fin = $request -> fecha_fin;
        $edit -> contacto = $request -> contacto;
        $edit -> save ();
        return $edit;
    }

    /**
     * FUNCION QUE MOSTRARA LOS JUGADORES DE LA SEDE Y CATEGORIA
     **/
    public function plantillaJugador($categoria,$sede){
        $respuesta = Jugadores::select('*')
            ->where('categoria',$categoria)
            ->where('sede',$sede)
            ->where('estatus',0)
            ->orderBy('id_jugador','DESC')
            ->get(); 
        return $respuesta;
    }

    /**
     * FUNCION QUE MOSTRARA LOS JUGADORES DE LA CATEGORIA A PRESTAMO
     **/
    public function prestamoJugador($categoria,$sede){
        $respuesta = Jugadores::select('*')
            ->where('categoria',$categoria)
            ->where('sede','!=',$sede)
            ->where('estatus',0)
            ->orderBy('id_jugador','DESC')
            ->get(); 
        return $respuesta;
    }

    /**
     * FUNCION QUE MOSTRARA LOS JUGADORES SELECCIONADOS DE ESE TORNEO
     **/
    public function detalleSeleccionado($id){
        $note = PlantillaJugador::where('id_torneo',$id)
        ->select('*')
        ->get();
        return $note;
    }

    /**
     * FUNCION QUE AGREGA LOS JUGADORES SELCCIONADOS
     **/
    public function seleccionadosJugador($request){
        $seleccion = json_decode($request->selecccion);
        if ($request->bandera === 'individual') {
           
            $new = new PlantillaJugador();
            $new -> id_torneo = $request -> id_torneo;
            $new -> folio = $seleccion -> folio;
            $new -> nombre = $seleccion -> nombre;
            $new -> posicion = $seleccion -> posicion;
            $new -> sexo = $seleccion -> sexo;
            $new -> edad = $seleccion -> edad;
            $new -> categoria = $seleccion -> categoria;
            $new -> sede = $seleccion -> sede;
            $new -> save();
        }
        if ($request->bandera === 'multiple') {
            foreach ($seleccion as $value) {

                $new = new PlantillaJugador();
                $new -> id_torneo = $request -> id_torneo;
                $new -> folio = $value -> folio;
                $new -> nombre = $value -> nombre;
                $new -> posicion = $value -> posicion;
                $new -> sexo = $value -> sexo;
                $new -> edad = $value -> edad;
                $new -> categoria = $value -> categoria;
                $new -> sede = $value -> sede;
                $new -> save();
            } 
        }
        
        return $new;
    }
    /**
     * FUNCIION QUE ELIMINARA LOS JUGADORES 
     **/
    public function deleteJugador($request){
        if ($request->bandera === 'multi') {
            # code...
        }
        if ($request->bandera === 'unico') {
            $delete = PlantillaJugador::find($request->id_plantilla);
            $delete -> delete();
        }
    }
}
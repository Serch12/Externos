<?php


namespace App\Repositories;
use App\Models\Torneo;
use App\Models\Jugadores;
use App\Models\PlantillaJugador;
use App\Models\ProveedoresIntranet;
use App\Models\NotificacionIntranet;
use App\Models\Notas;
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

    /**
     * Mostrara informacion externa del torneo
     **/
    public function Bancarios($id){
       $bancario = ProveedoresIntranet::where('id_pro',$id)
       ->select('*')
       ->get();
       return $bancario;
    }

    /**
     * Funcion que muestra las notas de rechazo
     **/
    public function NotasDetalle($id) {
        $notas = Notas::where('id_modulo',$id)
        ->select('*')
        ->first();
        return $notas;
    }

    /**
     * FUNCION QUE AGREGARA EL DATO BANCARIO
     **/
    public function createDatoBancario($request){
        $new = new ProveedoresIntranet();
        $new -> nombre = $request -> nombre;
        $new -> id_user = 5;
        $new -> rfc = $request -> rfc;
        $new -> banco = $request -> banco;
        $new -> ctaBanc = $request -> cuenta_bancaria;
        $new -> cbeBanc = $request -> clabe_bancaria;
        $new -> direccion = $request -> direccion;
        $new -> telefono = $request -> telefono;
        $new -> mail = $request -> mail;
        $new -> ejecutivo = $request -> ejecutivo;
        $new -> tipo_persona = $request -> tipo_persona;
        $new -> estatus = 1;
        $new ->save();

        $edit = Torneo::find($request->id_torneo);
        $file = $request->file('archivo');
        if(isset($file)){
            $file = $request->file('archivo');
            $nombre = $file->getClientOriginalName();
            $urlimagen = $request->id_torneo."/".$nombre;
            \Storage::disk('datobancario')->put($urlimagen, \File::get($file));
            $edit->archivo = $nombre;
        }
        $edit -> id_proveedor = $new -> id_pro;
        $edit -> subtotal = $request -> subtotal;
        $edit -> total = $request -> total;
        $edit -> save();
        return $edit;
    }

    /**
     * FUNCION QUE EDITARA LA FORMA DE PAGO DEL TORNEO
     **/
    public function updateDatoBancario($request){

        $new = ProveedoresIntranet::find($request->id_pro);
        $new -> nombre = $request -> nombre;
        $new -> id_user = 5;
        $new -> rfc = $request -> rfc;
        $new -> banco = $request -> banco;
        $new -> ctaBanc = $request -> ctaBanc;
        $new -> cbeBanc = $request -> cbeBanc;
        $new -> direccion = $request -> direccion;
        $new -> telefono = $request -> telefono;
        $new -> mail = $request -> mail;
        $new -> ejecutivo = $request -> ejecutivo;
        $new -> tipo_persona = $request -> tipo_persona;
        $new ->save();

        $edit = Torneo::find($request->id_torneo);
        $file = $request->file('archivo');
        if(isset($file)){
            \Storage::disk('datobancario')->delete($request->id_torneo.'/'.$edit->archivo);
            $file = $request->file('archivo');
            $nombre = $file->getClientOriginalName();
            $urlimagen = $request->id_torneo."/".$nombre;
            \Storage::disk('datobancario')->put($urlimagen, \File::get($file));
            $edit->archivo = $nombre;
        }
        $edit -> subtotal = $request -> subtotal;
        $edit -> total = $request -> total;
        $edit -> estatus = 0;
        $edit -> save();
        return $new;
    }
    /**
     * FUNCION QUE ACTUALIZARA LOS ESTTAUS DEL TORNEO
     **/
    public function estatusTorneo($request) {

        $bandera = $request-> bandera;
        if ($bandera == 'revision') {
            $t = Torneo::find($request->id_torneo);
            $t -> estatus = 1;
            $t ->save();
        }
        return $t;
    }
}
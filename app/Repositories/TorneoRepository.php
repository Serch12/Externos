<?php


namespace App\Repositories;
use App\Models\Torneo;
use App\Models\Jugadores;
use App\Models\PlantillaJugador;
use App\Models\PlantillaCuerpoTecnico;
use App\Models\FormatoPago;
use App\Models\NotificacionIntranet;
use App\Models\CuerpoTecnico;
use App\Models\Notas;
use App\Models\Talentos;
use App\Models\IMGTalentos;
use Carbon\Carbon;
use DateTime;
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
        if ($rol == 'CM') {
            $respuesta = Torneo::select('*')
            ->where(function($query) use ($parametro) {
                $query->where('torneo','LIKE','%'.$parametro.'%');
            })
            ->where('estatus','=',2)
            ->orderBy('id_torneo','DESC')
            ->paginate(10);
            
            foreach ($respuesta as $t) {
                $fecha = new DateTime($t->fecha_fin);  
                $t->año = $fecha->format('Y'); 
                $t->num_jugadores = PlantillaJugador::where('id_torneo',$t->id_torneo)->count();
            }      
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

        $seleccion = json_decode($request->cargaSeleccionado);
        foreach ($seleccion as $value) {

            $new_plantilla = new PlantillaJugador();
            $new_plantilla -> id_torneo = $new -> id_torneo;
            $new_plantilla -> folio = $value -> folio;
            $new_plantilla -> num_dorsal = $value -> num_dorsal;
            $new_plantilla -> nombre = $value -> nombre;
            $new_plantilla -> posicion = $value -> posicion;
            $new_plantilla -> sexo = $value -> sexo;
            $new_plantilla -> edad = $value -> edad;
            $new_plantilla -> categoria = $value -> categoria;
            $new_plantilla -> sede = $value -> sede;
            $new_plantilla -> prestamo = $value -> prestamo;
            $new_plantilla -> save();
        }
        if ($request->bandera_pago != 'no aplica') {
            $new_pago = new FormatoPago();
            $new_pago -> nombre = $request -> nombre;
            $new_pago -> creacion = $request->$new -> id_torneo;
            $new_pago -> rfc = $request -> rfc;
            $new_pago -> banco = $request -> banco;
            $new_pago -> cuenta_bancaria = $request -> cuenta_bancaria;
            $new_pago -> clabe_bancaria = $request -> clabe_bancaria;
            $new_pago -> direccion = $request -> direccion;
            $new_pago -> telefono = $request -> telefono;
            $new_pago -> email = $request -> email;
            $new_pago -> ejecutivo = $request -> ejecutivo;
            $new_pago -> subtotal = $request -> subtotal;
            $new_pago -> total = $request -> total;
            $new_pago -> tipo_persona = $request -> tipo_persona;
            $new_pago -> inscripcion = $request -> inscripcion;
            $new_pago -> estatus = 0;
            $new_pago ->save();

            $edit = Torneo::find($new->id_torneo);
            $file = $request->file('archivo');
            if(isset($file)){
                $file = $request->file('archivo');
                $nombre = $file->getClientOriginalName();
                $urlimagen = $new->id_torneo."/".$nombre;
                \Storage::disk('datobancario')->put($urlimagen, \File::get($file));
                $edit->archivo = $nombre;
            }
            $edit -> id_proveedor = $new_pago -> id_pro;
            $edit -> subtotal = $request -> subtotal;
            $edit -> total = $request -> total;
            $edit -> save();


            $estatus = Torneo::find($new->id_torneo);
            if ($request->formato == 'almacena') {
                $estatus -> estatus = 0;
            } 
            if($request->formato == 'revision') {
                $estatus -> estatus = 1;
            }
            $estatus -> save();
            
        }


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

        $consulta = PlantillaJugador::where('id_torneo',$request->id_torneo)->get();

        foreach ($consulta as $value) {
            $pe = PlantillaJugador::find($value->id_plantilla);
            $pe -> delete();
        }

        $seleccion = json_decode($request->JugadorSeleccionado);
        foreach ($seleccion as $value) {

            $new_plantilla = new PlantillaJugador();
            $new_plantilla -> id_torneo = $edit -> id_torneo;
            $new_plantilla -> folio = $value -> folio;
            $new_plantilla -> num_dorsal = $value -> num_dorsal;
            $new_plantilla -> nombre = $value -> nombre;
            $new_plantilla -> posicion = $value -> posicion;
            $new_plantilla -> sexo = $value -> sexo;
            $new_plantilla -> edad = $value -> edad;
            $new_plantilla -> categoria = $value -> categoria;
            $new_plantilla -> sede = $value -> sede;
            $new_plantilla -> prestamo = $value -> prestamo;
            $new_plantilla -> save();
        }

        if ($request->bandera == 'sin registro') {
            $new_pago = new FormatoPago();
            $new_pago -> nombre = $request -> nombre;
            $new_pago -> creacion = $request->creacion;
            $new_pago -> rfc = $request -> rfc;
            $new_pago -> banco = $request -> banco;
            $new_pago -> cuenta_bancaria = $request -> cuenta_bancaria;
            $new_pago -> clabe_bancaria = $request -> clabe_bancaria;
            $new_pago -> direccion = $request -> direccion;
            $new_pago -> telefono = $request -> telefono;
            $new_pago -> email = $request -> email;
            $new_pago -> ejecutivo = $request -> ejecutivo;
            $new_pago -> subtotal = $request -> subtotal;
            $new_pago -> total = $request -> total;
            $new_pago -> tipo_persona = $request -> tipo_persona;
            $new_pago -> inscripcion = $request -> inscripcion;
            $new_pago -> estatus = 0;
            $new_pago ->save();
        } else {
            $new_pago = FormatoPago::find($request->id_formato);
            $new_pago -> nombre = $request -> nombre;
            $new_pago -> rfc = $request -> rfc;
            $new_pago -> banco = $request -> banco;
            $new_pago -> cuenta_bancaria = $request -> cuenta_bancaria;
            $new_pago -> clabe_bancaria = $request -> clabe_bancaria;
            $new_pago -> direccion = $request -> direccion;
            $new_pago -> telefono = $request -> telefono;
            $new_pago -> email = $request -> email;
            $new_pago -> ejecutivo = $request -> ejecutivo;
            $new_pago -> subtotal = $request -> subtotal;
            $new_pago -> total = $request -> total;
            $new_pago -> tipo_persona = $request -> tipo_persona;
            $new_pago -> inscripcion = $request -> inscripcion;
            $new_pago -> estatus = 0;
            $new_pago ->save();
        }
        

        $editt = Torneo::find($edit->id_torneo);
        $file = $request->file('archivo');
        if(isset($file)){
            $file = $request->file('archivo');
            $nombre = $file->getClientOriginalName();
            $urlimagen = $request->id_torneo."/".$nombre;
            \Storage::disk('datobancario')->put($urlimagen, \File::get($file));
            $editt->archivo = $nombre;
        }
        $editt -> id_proveedor = $new_pago -> id_pro;
        $editt -> subtotal = $request -> subtotal;
        $editt -> total = $request -> total;
        $editt -> estatus = 0;
        $editt -> save();


        return $edit;
    }

    /**
     * FUNCION QUE MOSTRARA LOS JUGADORES DE LA SEDE Y CATEGORIA
     **/
    public function plantillaJugador($categoria,$sede){
        $respuesta = Jugadores::select('*')
        // ->where('categoria', $categoria)
        ->where('estatus', 0)
        ->where(function($query) use ($sede) {
            $query->where('sede', $sede) 
                ->orWhere(function($query) use ($sede) {
                    $query->where('sede', '!=', $sede) 
                        ->where('prestamo', 1);
                });
        })
        ->orderByRaw("sede = ? DESC", [$sede])
        ->orderBy('id_jugador', 'DESC') 
        ->get();

        foreach ($respuesta as $j) {
            if ($j->sede == $sede) {
                $j->zona = 'Local';
            } else {
                $j->zona = 'Foraneo';
            }
        }

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
     * FUNCION QUE MOSTRARA EL CUERPO TECNICO
     **/
    public function plantillaTecnico($sede){

        $respuesta = CuerpoTecnico::select('*')
            ->where('sede','=',$sede)
            ->where('estatus',0)
            ->orderBy('id_cuerpo_tecnico','DESC')
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
            $new -> num_dorsal = $seleccion -> num_dorsal;
            $new -> nombre = $seleccion -> nombre;
            $new -> posicion = $seleccion -> posicion;
            $new -> sexo = $seleccion -> sexo;
            $new -> edad = $seleccion -> edad;
            $new -> categoria = $seleccion -> categoria;
            $new -> sede = $seleccion -> sede;
            $new -> prestamo = $seleccion -> prestamo;
            $new -> save();
        }
        if ($request->bandera === 'multiple') {
            foreach ($seleccion as $value) {

                $new = new PlantillaJugador();
                $new -> id_torneo = $request -> id_torneo;
                $new -> folio = $value -> folio;
                $new -> num_dorsal = $value -> num_dorsal;
                $new -> nombre = $value -> nombre;
                $new -> posicion = $value -> posicion;
                $new -> sexo = $value -> sexo;
                $new -> edad = $value -> edad;
                $new -> categoria = $value -> categoria;
                $new -> sede = $value -> sede;
                $new -> prestamo = $value -> prestamo;
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
       $bancario = FormatoPago::where('creacion',$id)
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
        $new = new FormatoPago();
        $new -> nombre = $request -> nombre;
        $new -> creacion = $request->creacion;
        $new -> rfc = $request -> rfc;
        $new -> banco = $request -> banco;
        $new -> cuenta_bancaria = $request -> cuenta_bancaria;
        $new -> clabe_bancaria = $request -> clabe_bancaria;
        $new -> direccion = $request -> direccion;
        $new -> telefono = $request -> telefono;
        $new -> email = $request -> email;
        $new -> ejecutivo = $request -> ejecutivo;
        $new -> subtotal = $request -> subtotal;
        $new -> total = $request -> total;
        $new -> tipo_persona = $request -> tipo_persona;
        $new -> inscripcion = $request -> inscripcion;
        $new -> estatus = 0;
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

        $new = FormatoPago::find($request->id_formato);
        $new -> nombre = $request -> nombre;
        $new -> rfc = $request -> rfc;
        $new -> banco = $request -> banco;
        $new -> cuenta_bancaria = $request -> cuenta_bancaria;
        $new -> clabe_bancaria = $request -> clabe_bancaria;
        $new -> direccion = $request -> direccion;
        $new -> telefono = $request -> telefono;
        $new -> email = $request -> email;
        $new -> ejecutivo = $request -> ejecutivo;
        $new -> subtotal = $request -> subtotal;
        $new -> total = $request -> total;
        $new -> tipo_persona = $request -> tipo_persona;
        $new -> inscripcion = $request -> inscripcion;
        $new -> estatus = 0;
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

    /**
     * funcion que agrega los tecnicos seleccionados para el torneo
     **/
    public function seleccionTecnico($request){
        $seleccion = json_decode($request->selecccion);

        if ($request->bandera === 'individual') {
           
            $new = new PlantillaCuerpoTecnico();
            $new -> id_torneo = $request -> id_torneo;
            $new -> folio = $seleccion -> folio;
            $new -> nombre = $seleccion -> nombre;
            $new -> puesto = $seleccion -> puesto;
            $new -> sexo = $seleccion -> sexo;
            $new -> edad = $seleccion -> edad;
            $new -> sede = $seleccion -> sede;
            $new -> save();
        }
        if ($request->bandera === 'multiple') {
            foreach ($seleccion as $value) {

                $new = new PlantillaCuerpoTecnico();
                $new -> id_torneo = $request -> id_torneo;
                $new -> folio = $value -> folio;
                $new -> nombre = $value -> nombre;
                $new -> puesto = $value -> puesto;
                $new -> sexo = $value -> sexo;
                $new -> edad = $value -> edad;
                $new -> sede = $value -> sede;
                $new -> save();
            } 
        }
        
        return $new;
    }

    /**
     * funcion que mostrara los tecnicos seleccionados
     **/
    public function selectTecnico($id){

        $data = PlantillaCuerpoTecnico::where('id_torneo',$id)
       ->select('*')
       ->get();

       return $data;
    }

    /**
     * funcion que 
     **/
    public function deleteTecnico($request){

        if ($request->bandera === 'unico') {
            $data = PlantillaCuerpoTecnico::find($request -> id_plantilla_tecnico);
            $data -> delete();
        }
        if ($request->bandera === 'multiple') {
            # code...
        }
        
        return $data;
    }

     /* Funciones que agregara la galeria de imagenes de cada torneo */


     /**
      *  funcion que creara el create de talentos
      **/
    public function createTalentos($request){

        $new = new Talentos();
        $hidder = $request->file('hidder');
        if (isset($hidder)) {
            $file = $request->file('hidder');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $url = $request->copa."-".$request->year."-".$nombre;
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('talentos')->put($url,  \File::get($file));
            $new->hidder = $url;
        }
        $new -> fecha = $request -> fecha;
        $new -> year = $request -> year;
        $new -> copa = $request -> copa;
        $new -> fase = $request -> fase;
        $new -> categoria = $request -> categoria;
        $new -> num_jugadores = $request -> num_jugadores;
        $new -> descripcion = $request -> descripcion;
        $new -> estatus = 0;
        $new -> save();

        $imagenes = $request->file('imagenes');
        if (isset($imagenes)) {
            foreach ($imagenes as $img) {
                $i = new IMGTalentos();
                    // Obtener el nombre original del archivo
                    $nombre = $img->getClientOriginalName();
                    $url = $request->copa."-".$request->year."-".$nombre;
                    //indicamos que queremos guardar un nuevo archivo en el disco local
                    \Storage::disk('talentos')->put($url, \File::get($img));
                $i ->talento_id = $new -> id_talento;
                $i ->img = $url;
                $i -> estatus_img = 0;
                $i -> save();
            }
        }

        if ($request->campeonato == 'Si') {
            $edit = Torneo::find($request->id_torneo);
            $edit -> copa = 1;
            $edit -> id_talento = $new -> id_talento;
            $edit -> save();
        }else {
            $edit = Torneo::find($request->id_torneo);
            $edit -> copa = 2;
            $edit -> id_talento = $new -> id_talento;
            $edit -> save();
        }
        return $new;
    }

    /**
     * funcion que nos mostrara la informacion de talentos de dicho torneo
     **/
    public function detalleTalento($id){
        $data = Talentos::find($id);
        return $data;
    }
    /**
     * funcion que nos mostrara la informacion de talentos de dicho torneo
     **/
    public function galeriaTalento($id){
        $data = IMGTalentos::where('talento_id',$id)->get();
        return $data;
    }
}
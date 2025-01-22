<?php


namespace App\Repositories;
use App\Models\Jugadores;
use App\Models\DocumentosJugadores;
use Carbon\Carbon;
use Mail;
use DB;
use Hash;
use Cookie;

class JugadoresRepository
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
    public function getJugador($request){
        $rol = $request->rol;
        $sede = $request->sede;
        $parametro = $request->buscador;
        if ($rol == 'Root'||$rol == 'Administrador') {
            $respuesta = Jugadores::select('*')
            ->where(function($query) use ($parametro) {
                $query->where('nombre','LIKE','%'.$parametro.'%')
                ->orWhere('posicion','LIKE','%'.$parametro.'%')
                ->orWhere('sede','LIKE','%'.$parametro.'%')
                ->orWhere('categoria','LIKE','%'.$parametro.'%');
            })
            ->orderBy('id_jugador','DESC')
            ->paginate(9); 
        }else{
            $respuesta = Jugadores::select('*')
            ->where(function($query) use ($parametro) {
                $query->where('nombre','LIKE','%'.$parametro.'%')
                ->orWhere('posicion','LIKE','%'.$parametro.'%')
                ->orWhere('sede','LIKE','%'.$parametro.'%')
                ->orWhere('categoria','LIKE','%'.$parametro.'%');
            })
            ->where('sede',$sede)
            ->where('estatus',0)
            ->orderBy('id_jugador','DESC')
            ->paginate(9); 
        }
        return $respuesta;
    }

    /**
     * FUNCION QUE CREARA LOS JUGADORES
     **/
    public function createJugador($request){
        $new = new Jugadores();
        $new -> creacion = $request->creacion;
        $new -> nombre = $request->nombre;
        $new -> edad = $request->edad;
        $new -> fecha_nacimiento = $request->fecha_nacimiento;
        $new -> posicion = $request->posicion;
        $new -> sexo = $request->sexo;
        $new -> categoria = $request->categoria;
        $new -> sede = $request->sede;
        $new -> save();

        $edit = Jugadores::find($new->id_jugador);
        $edit -> folio = 'TL-00'.$new->id_jugador;
        $file = $request->file('foto');
        if(isset($file)){
            $file = $request->file('foto');
            $nombre = $file->getClientOriginalName();
            $url = $new->id_jugador."/".$nombre;
            \Storage::disk('jugadores')->put($url, \File::get($file));
            $edit->foto = $nombre;
        }
        $edit -> save();
        
        /* Acta de Nacimiento */
        $arch = new DocumentosJugadores();
        $arch -> id_jugador = $new->id_jugador;
        $arch -> tipo = 'Acta de Nacimiento';
        $file = $request->file('acta_nacimiento');
        if(isset($file)){
            $file = $request->file('acta_nacimiento');
            $nombre = $file->getClientOriginalName();
            $url = $new->id_jugador."/".$nombre;
            \Storage::disk('jugadores')->put($url, \File::get($file));
            $arch->archivo = $nombre;
        }
        $arch -> save();

        /* Curp */
        $arch = new DocumentosJugadores();
        $arch -> id_jugador = $new->id_jugador;
        $arch -> tipo = 'Curp';
        $file = $request->file('curp');
        if(isset($file)){
            $file = $request->file('curp');
            $nombre = $file->getClientOriginalName();
            $url = $new->id_jugador."/".$nombre;
            \Storage::disk('jugadores')->put($url, \File::get($file));
            $arch->archivo = $nombre;
        }
        $arch -> save();

        /* Identificación */
        $arch = new DocumentosJugadores();
        $arch -> id_jugador = $new->id_jugador;
        $arch -> tipo = 'Identificación';
        $file = $request->file('identificacion');
        if(isset($file)){
            $file = $request->file('identificacion');
            $nombre = $file->getClientOriginalName();
            $url = $new->id_jugador."/".$nombre;
            \Storage::disk('jugadores')->put($url, \File::get($file));
            $arch->archivo = $nombre;
        }
        $arch -> save();

        return $new;
    }
}

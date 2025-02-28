<?php


namespace App\Repositories;
use App\Models\CuerpoTecnico;
use Carbon\Carbon;
use Mail;
use DB;
use Hash;
use Cookie;

class CuerpoTecnicoRepository
{  


    /**
     * FUNCION QUE MUESTRA LOS REGISTROS DE CUERPO TECNICO
     **/
    public function getCuerpoTecnico($request){
        $rol = $request->rol;
        $sede = $request->sede;
        $buscador = $request->buscador;
        if ($rol == 'Root'||$rol == 'Administrador') {
            $respuesta = CuerpoTecnico::select('*')
            ->where(function($query) use ($buscador) {
                $query->where('nombre','LIKE','%'.$buscador.'%');
            })
            ->orderBy('id_cuerpo_tecnico','DESC')
            ->paginate(10); 
        }else{
            $respuesta = CuerpoTecnico::select('*')
            ->where(function($query) use ($buscador) {
                $query->where('nombre','LIKE','%'.$buscador.'%');
            })
            ->where('sede',$sede)
            ->orderBy('id_cuerpo_tecnico','DESC')
            ->paginate(10); 
        }
        return $respuesta;
    }


    /**
     * funcion que registrara el cuerpo tecnico
     **/
    public function createRegistro($request){

        $new = new CuerpoTecnico();
        $new -> creacion = $request -> creacion;
        $new -> nombre = $request -> nombre;
        $new -> fecha_nacimiento = $request -> fecha_nacimiento;
        $new -> edad = $request -> edad;
        $new -> puesto = $request -> puesto;
        $new -> sexo = $request -> sexo;
        $new -> sede = $request -> sede;
        $new -> estatus = 0;
        $new -> save();

        $edit = CuerpoTecnico::find($new->id_cuerpo_tecnico);
        $edit -> folio = 'CT-00'.$new->id_cuerpo_tecnico;
        $file = $request->file('foto');
        if(isset($file)){
            $file = $request->file('foto');
            $nombre = $file->getClientOriginalName();
            $url = $new->id_cuerpo_tecnico."/".$nombre;
            \Storage::disk('cuerpotecnico')->put($url, \File::get($file));
            $edit->foto = $nombre;
        }
        $edit -> save();
        return $edit;
    }

    /**
     * funcion que editara el registro
     **/
    public function updateRegistro($request){
        dd($request);
        $edit = CuerpoTecnico::find($request->id_cuerpo_tecnico);
        $edit -> nombre = $request -> nombre;
        $edit -> fecha_nacimiento = $request -> fecha_nacimiento;
        $edit -> edad = $request -> edad;
        $edit -> puesto = $request -> puesto;
        $edit -> sexo = $request -> sexo;
        $edit -> sede = $request -> sede;
        $file = $request->file('foto');
        if(isset($file)){
            $file = $request->file('foto');
            $elimina = $request->id_cuerpo_tecnico."/".$edit->foto_eliminar; 
            \Storage::disk('cuerpotecnico')->delete($elimina);
            $nombre = $file->getClientOriginalName();
            $url = $new->id_cuerpo_tecnico."/".$nombre;
            \Storage::disk('cuerpotecnico')->put($url, \File::get($file));
            $edit->foto = $nombre;
        }
        $edit -> save();
    }

    /**
     * FUNCION QUE ELIMINARA EL REGISTRO
     **/
    public function deleteTecnico($id){
        $edit = CuerpoTecnico::find($id);
        $elimina = $id."/".$edit->foto; 
        \Storage::disk('cuerpotecnico')->delete($elimina);
        $edit -> delete();
    }

    /**
     * FUncion que cambiara el estatus del registro
     **/
    public function cambioEstatus($request){

        $edit = CuerpoTecnico::find($request->id_cuerpo_tecnico);
        $edit -> estatus = $request -> estatus; 
        $edit -> save();
        return $edit;
    }
}
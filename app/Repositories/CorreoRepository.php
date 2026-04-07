<?php


namespace App\Repositories;
use App\Models\Correos;
use App\Models\IMGCorreo;
use App\Models\Afiliados;
use App\Jobs\EnviarCorreoMasivo;
use Carbon\Carbon;
use Mail;
use DB;
use Hash;
use Cookie;

class CorreoRepository
{  

    /**
     * Funcion que mostrara los correos creados
     **/
    public function getCorreo($request){
        $parametro = $request->buscador;
        return Correos::select('*')
        ->orWhere('tbl_correos.fecha','LIKE','%'.$parametro.'%')
        ->orWhere('tbl_correos.destinatario','LIKE','%'.$parametro.'%')
        ->orderBy('tbl_correos.id_correo','DESC')
        ->get();
    }
    
    /**
     * FUNCION QUE CREA EL CORREO ELECTRONICO
     **/
    public function createCorreo($request){
        dd($request);

        $new = new Correos();
        $new -> fecha = $request -> fecha;
        $new -> destinatario = $request -> destinatario;
        $new -> asunto = $request -> asunto;
        $new -> informacion = $request -> informacion;
        $new -> estatus = 0;
        $new -> enviados = 0;
        $new -> pendientes = 0;
        $new -> save();
 
 
        $var = $request->file('imgCorreo');
        if (isset($var)){
            foreach ($var as $value) {
                $arch = new ImgCorreo();
                $arch->id_correo = $new->id_correo;
                //obtenemos el nombre del archivo
                $nombre = $value->getClientOriginalName();
                $urlimagen = $new->id_correo."/".$nombre;
                //indicamos que queremos guardar un nuevo archivo en el disco local
                \Storage::disk('galeriaCorreo')->put($urlimagen,  \File::get($value));
                $arch->nombre = $urlimagen;
                $arch->estatus_img = 0;
                $arch->save();
            }
        }
        return $new;
     }
 
     /**
      * FUNCION QUE EDITARA EL CORREO
      **/
    public function editarCorreo($request){

        $update = Correos::find($request->id_correo);
        $update -> fecha = $request -> fecha;
        $update -> destinatario = $request -> destinatario;
        $update -> asunto = $request -> asunto;
        $update -> informacion = $request -> informacion;
        $update -> save();
        return $update;
    }

    /**
     * 
     ** funcion que activa y desactivara el correo electronico
     **/
    public function activacionCorreo($request){
        $update = Correos::find($request->id_correo);
        if ($request->bandera == 'Activar') {
            $update -> estatus = 1;
        }else{
            $update -> estatus = 0;
        }
        $update -> save();
        return $update;
    }

    /**
     * FUNCION QUE MOSTRARA LA GALERIA DE CADA CORREO
     **/
    public function galeCorreo($id){
        return ImgCorreo::where('id_correo',$id)->get();
    }

    /**
     * FUNCION QUE ELIMINARA EL CORREO
     **/
    public function deleteCorreo($id){
        $update = Correos::find($id);

            $img = ImgCorreo::where('id_correo', $id)->get();
            foreach ($img as $value) {
                $elimina = ImgCorreo::find($value->id_imgcorreo);
                \Storage::disk('galeriaCorreo')->delete($value->nombre);
                $elimina->delete();
            }
        $update -> delete();
        return;
    }

    /**
     * FUNCION QUE ENVIARA LOS CORREOS ELECTRONICOS
     **/
    public function Correoenvio(){

        $correo = Correos::where('estatus',1)->first();

        if ($correo != null) {

            if ($correo->destinatario == 'Afiliados') {
                
                
                    $img = ImgCorreo::where('id_correo', $correo->id_correo)->get();

                    $user = Afiliados::where('processed',false)
                    ->orderBy('id_afi', 'asc')
                    ->take(1)
                    ->get();

                    foreach ($user as $usuario) {
                        EnviarCorreoMasivo::dispatch($usuario, $correo, $img);
                        $edit = Afiliados::find($usuario->id_afi);
                        $edit -> processed = 1;
                        $edit -> save();
                    }

                    $counts = Afiliados::select(DB::raw("
                        SUM(CASE WHEN processed = true THEN 1 ELSE 0 END) as enviados,
                        SUM(CASE WHEN processed = false THEN 1 ELSE 0 END) as pendientes"))
                        ->first();

                    $edit = Correos::find($correo->id_correo);
                    $edit -> enviados = $counts->enviados;
                    $edit -> pendientes = $counts->pendientes;
                    $edit -> save();
            }
           
            
        }
    }
}
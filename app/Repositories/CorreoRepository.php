<?php


namespace App\Repositories;
use Carbon\Carbon;
use Mail;
use DB;
use Hash;
use Cookie;

class CorreoRepository
{  

    
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
}
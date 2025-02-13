<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacion;
use App\Models\Perfil;
use App\Models\Sedes;
use App\Models\Torneo;
use App\Helpers\NotificacionHelper;
use App\Events\TorneoChangedEvent;
use DB;
use Hash;
use Cookie;

class NotificacionController extends Controller
{

    /**
     * @var NotificacionHelper
     */
    private $NotificacionHelper;
    
    public function __construct(NotificacionHelper $NotificacionHelper)
    {
        $this->NotificacionHelper = $NotificacionHelper;
    }

    /**
        * Funcion que mostrara las notificaciones
    **/
    public function getNotificacion(){
        
        $noti = Notificacion::where('id_user_para',auth()->user()->id)->where('estatus',1)->orderBy('id_notificacion','DESC')->get();
        $valida = $this->NotificacionHelper->estatusNoti($noti);
        return response()->json(['noti'=>$noti]);
    }




    /**
     * Funcion que validara si hay Torneos con notificaciones pendientes
     **/
    public function NotificacionAnaliza(){
        $admin =  DB::table('users')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->select('roles.name as rol','users.*')
        ->where('roles.name', 'Root')
        ->first();
        $torneo = Torneo::where('estatus','!=',0)->first();
        if ($torneo != null) {
            $estatus = $torneo->estatus;
            if ($estatus == 3) {
                $new = new Notificacion();
                $new -> descripcion = 'Se rechazo el pago del Torneo'.' '. $torneo->torneo;
                $new -> id_user_de = $admin->id;
                $new -> id_user_para = $torneo->creacion;
                $new -> modulo = 'Torneos';
                $new -> detalle_notificacion = 'Rechazada';
                $new -> url = 'torneo';
                $new -> estatus = 1;
                $new -> save();
                event(new TorneoChangedEvent($torneo));
            }
        }
    }

    /**
     * Funcion que elimina la notificacion al dar click 
     */

     public function eliminaNotificacion($id_notificacion){
        $notificacion = Notificacion::find($id_notificacion);
        $notificacion->delete();
        return $notificacion;
    }

    /**
     * Funcion que limpiara las notificaciones del usuario
     **/
    public function limpiaNotificacion(Request $request){
        $noti = json_decode($request->notificacion);
        foreach ($noti as $value) {

            $limpiar = Notificacion::find($value->id_notificacion);
            $limpiar->delete();
        }
        return $limpiar;
    }
}

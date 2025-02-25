<?php

namespace App\Helpers;
use App\Http\Controllers\NotificacionController;
use Carbon\Carbon;
use DB;
use Hash;
use Cookie;

class NotificacionHelper
{
    /**
     * Muestra el estatus de la notificacion
     **/
    public function estatusNoti($noti){
        foreach ($noti as $n) {
            if ($n->detalle_notificacion == 'Aprobado') {
                $n->color = 'success';
                $n->icon = 'ri-checkbox-circle-fill';

            }
            if ($n->detalle_notificacion == 'Rechazada') {
                $n->color = 'danger';
                $n->icon = 'ri-alert-fill';
            }
        }
    }
}
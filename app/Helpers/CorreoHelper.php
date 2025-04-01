<?php

namespace App\Helpers;
use App\Repositories\CorreoRepository;

use Carbon\Carbon;
use DB;
use Hash;
use Cookie;
use DateTime;

class CorreoHelper
{
    /**
     * funicon que tiene una validacion
     **/
    public function validaCorreo($data){
        foreach ($data as  $d) {
            if ($d->estatus == 0) {
                $d -> color = 'danger';
                $d -> text = 'Inactivo';
            }
            if ($d->estatus == 1) {
                $d -> color = 'success';
                $d -> text = 'Activo';
            }

            /* validacion de enviados y pendientes */

            $total_enviados = 0;
            $enviados = 0;
            $pendientes = 0;

            $total_enviados = $d->enviados + $d->pendientes;

            if ($total_enviados != 0) {
                $enviados = round(($d->enviados / $total_enviados) * 100, 2);
                $pendientes = round(($d->pendientes / $total_enviados) * 100, 2);
            }

            $d->porcentaje_enviados = $enviados;
            $d->porcentaje_pendientes = $pendientes;

        }
    }
}
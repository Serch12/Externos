<?php

namespace App\Helpers;
use App\Repositories\CuerpoTecnicoRepository;
use App\Administrador;
use App\Models\DocumentosJugadores;
use Carbon\Carbon;
use DB;
use Hash;
use Cookie;

class CuerpoTecnicoHelper
{
    /**
     * FUNCION QUE VALIDA LOS ESTATUS Y SEDE
     **/
    public function validacion($tecnico){
        foreach ($tecnico as $t) {
            if ($t->sede == 'GUADALAJARA') {
                $t -> color = 'danger';
            }
            if ($t->sede == 'TOLUCA') {
                $t -> color = 'info';
            }
            if ($t->sede == 'LEON') {
                $t -> color = 'success';
            }

            if ($t->estatus == 0) {
                $t -> text = 'Activo';
                $t -> class_color = 'success';
            }
            if ($t->estatus == 1) {
                $t -> text = 'Inactivo';
                $t -> class_color = 'danger';
            }
        }
    }
}
<?php

namespace App\Helpers;
use App\Repositories\TorneoRepository;
use App\Administrador;
use App\Models\DocumentosJugadores;
use Carbon\Carbon;
use DB;
use Hash;
use Cookie;

class TorneoHelper
{
   /**
     * @var TorneoRepository
     */
    private $TorneoRepository;

    public function __construct(TorneoRepository $TorneoRepository)
    {
        $this->TorneoRepository = $TorneoRepository;

    }

    /**
     * Funcion que valida el estatus de usuario
     **/
    public function validaTorneo($muestra){

        foreach ($muestra as $value) {
            /* estatus de copa */
            if ($value -> copa == 0) {
                $value -> color_copa = 'dark';
                $value -> img = 'style/assets/img/copas/trofeo_gris.png';
            }
            if ($value -> copa == 1) {
                $value -> color_copa = 'warning';
                $value -> img = 'style/assets/img/copas/trofeo_dorado.png';
            }
            if ($value -> copa == 2) {
                $value -> color_copa = 'danger';
                $value -> img = 'style/assets/img/copas/trofeo_rojo.png';
            }

            /* estatus de procesos */
            if ($value->estatus == 0) {
                $value -> color = 'info';
                $value -> text = 'Editar';
            }
            if ($value->estatus == 1) {
                $value -> color = 'warning';
                $value -> text = 'Revision';
            }
        }
    }
}
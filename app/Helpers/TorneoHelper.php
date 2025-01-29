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
            }
            if ($value -> copa == 1) {
                $value -> color_copa = 'warning';
            }
            if ($value -> copa == 2) {
                $value -> color_copa = 'danger';
            }

            /* estatus de procesos */
            if ($value->estatus == 0) {
                $value -> color = 'info';
                $value -> text = 'Editar';
            }
        }
    }
}
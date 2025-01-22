<?php

namespace App\Helpers;
use App\Repositories\JugadoresRepository;
use App\Administrador;
use App\Models\DocumentosJugadores;
use Carbon\Carbon;
use DB;
use Hash;
use Cookie;

class JugadoresHelper
{
   /**
     * @var JugadoresRepository
     */
    private $JugadoresRepository;

    public function __construct(JugadoresRepository $JugadoresRepository)
    {
        $this->JugadoresRepository = $JugadoresRepository;

    }

    /**
     * Funcion que valida el estatus de usuario
     **/
    public function validaJugador($muestra){

        foreach ($muestra as $value) {
            $value->documentacion = DocumentosJugadores::where('id_jugador',$value->id_jugador)->get();

            if ($value->sede == 'GUADALAJARA') {
                $value -> color = 'danger';
            }
            // if ($value->estatus == 1) {
            //     $value -> color = 'bg-label-success ';
            // }
            // if ($value->estatus == 2) {
            //     $value -> color = 'bg-label-danger';
            // }
        }
    }

}

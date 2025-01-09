<?php

namespace App\Helpers;
use App\Repositories\AdministradorRepository;
use App\Administrador;
use App\Models\Contratos;
use Carbon\Carbon;
use DB;
use Hash;
use Cookie;

class AdministradorHelper
{
   /**
     * @var AdministradorRepository
     */
    private $AdministradorRepository;

    public function __construct(AdministradorRepository $AdministradorRepository)
    {
        $this->AdministradorRepository = $AdministradorRepository;
       
    }

    /**
     * Funcion que valida el estatus de usuario
     **/
    public function validar($muestra){

        foreach ($muestra as $value) {
            if ($value->estatus == 0) {
                $value -> text = 'Pendiente';
                $value -> color = 'bg-label-warning ';
            }
            if ($value->estatus == 1) {
                $value -> text = 'Activo';
                $value -> color = 'bg-label-success ';
            }
            if ($value->estatus == 2) {
                $value -> text = 'Inactivo';
                $value -> color = 'bg-label-danger';
            }
            if ($value->rol_name == 'Root') {
                $value->img = 'style/assets/img/avatars/1.png';
            }
            if ($value->rol_name == 'Auxiliar Tecnico') {
                $value->img = 'style/assets/img/avatars/6.png';
            }
        }
    }
}
<?php

namespace App\Helpers;
use App\Repositories\JugadoresRepository;
use App\Administrador;
use App\Models\Perfil;
use App\Models\Documentacion;
use App\Models\Sedes;
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

}

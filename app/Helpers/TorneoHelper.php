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
}
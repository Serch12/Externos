<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TorneoRepository;
use App\Helpers\TorneoHelper;
use App\Models\Perfil;
use App\Models\Sedes;

class TorneoController extends Controller
{
    /**
     * @var TorneoHelper
     */
    private $TorneoHelper;
    
    /**
     * @var TorneoRepository
     */
    private $TorneoRepository;

    public function __construct(TorneoHelper $TorneoHelper, TorneoRepository $TorneoRepository)
    {
        $this->TorneoHelper = $TorneoHelper;
        $this->TorneoRepository = $TorneoRepository;
    }

    /**
     * FUNCION QUE MUESTRA LA VISTA
     **/
    public function index(){
        if (auth()->check()) {
            $info_usuario = $this->TorneoRepository->rolUsuarioGeneral();
            $rol_usuario = $info_usuario->rol;
            $permisos = explode(',', $info_usuario->permisos);
            $imagen = Perfil::select('foto')->where('id',auth()->user()->id)->first();
            if ($imagen == null) {
                $imagen = new \stdClass();
                $imagen->foto = 'style/logos/sinfoto.png';
            }
            if ($info_usuario->sede !=0) {
                $info = Sedes::select('nombre')->where('id_sede',$info_usuario->sede)->first();
                $sede = $info->nombre;
            }else{
                $sede = 'Proceso';
            }
            return view('Torneo.principal')->with(['rol_usuario' => $rol_usuario,'imagen' => $imagen,'sede'=>$sede,'permisos'=>$permisos]);
        }else {
            return view('auth.login');
        }
    }

    /**
     * FUNCION QUE MUESTRA LOS JUGADORES
     **/
    public function getTorneo(Request $request){
        $muestra = $this->TorneoRepository->getTorneo($request);
        $valida = $this->TorneoHelper->validaTorneo($muestra);
        return response()->json(['muestra'=>$muestra,
        'pagination'=>['total' => $muestra->total(),
            'current_page' => $muestra->currentPage(),
            'per_page' => $muestra->perPage(),
            'last_page' => $muestra->lastPage(),
            'from' => $muestra->firstItem(),
            'to' => $muestra->lastPage()
            ]]);
    }

    /**
     * Funcion que creara el torneo
     **/
    public function createTorneo(Request $request){
        return $this->TorneoRepository->createTorneo($request);
    }
}

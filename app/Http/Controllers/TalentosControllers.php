<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TalentosRepository;
use App\Helpers\TalentosHelper;
use App\Models\Perfil;
use App\Models\Sedes;
use App\Models\Jugadores;

class TalentosControllers extends Controller
{
    /**
     * @var TalentosHelper
     */
    private $TalentosHelper;
    
    /**
     * @var TalentosRepository
     */
    private $TalentosRepository;

    public function __construct(TalentosHelper $TalentosHelper, TalentosRepository $TalentosRepository)
    {
        $this->TalentosHelper = $TalentosHelper;
        $this->TalentosRepository = $TalentosRepository;
    }

    /**
     * FUNCION QUE MUESTRA LA VISTA
     **/
    public function index(){
        if (auth()->check()) {
            $info_usuario = $this->TalentosRepository->rolUsuarioGeneral();
            $rol_usuario = $info_usuario->rol;
            $permisos = explode(',', $info_usuario->permisos);
            $imagen = Perfil::select('foto')->where('id',auth()->user()->id)->first();
            if ($imagen == null) {
                $imagen = new \stdClass();
                $imagen->foto = 'sinfoto';
            }
            if ($info_usuario->sede !=0) {
                $info = Sedes::select('nombre')->where('id_sede',$info_usuario->sede)->first();
                $sede = $info->nombre;
            }else{
                $sede = 'Proceso';
            }
            $existJugador = Jugadores::count() > 0;
            return view('TalentosAMFpro.principal')->with(['rol_usuario' => $rol_usuario,'imagen' => $imagen,'sede'=>$sede,'permisos'=>$permisos,'existJugador'=>$existJugador]);
        }else {
            return view('auth.login');
        }
    }

    /**
     * funcion que mostrara las publicaciones de talentos
     **/
    public function getTalentos(Request $request) {
        $muestra = $this->TalentosRepository->getTalentos($request);
        // $valida = $this->TalentosHelper->validaTorneo($muestra);
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
     * funcion que mostrara la galeria de talentos
     **/
    public function galeriaTalento($id){
        return $this->TalentosRepository->galeriaTalento($id);
    }

    /**
     * funcion que cambiara el estatus de talentos
     **/
    public function activacion(Request $request){
        return $this->TalentosRepository->activacion($request);
    }

    /**
     * funcion para eliminara una imagen de la galeria
     **/
    public function eliminarImagen($id){
        return $this->TalentosRepository->eliminarImagen($id);
    }

    /**
     * funcion que editara la informacion de talentos
     **/
    public function updateTalento(Request $request) {
        return $this->TalentosRepository->updateTalento($request);
    }

    /**
     * funcion que eliminara la publicacion de talentos
     **/
    public function Talentodelete(Request $request) {
        return $this->TalentosRepository->Talentodelete($request);
    }

    /* FUNCIONES DE BANNERS */

    /**
     * Funcion que mostarra los banners
     **/
    public function getBanner(Request $request){
        $date = $this->TalentosRepository->getBanner($request);
        return response()->json(['date'=>$date,
        'pagination'=>['total' => $date->total(),
            'current_page' => $date->currentPage(),
            'per_page' => $date->perPage(),
            'last_page' => $date->lastPage(),
            'from' => $date->firstItem(),
            'to' => $date->lastPage()
        ]]);
    }

    /**
     * funciones que se registrara los banners
     **/
    public function createBanner(Request $request){
        return $this->TalentosRepository->createBanner($request);
    }

    /**
     * funcion que mostrara los Bannergaleria
     **/
    public function Bannergaleria($id){
        return $this->TalentosRepository->Bannergaleria($id);
    }

}

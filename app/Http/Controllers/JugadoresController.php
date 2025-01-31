<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\JugadoresHelper;
use App\Repositories\JugadoresRepository;
use App\Models\Perfil;
use App\Models\Sedes;

class JugadoresController extends Controller
{
 
    /**
     * @var JugadoresHelper
     */
    private $JugadoresHelper;
    
    /**
     * @var JugadoresRepository
     */
    private $JugadoresRepository;

    public function __construct(JugadoresHelper $JugadoresHelper, JugadoresRepository $JugadoresRepository)
    {
        $this->JugadoresHelper = $JugadoresHelper;
        $this->JugadoresRepository = $JugadoresRepository;
    }

    /**
     * FUNCION QUE MUESTRA LA VISTA
     **/
    public function index(){
        if (auth()->check()) {
            $info_usuario = $this->JugadoresRepository->rolUsuarioGeneral();
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
            return view('Jugadores.principal')->with(['rol_usuario' => $rol_usuario,'imagen' => $imagen,'sede'=>$sede,'permisos'=>$permisos]);
        }else {
            return view('auth.login');
        }
    }

    /**
     * FUNCION QUE MUESTRA LOS JUGADORES
     **/
    public function getJugador(Request $request){
        $muestra = $this->JugadoresRepository->getJugador($request);
        $valida = $this->JugadoresHelper->validaJugador($muestra);
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
     * FUNCION QUE CREARA LOS JUGADORES
     **/
    public function createJugador(Request $request){
        return $this->JugadoresRepository->createJugador($request);
    }
    

    /**
     * FUNCION QUE EDITARA EL JUGADOR
     **/
    public function updateJugador(Request $request){
        return $this->JugadoresRepository->updateJugador($request);
    }

    /**
     * FUNCION QUE ELIMINA LOS ARCHIVOS DE LOS JUGADORES
     **/
    public function deleteArchivo($id){
        return $this->JugadoresRepository->deleteArchivo($id);
    }

    /**
     * FUNCION QUE GUARDARA LA INFORMACION DE TUTOR
     **/
    public function createTutor(Request $request){
        return $this->JugadoresRepository->createTutor($request);
    }
}

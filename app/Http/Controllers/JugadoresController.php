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
                $imagen->foto = 'style/logos/sinfoto.png';
            }
            $sede = Sedes::select('nombre')->where('id_sede',$info_usuario->sede)->first();
            return view('Jugadores.principal')->with(['rol_usuario' => $rol_usuario,'imagen' => $imagen,'sede'=>$sede->nombre,'permisos'=>$permisos]);
        }else {
            return view('auth.login');
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\CuerpoTecnicoHelper;
use App\Repositories\CuerpoTecnicoRepository;
use App\Models\Perfil;
use App\Models\Sedes;
use App\Models\Jugadores;

use DB;
use Hash;

class CuerpoTecnicoController extends Controller
{
    /**
     * @var CuerpoTecnicoHelper
     */
    private $CuerpoTecnicoHelper;
    
    /**
     * @var CuerpoTecnicoRepository
     */
    private $CuerpoTecnicoRepository;

    public function __construct(CuerpoTecnicoHelper $CuerpoTecnicoHelper, CuerpoTecnicoRepository $CuerpoTecnicoRepository)
    {
        $this->CuerpoTecnicoHelper = $CuerpoTecnicoHelper;
        $this->CuerpoTecnicoRepository = $CuerpoTecnicoRepository;
    }
    
        /**
     * FUNCION QUE MUESTRA LA VISTA
     **/
    public function index(){
        if (auth()->check()) {
            $info_usuario = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->select('roles.name as rol', 'users.id', 'users.name', 'users.email','users.sede', DB::raw('GROUP_CONCAT(permissions.name) as permisos'))
            ->where('users.id', auth()->user()->id)
            ->groupBy('users.id', 'users.name', 'users.email', 'roles.name','users.sede')
            ->first();
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
            return view('Cuerpo Tecnico.principal')->with(['rol_usuario' => $rol_usuario,'imagen' => $imagen,'sede'=>$sede,'permisos'=>$permisos,'existJugador'=>$existJugador]);
        }else {
            return view('auth.login');
        }
    }

    /**
     * funcion que mostrara los cuerpos tecnicos
     **/
    public function getCuerpoTecnico(Request $request){
        $tecnico = $this->CuerpoTecnicoRepository->getCuerpoTecnico($request);
        $valida = $this->CuerpoTecnicoHelper->validacion($tecnico);
        return response()->json(['tecnico'=>$tecnico,
        'pagination'=>['total' => $tecnico->total(),
            'current_page' => $tecnico->currentPage(),
            'per_page' => $tecnico->perPage(),
            'last_page' => $tecnico->lastPage(),
            'from' => $tecnico->firstItem(),
            'to' => $tecnico->lastPage()
        ]]);
    }

    /**
     * FUNCION QUE AGREGAR EL CUERPO TECNICO
     **/
    public function createRegistro(Request $request){
        return  $this->CuerpoTecnicoRepository->createRegistro($request);
    }
    /**
     * FUNCION QUE EDITARA EL REGISTRO
     **/
    public function updateRegistro(Request $request){
        return  $this->CuerpoTecnicoRepository->updateRegistro($request);
    }

    /**
     * FUNCION QUE ELIMINARA EL REGISTRO 
     **/
    public function deleteTecnico($id){
        return  $this->CuerpoTecnicoRepository->deleteTecnico($id);
    }

    /**
     * FUNCION QUE CAMBIARA DE ESTATUS EL REGISTRO
     **/
    public function cambioEstatus(Request $request){
        return  $this->CuerpoTecnicoRepository->cambioEstatus($request);
    }
}

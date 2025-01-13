<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\AdministradorHelper;
use App\Repositories\AdministradorRepository;
use App\Models\Perfil;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdministradorController extends Controller
{
    // 
    /**
     * @var AdministradorHelper
     */
    private $AdministradorHelper;
    
    /**
     * @var AdministradorRepository
     */
    private $AdministradorRepository;

    public function __construct(AdministradorHelper $AdministradorHelper, AdministradorRepository $AdministradorRepository)
    {
        $this->AdministradorHelper = $AdministradorHelper;
        $this->AdministradorRepository = $AdministradorRepository;
    }

    /**
     * funcion que retorna al inicio del panel de administrador 
     */
    public function index(){
        if (auth()->check()) {
            $info_usuario = $this->AdministradorRepository->rolUsuarioGeneral();
            $rol_usuario = $info_usuario->rol;
            $permisos = explode(',', $info_usuario->permisos);
            $imagen = Perfil::select('foto')->where('id',auth()->user()->id)->first();
            if ($imagen == null) {
                $imagen = new \stdClass();
                $imagen->foto = 'style/logos/sinfoto.png';
            }
            return view('Administrador.principal')->with(['rol_usuario' => $rol_usuario,'imagen' => $imagen,'permisos'=>$permisos]);
        }else {
            return view('auth.login');
        }

    }

    /**
     * FUNCION QUE BUSCARA LOS USUARIOS REGISTRADOS 
     **/
    public function Busqueda(Request $request){
        $info_usuario = $this->AdministradorRepository->rolUsuarioGeneral();
        $role = $info_usuario->rol;
        $muestra = $this->AdministradorRepository->Usuarios($request,$role);
        $valida = $this->AdministradorHelper->validar($muestra);
        $roles = Role::select('*')->get();    
        return response()->json(['roles'=>$roles, 'muestra'=>$muestra,
        'pagination'=>['total' => $muestra->total(),
            'current_page' => $muestra->currentPage(),
            'per_page' => $muestra->perPage(),
            'last_page' => $muestra->lastPage(),
            'from' => $muestra->firstItem(),
            'to' => $muestra->lastPage()
            ]]);
    }   
    
    /**
     * FUNCION QUE CREARA LOS USUARIOS CON SU ROL
     **/
    public function createUsuarios(Request $request){
        return $this->AdministradorRepository->createUsuarios($request);
    }

    /**
     * FUNCION QUE editara LOS USUARIOS CON SU ROL
     **/
    public function updateUsuarios(Request $request){
        return $this->AdministradorRepository->updateUsuarios($request);
    }

    /**
     * FUNCION QUE editara LOS USUARIOS CON SU ROL
     **/
    public function deleteUsuarios($id){
        return $this->AdministradorRepository->deleteUsuarios($id);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\AdministradorHelper;
use App\Repositories\AdministradorRepository;
use App\Models\Perfil;
use App\Models\Sedes;
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
            if ($info_usuario->sede !=0) {
                $info = Sedes::select('nombre')->where('id_sede',$info_usuario->sede)->first();
                $sede = $info->nombre;
            }else{
                $sede = 'Proceso';
            }
            return view('Administrador.principal')->with(['rol_usuario' => $rol_usuario,'imagen' => $imagen,'sede'=>$sede,'permisos'=>$permisos]);
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
        $sedes = Sedes ::select('*')->get(); 
        return response()->json(['roles'=>$roles, 'muestra'=>$muestra,'sedes'=>$sedes,
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

    /**
     * FUNCION QUE GUARDARA LA DOCUMENTACION DE CADA USUARIO
     **/
    public function Documentacion(Request $request){
        return $this->AdministradorRepository->Documentacion($request);
    }

    /**
     * FUNCION QUE MOSTRARA LA DOCUMENTACION DE CADA USUARIO
     **/
    public function detalleDocumentacion($id){
        return $this->AdministradorRepository->detalleDocumentacion($id);
    }

    /**
     * FUNCION QUE ELIMINARA LOS DOCUMENTOS
     **/
    public function deleteDoc($id){
        return $this->AdministradorRepository->deleteDoc($id);
    }

    /**
     * Funcion que creara las sedes
     **/
    public function newSede(Request $request){
        return $this->AdministradorRepository->newSede($request);
    }
}

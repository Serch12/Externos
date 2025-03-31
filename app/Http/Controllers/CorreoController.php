<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\CorreoHelper;
use App\Repositories\CorreoRepository;
use App\Models\Perfil;
use App\Models\Sedes;
use App\Models\Jugadores;


use DB;
use Hash;

class CorreoController extends Controller
{
    /**
     * @var CorreoHelper
     */
    private $CorreoHelper;
    
    /**
     * @var CorreoRepository
     */
    private $CorreoRepository;

    public function __construct(CorreoHelper $CorreoHelper, CorreoRepository $CorreoRepository)
    {
        $this->CorreoHelper = $CorreoHelper;
        $this->CorreoRepository = $CorreoRepository;
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
            return view('Correo.principal')->with(['rol_usuario' => $rol_usuario,'imagen' => $imagen,'sede'=>$sede,'permisos'=>$permisos,'existJugador'=>$existJugador]);
        }else {
            return view('auth.login');
        }
    }


    /**
     * funcion que guarda el correo electronico
     **/
    public function createCorreo(Request $request){
        return $this->CorreosRepository->createCorreo($request);
    }

    /**
     * FUNCION QUE EDITARA EL CORREO
     **/
    public function editarCorreo(Request $request){
        return $this->CorreosRepository->editarCorreo($request);
    }
}
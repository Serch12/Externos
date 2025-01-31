<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Perfil;
use App\Models\Sedes;
use DB;
use Cookie;

class PermisosRolesController extends Controller
{
    /**
     * FUNCION QUE INICIA LA VISTA
     */
    public function index() {
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
            return view('PermisosRoles.principal')->with(['rol_usuario' => $rol_usuario,'imagen' => $imagen,'sede'=>$sede,'permisos'=>$permisos]);
        }else {
            return view('auth.login');
        }
    }

    /**
     * Funcion que muestra los roles
     **/
    public function Muestra(){
        $roles = Role::with('permissions')->get();
        $permissions = Permission::select('*')->get();
        return response()->json(['roles' => $roles,'permisos'=>$permissions]);
    }

    /**
     * Funcion que creara los roles con sus permisos
     **/
    public function createRole(Request $request) {

        $role = Role::create(['name' => $request->name]);
        
        $permisos = json_decode($request->permisos);

        $permissionNames = collect($permisos)->pluck('name')->toArray();
        if ($permissionNames) {
            $permissions = Permission::whereIn('name', $permissionNames)->get();
            $role->syncPermissions($permissions); // Asignar permisos al rol
        }

        return $role;
    }

    /**
     * FUNCION QUE EDITARA EL ROL
     **/
    public function updateRole(Request $request){
    
        $role = Role::findOrFail($request->id);
        $role->name = $request->name;
        $role->save();
    
        $permisos = json_decode($request->permisos);

        $permissionNames = collect($permisos)->pluck('name')->toArray();
        if ($permissionNames) {
            $permissions = Permission::whereIn('name', $permissionNames)->get();
            $role->syncPermissions($permissions); // Asignar permisos al rol
        }
        return $role;
    
    }

    /**
     * Funcion que eliminara el rol
     **/
    public function deleteRole(Request $request){
        $role = Role::findOrFail($request->id);
        $role->delete();
        return $role;
    }
}

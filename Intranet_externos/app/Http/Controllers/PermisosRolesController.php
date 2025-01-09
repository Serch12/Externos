<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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
            ->select('roles.name as rol','users.*')
            ->where('users.id', auth()->user()->id)
            ->first();
            $rol_usuario = $info_usuario->rol;
            // $imagen = Perfil::select('foto')->where('id_user',auth()->user()->id)->first();
            return view('PermisosRoles.principal')->with(['rol_usuario' => $rol_usuario]);
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

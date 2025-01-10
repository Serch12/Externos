<?php


namespace App\Repositories;
use App\Models\Notificaciones;
use App\Models\Administrador;
use App\Models\Usuarios;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Crypt;
use Carbon\Carbon;
use Mail;
use DB;
use Hash;
use Cookie;

class AdministradorRepository
{  

    /**
     * funcion que retorna el rol del usuario
     */
    public function rolUsuarioGeneral(){
        return DB::table('users')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
        ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
        ->select('roles.name as rol', 'users.id', 'users.name', 'users.email', DB::raw('GROUP_CONCAT(permissions.name) as permisos'))
        ->where('users.id', auth()->user()->id)
        ->groupBy('users.id', 'users.name', 'users.email', 'roles.name')
        ->first();

    }

    /**
     * FUNCION QUE BUSCARA LOS USUARIOS
     **/
    public function Usuarios($request,$role){
        $parametro = $request->buscador;
        if ($parametro == null) {
            $respuesta = DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('users', 'users.id', '=', 'model_has_roles.model_id')
            ->select('users.*', 'roles.name as rol_name')
            // ->where(function ($query) use ($role) { // Agregar condición para mostrar el registro "Root" solo al usuario con rol "Root"
            //     if ($role != 'Root') {

            //         $query->whereNotIn('roles.name', ['Root'])
            //         ->whereIn('users.estatus_user',[0,1]);
            //     }
            // })
            ->orderBy('id','DESC')
            ->paginate(10); 
        } else {
            $respuesta = DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('users', 'users.id', '=', 'model_has_roles.model_id')
            ->select('users.*', 'roles.name as rol_name')
            // ->where(function ($query) use ($role) { // Agregar condición para mostrar el registro "Root" solo al usuario con rol "Root"
            //     if ($role != 'Root') {
                   
            //         $query->whereNotIn('roles.name', ['Root'])
            //         ->whereIn('users.estatus_user',[0,1]); // Excluir el rol "root"
            //     }
            // })
            ->where('users.name','LIKE','%'.$parametro.'%')
            ->orWhere('users.email','LIKE','%'.$parametro.'%')
            ->orWhere('roles.name','LIKE','%'.$parametro.'%')            
            ->orderBy('id','DESC')
            ->paginate(10);
        }
        return $respuesta;
    }

    /**
     * FUNCION QUE CREARA LOS USUARIOS CON SU ROL
     **/
    public function createUsuarios($request){
        $user = new Usuarios();
        $user -> name=$request->name;
        $user -> email=$request->email;
        $user -> password=Hash::make($request->password);
        if ($request->estatus == 'true') {
            $user -> estatus = 1;
        }else {
            $user -> estatus = 0;
        }
        $user->save();

        $rol = User::find($user->id);
        $rol->assignRole($request->rol);
        $user->rol_name = $request->rol;
        return $user;
    }
}
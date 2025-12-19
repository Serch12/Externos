<?php


namespace App\Repositories;
use App\Models\Notificaciones;
use App\Models\Perfil;
use App\Models\Usuarios;
use App\Models\User;
use App\Models\Documentacion;
use App\Models\Sedes;
use App\Model\ContratosDigital;
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
        ->select('roles.name as rol', 'users.id', 'users.name', 'users.email','users.sede', DB::raw('GROUP_CONCAT(permissions.name) as permisos'))
        ->where('users.id', auth()->user()->id)
        ->groupBy('users.id', 'users.name', 'users.email', 'roles.name','users.sede')
        ->first();

    }

    /**
     * FUNCION QUE BUSCARA LOS USUARIOS
     **/
    public function Usuarios($request,$role){
        $respuesta = DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('users', 'users.id', '=', 'model_has_roles.model_id')
            ->select('users.*', 'roles.name as rol_name')
            ->orderBy('id','DESC')
            ->get(); 
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
        $user -> sede = $request -> sede;
        $user->save();

        $rol = User::find($user->id);
        $rol->assignRole($request->rol);
        $user->rol_name = $request->rol;
        return $user;
    }

    /**
     * funcion que actualizara el usuario
     **/
    public function CuentaUpdate($request){

        $user = Usuarios::find($request->id);        
        if ($request->new_password != 'Sin Cambio') {
            $user -> password=Hash::make($request->new_password);            
        }
        if ($request->estatus == 'true'||$request->estatus == 1) {
            $user -> estatus = 1;
        } else {
            $user -> estatus = 0;
        }
        $user -> sede = $request -> sede;
        $user->save();
        $role = DB::table('model_has_roles')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('users', 'users.id', '=', 'model_has_roles.model_id')
            ->select('roles.name as rol_name')
            ->where('users.id',$request->id)
            ->first(); 
            
        $rol = User::find($request->id);
        $rol->removeRole($role->rol_name);
        $rol->assignRole($request->rol_name);

        return $user;
    }

    /**
     * FUNCION QUE EDITARA LOS USUARIOS CON SU ROL
     **/
    public function updateUsuarios($request){


        if ($request -> bandera == 'activo') {
            if ($request->nombre != null) {
                $perfil = new Perfil();
                $perfil -> id = $request->id;
                $perfil -> nombre = $request->nombre;
                $perfil -> apellido_paterno = $request->apellido_paterno;
                $perfil -> apellido_materno = $request->apellido_materno;
                $perfil -> profesion = $request->profesion;
                $perfil -> estado_civil = $request->estado_civil;
                $perfil -> sexo = $request->sexo;
                $perfil -> cumpleaños = $request->cumpleaños;
                $perfil -> telefono = $request->telefono;
                $perfil -> codigo_postal = $request->codigo_postal;
                $perfil -> entidad = $request->entidad;
                $perfil -> direccion = $request->direccion;
                $perfil -> curp = $request->curp;
                $perfil -> rfc = $request->rfc;
                $perfil -> nacionalidad = $request->nacionalidad;
                $perfil -> cedula = $request->cedula;
                $file = $request->file('foto');
                if (isset($file)) {
                    // \Storage::disk('perfil')->delete($request->foto_eliminar);
                    $file = $request->file('foto');
                    //obtenemos el nombre del archivo
                    $nombre = $file->getClientOriginalName();
                    $url = $request->id."/".$nombre;
                    //indicamos que queremos guardar un nuevo archivo en el disco local
                    \Storage::disk('perfil')->put($url,  \File::get($file));
                    $perfil->foto = $url; 
                }
                $perfil -> save();
            }
            
        }else {
            $perfil = Perfil::find($request->id_perfil);
            $perfil -> nombre = $request->nombre;
            $perfil -> apellido_paterno = $request->apellido_paterno;
            $perfil -> apellido_materno = $request->apellido_materno;
            $perfil -> profesion = $request->profesion;
            $perfil -> estado_civil = $request->estado_civil;
            $perfil -> sexo = $request->sexo;
            $perfil -> cumpleaños = $request->cumpleaños;
            $perfil -> telefono = $request->telefono;
            $perfil -> codigo_postal = $request->codigo_postal;
            $perfil -> entidad = $request->entidad;
            $perfil -> direccion = $request->direccion;
            $perfil -> curp = $request->curp;
            $perfil -> rfc = $request->rfc;
            $perfil -> nacionalidad = $request->nacionalidad;
            $perfil -> cedula = $request->cedula;
            $file = $request->file('foto');
            if (isset($file)) {
                \Storage::disk('perfil')->delete($perfil->foto);
                $file = $request->file('foto');
                //obtenemos el nombre del archivo
                $nombre = $file->getClientOriginalName();
                $url = $request->id."/".$nombre;
                //indicamos que queremos guardar un nuevo archivo en el disco local
                \Storage::disk('perfil')->put($url,  \File::get($file));
                $perfil->foto = $url; 
            }
            $perfil -> save();
        }

        return $perfil;
    }

    /**
     * FUNCION QUE ELIMINARA EL USUARIO
     **/
    public function deleteUsuarios($id){
        $user = Usuarios::find($id);
            // $perfil = Perfil::where('id_user', $id)->get();
            // foreach ($perfil as $value) {
            //     $elimina = Perfil::find($value->id_perfil);
            //     \Storage::disk('perfil')->delete($elimina->foto);
            //     $elimina->delete();
            // }
        $user->delete();
    }

    /**
     * FUNCION QUE GUARDARA LA DOCUMENTACION DE CADA USUARIO
     **/
    public function Documentacion($request){

        $documentacion = $request->input('documentacionDate');

        if (isset($documentacion)) {
            foreach ($documentacion as $index => $evidencia) {
                $file = $request->file("documentacionDate.{$index}.archivo");
                $tipo = $evidencia['tipo'];

                if ($file) {
                    $arch = new Documentacion();
                    $arch->id_perfil = $request->id;
                    // Obtenemos el nombre del archivo
                    $nombre = $file->getClientOriginalName();
                    $urlimagen = $request->id."/".'Documentacion' . "/" . $nombre;
                    \Storage::disk('perfil')->put($urlimagen, \File::get($file));
                    $arch->tipo = $tipo;
                    $arch->archivo = $nombre;
                    $arch->estatus = 0;
                    $arch->save();
                }
            }
        }
    }

    /**
     * FUNCION QUE MOSTRARA LA DOCUMENTACION DE CADA USUARIO
     **/
    public function detalleDocumentacion($id){
        return Documentacion::where('id_perfil',$id)->get();
    }

    /**
     * funcion que nos mostrara los resultados de los contratos
     **/
    public function ContratoInfo($id){
        $historial_contrato = ContratosDigital::where('id_usuario',$request->id)->where('estatus',2)->whereNotNull('firma')->orderBy('id_contrato_digital','desc')->get();
        foreach ($historial_contrato as $value) {
            // Verifica si el valor no es nulo o una cadena vacía antes de desencriptar
            if ($value->salario_numero) {
                $value->salario_numero_1 = Crypt::decryptString($value->salario_numero);
            }
            if ($value->salario_texto) {
                $value->salario_texto_1 = Crypt::decryptString($value->salario_texto);
            }
        }
        $contrato_total = $historial_contrato->count();
    }

    /**
     * FUNCION QUE ELIMINARA LOS DOCUMENTOS
     **/
    public function deleteDoc($id){
        $delete = Documentacion::find($id);
        \Storage::disk('perfil')->delete($delete->id_perfil.'/'.'Documentacion'.'/'.$delete->archivo);
        $delete->delete();
    }

    /**
     * FUNCION QUE CREARA LAS SEDES
     **/
    public function newSede($request){
        $new = new Sedes();
        $new -> nombre = $request->nombre;
        $new -> ubicacion = $request->ubicacion;
        $new -> lugar_entrenamiento = $request->lugar_entrenamiento;
        $new -> contactos = $request->contactos;
        $new -> fecha_registro = $request->fecha_registro;
        $new -> estatus_sede = 0;
        $new -> save();
        return $new;
    }
}
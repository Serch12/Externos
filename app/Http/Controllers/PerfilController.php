<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfil;
use App\Models\Sedes;
use App\Models\Jugadores;
use App\Models\DatoBancario;
use DB;
use Cookie;

class PerfilController extends Controller
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
            $existJugador = Jugadores::count() > 0;
            return view('Perfil.principal')->with(['rol_usuario' => $rol_usuario,'imagen' => $imagen,'sede'=>$sede,'permisos'=>$permisos,'existJugador'=>$existJugador]);
        }else {
            return view('auth.login');
        }
    }
    /**
     * FUNCION QUE MUESTRA EL PERFIL DEL USUARIO LOGUEADO 
     **/
    public function getPerfil(Request $request){

        $perfil = DB::table('users')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->join('tbl_perfil','tbl_perfil.id','=','users.id')
            ->select('roles.name as rol', 'users.id', 'users.name','users.estatus', 'users.email','users.sede','tbl_perfil.*')
            ->where('users.id', $request->id)
            ->first();
        $datoBancario = DatoBancario::where('id_user',$request->id)->get();
        foreach ($datoBancario as $db) {
            if ($db->banco == 'BBVA BANCOMER') {
                $db->imagen_banco = "bancomer.png";
            } elseif($db->banco == 'BANORTE') {
                $db->imagen_banco = "banorte.png";
            } elseif($db->banco == 'CITI BANAMEX') {
                $db->imagen_banco = "banamex.png";
            } elseif($db->banco == 'SANTANDER') {
                $db->imagen_banco = "santander.png";
            } elseif($db->banco == 'HSBC') {
                $db->imagen_banco = "hsbc.png";  
            } elseif($db->banco == 'INBURSA') {
                $db->imagen_banco = "inbursa.png";
            } elseif($db->banco == 'MIFEL') {
                $db->imagen_banco = "mifel.png";
            } elseif($db->banco == 'SCOTIABANK') {
                $db->imagen_banco = "scotiabank.png";
            } elseif($db->banco == 'AMERICAN EXPRESS') {
                $db->imagen_banco = "american.png";
            } elseif($db->banco == 'BANCO AZTECA') {
                $db->imagen_banco = "azteca.jpg";
            } elseif($db->banco == 'BANCOPPEL') {
                $db->imagen_banco = "coppel.png";
            } elseif($db->banco == 'AFIRME') {
                $db->imagen_banco = "afirme.png";
            }  
        }

        return response()->json(['perfil'=>$perfil,'datoBancario'=>$datoBancario]);
    }

    /**
     * FUNCIION QUE CREARA EL PERFIL
     **/
    public function createPerfil(Request $request){

        $perfil = new Perfil(); 
        $perfil -> id = $request->id;
        $perfil -> nombre = $request->nombre;
        $perfil -> apellido_paterno = $request->apellido_paterno;
        $perfil -> apellido_materno = $request->apellido_materno;
        $perfil -> direccion = $request->direccion;
        $perfil -> telefono = $request->telefono;
        $perfil -> cumpleaños = $request->cumpleaños;
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

    /**
     * Funcion que añade el dato bancario
     **/
    public function createDatoBancario(Request $request){
        $new = new DatoBancario();
        $new -> nombre = $request->nombre;
        $new -> id_user = $request->id_user;
        $new -> numero_tarjeta = $request->numero_tarjeta;
        $new -> cuenta_bancaria = $request->cuenta_bancaria;
        $new -> clabe_bancaria = $request->clabe_bancaria;
        $new -> banco = $request->banco;
        $new -> tipo_tarjeta = $request->tipo_tarjeta;
        $new -> estatus = 1;
        $new -> save();

    }

    /**
     * Funcion que añade el dato bancario
     **/
    public function updateDatoBancario(Request $request){
        $new = DatoBancario::find($request->id_datos_bancarios);
        $new -> numero_tarjeta = $request->numero_tarjeta;
        $new -> cuenta_bancaria = $request->cuenta_bancaria;
        $new -> clabe_bancaria = $request->clabe_bancaria;
        $new -> banco = $request->banco;
        $new -> tipo_tarjeta = $request->tipo_tarjeta;
        $new -> save();

    }

    /**
     * Funcion que elimina el dato bancario
     **/
    public function deleteDatoBancario(Request $request){
        $delete = DatoBancario::find($request->id_datos_bancarios);
        $delete -> delete();
    }

}

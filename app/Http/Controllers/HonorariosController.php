<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfil;
use App\Models\Sedes;
use App\Models\Jugadores;
use App\Models\Usuarios;
use App\Models\Honorarios;
use App\Models\DetalleHonorarios;
use Illuminate\Support\Str;
use Mail;
use Carbon\Carbon;
use DB;
use Hash;
use Cookie;

class HonorariosController extends Controller
{
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
            $contraseña = Usuarios::select('acceso')->where('id',auth()->user()->id)->first();
            $password = $contraseña->acceso;
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
            return view('Honorario.principal')->with(['rol_usuario' => $rol_usuario,'imagen' => $imagen,'sede'=>$sede,'permisos'=>$permisos,'existJugador'=>$existJugador]);
        }else {
            return view('auth.login');
        }
    }


    /**
     * Funcion que realizara el formato de honorario y como tambein la habilitacion de cada detalle para cada usuario en el sistema
     **/
    public function validaHonorario(){
        $hoy = Carbon::now();
        $fecha = $hoy->format('Y-m-d');
        $mesActual = $hoy->format('Y-m');

        $usuario = DB::table('users')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
        ->join('role_has_permissions', 'roles.id', '=', 'role_has_permissions.role_id')
        ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
        ->join('tbl_sedes', 'users.sede', '=', 'tbl_sedes.id_sede')
        ->select('roles.name as rol', 'users.id', 'users.name', 'users.email','users.sede', 'tbl_sedes.nombre' ,DB::raw('GROUP_CONCAT(permissions.name) as permisos'))
        ->groupBy('users.id', 'users.name', 'users.email', 'roles.name','users.sede','tbl_sedes.nombre')
        ->where('roles.name','Cuerpo Tecnico')
        ->get();
        
        $hoy = 1;

        if ($hoy === 1) {
            $new = new Honorarios();
            $new ->id_usuario = 6;
            $new -> nombre_usuario = 'Angelica Cabrera';
            $new -> fecha_pago = $fecha;
            $new -> concepto = 'HONORARIOS PROFESIONALES TALENTOS';
            $new -> total_honorario = '0.00';
            $new -> modulo = 'Externos';
            $new ->estatus = 0;
            $new ->save();   
            
            // Guardar los detalles de honorarios
            foreach ($usuario as $user) {
                $newdetalle = new DetalleHonorarios();
                $newdetalle -> id_pago_honorario = $new -> id_pago_honorario;
                $newdetalle -> user_id = $user -> id;
                $newdetalle -> nombre_honorario = $user->name;
                $newdetalle -> sede = $user->nombre;
                $newdetalle -> id_honorario = 0;
                $newdetalle -> estatus = 0;
                $newdetalle -> save();
            }
            return $new;

        }

        if ($hoy->day === 10) {
            // Cambiar el estatus si existe
            $registro = Registro::where('mes', $mesActual)->first();
            if ($registro && $registro->estatus !== 'procesado') {
                $registro->estatus = 'procesado';
                $registro->save();
                $this->info("Estatus del registro actualizado para el mes $mesActual");
            }
        }
    }

    /**
     * Funcion que mostrara los honorarios por cada usuario
     **/
    public function DetalleHonorario($id){
        $detalle = DetalleHonorarios::where('user_id',$id)->get();
        return response()->json(['detalle' => $detalle]);
    }


    /**
     * FUNCION QUE LEE EL ARCHIVO PDF
     **/
    public function lectorPDF(Request $request){
        $file = $request->file('pdf');

        $parser = new Parser();
        $pdf = $parser->parseFile($file->getPathname());
        $text = $pdf->getText();

        // Preprocesado
        $text = preg_replace('/\s+/', ' ', $text);
    }
}

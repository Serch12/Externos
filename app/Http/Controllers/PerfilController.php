<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfil;
use App\Models\Sedes;
use App\Models\Jugadores;
use App\Models\DatoBancario;
use App\Models\Documentacion;
use App\Models\ContratosDigital;
use DB;
use Cookie;
use Carbon\Carbon;
use PDF;
use Illuminate\Support\Facades\Crypt; 

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

        $documento = Documentacion::where('id_perfil',$request->id)->get();
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
        $contrato_firma = ContratosDigital::where('id_usuario',$request->id)->where('estatus',2)->where('firma',null)->get();
        foreach ($contrato_firma as $value) {
            // Verifica si el valor no es nulo o una cadena vacía antes de desencriptar
            if ($value->salario_numero) {
                $value->salario_numero_1 = Crypt::decryptString($value->salario_numero);
            }
            if ($value->salario_texto) {
                $value->salario_texto_1 = Crypt::decryptString($value->salario_texto);
            }
        }
        $contrato_pendiente = $contrato_firma->count();

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
        $contrato = ContratosDigital::where('id_usuario', $request->id)->where('estatus', 2)->whereNotNull('firma')->whereDate('fecha_fin', '>=', now()->toDateString())->get();  
        $contrato_vigente = $contrato->count();
        foreach ($contrato as $c) {
            $prox_fecha = $c->fecha_fin;
        }

        return response()->json(['perfil'=>$perfil,'datoBancario'=>$datoBancario,
        'documento'=>$documento,'contrato_firma'=>$contrato_firma,'contrato_pendiente'=>$contrato_pendiente,'historial_contrato'=>$historial_contrato,'contrato_total'=>$contrato_total,'contrato_vigente'=>$contrato_vigente,'prox_fecha'=>$prox_fecha]);
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


    /**
     * funcion que actualizara la documentacion del usuario
     **/
    public function newDocumento(Request $request){

        $new = new Documentacion();
        $new -> id_perfil = $request->id_perfil;
        $new -> tipo = $request->tipo;

        $file = $request->file('documento');
        if (isset($file)) {

            // Obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $urlimagen = $request->id_perfil."/".'Documentacion' . "/" . $nombre;
            \Storage::disk('perfil')->put($urlimagen, \File::get($file));
            $new->archivo = $nombre;
        }

        $new -> save();
        return $new;
        
    }

    /**
     * funcion que actualizara la documentacion del usuario
     **/
    public function updateDocumento(Request $request){

        $update = Documentacion::find($request->id_documentacion);
        $update -> tipo = $request->tipo;

        $file = $request->file('documento');
        if (isset($file)) {
            \Storage::disk('perfil')->delete($update->id_perfil.'/'.'Documentacion'.'/'.$update->archivo);
            // Obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $urlimagen = $request->id_perfil."/".'Documentacion' . "/" . $nombre;
            \Storage::disk('perfil')->put($urlimagen, \File::get($file));
            $update->archivo = $nombre;
        }

        $update -> save();
        return $update;
        
    }

    /**
     * funcion que mostrara el contrato
     **/
    public function verContrato(Request $request) {
        $contrato = ContratosDigital::find($request->id_contrato_digital);
        if (!$contrato || $contrato->tipo_contrato !== 'honorarios') { // Cambiar a 'honorarios'
            return response()->json(['message' => 'Contrato no encontrado o no es de tipo honorarios'], 404);
        }
        $firmaalvaro = public_path('ArchivosSistema/Perfil/FirmaAlvaro.png');
        $salario_numero = $contrato->salario_numero ? Crypt::decryptString($contrato->salario_numero) : 0;
        $salario_texto = $contrato->salario_texto ? Crypt::decryptString($contrato->salario_texto) : '';
        $actividades_array = explode("\n", $contrato->actividades_realizar);
        $listado_html = '<ul>';
        foreach ($actividades_array as $actividad) {
            $actividad = trim($actividad); // Eliminar espacios en blanco extra al inicio/fin
            if (!empty($actividad)) { // Asegurarse de que la línea no esté vacía
                $listado_html .= '<li>' . htmlspecialchars($actividad) . '</li>';
            }
        }
        $listado_html .= '</ul>';
        // Prepara los datos para la plantilla del contrato de honorarios
        $data = [
            'id_contrato_digital' => $contrato->id_contrato_digital,
            'nombre_usuario' => $contrato->nombre_completo,
            'nacionalidad' => $contrato->nacionalidad,
            'sexo' => $contrato->sexo,
            'edad' => $contrato->edad,
            'estado_civil' => $contrato->estado_civil,
            'profesion' => $contrato->profesion,
            'cedula_profesional' => $contrato->cedula_profesional,
            'domicilio' => $contrato->domicilio,
            'codigo_postal' => $contrato->codigo_postal,
            'entidad' => $contrato->entidad,
            'RFC' => $contrato->RFC,
            'curp' => $contrato->curp,
            'puesto' => $contrato->puesto_desempenar,
            'salario_numero' => "$" . number_format($salario_numero, 2),
            'salario_texto' => $salario_texto,
            'fecha_inicio' => mb_strtoupper(Carbon::parse($contrato->fecha_inicio)->translatedFormat('d \d\e F \d\e Y')),
            'fecha_fin' => mb_strtoupper(Carbon::parse($contrato->fecha_fin)->translatedFormat('d \d\e F \d\e Y')),
            'fecha_firma_contrato_texto' => mb_strtoupper(Carbon::parse($contrato->fecha_firma_contrato)->translatedFormat('d \d\e F \d\e Y')),
            'actividades_realizar' => $listado_html,
            'firma' => $contrato->firma,
            'firma_alvaro' => $firmaalvaro
        ];

        // Generar el HTML de la vista Blade con los datos
        // Asegúrate de que 'Pdf.contratoHonorarios' apunte a la nueva vista Blade: resources/views/Pdf/contratoHonorarios.blade.php
        $html = view('Pdf.contratoHonorarios', $data)->render();

        // Generar el PDF
        $pdf = Pdf::loadHtml($html);

        // Opcional: Configurar tamaño de papel y orientación (mantener si es necesario)
        // $pdf->setPaper('A4', 'portrait');

        // Retornar el PDF para que se muestre en el navegador
        return $pdf->stream('contrato_honorarios_' . $contrato->nombre_usuario . '.pdf'); 
    }

    /**
     * funcion que agregara la firma del contrato digital
     **/
    public function createFirmaContrato(Request $request){

        $update = ContratosDigital::find($request->id_contrato_digital);
        // Decodificar la cadena base64 de la firma usuario
        $firmaContrato = $request->input('firma_contrato');

        if (preg_match('/^data:image\/\w+;base64,/', $firmaContrato)) {
            $imageusuario = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $firmaContrato));
            //obtenemos el nombre del archivo

            $url = strtoupper(str_replace(' ', '_', $update->nombre_completo.'_'.'CI'.$update->id_contrato_digital)) . '.'. 'png';

            $nombreUsuario = $url;


            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('contratos')->put($nombreUsuario,$imageusuario);
            $update -> firma = $url;
        }

        $update -> save();
        return $update;
    }

}

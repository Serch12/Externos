<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perfil;
use App\Models\Sedes;
use App\Models\Jugadores;
use App\Models\Usuarios;
use App\Models\Honorarios;
use App\Models\DetalleHonorarios;
use App\Models\DatoBancario;
use Illuminate\Support\Str;
use Smalot\PdfParser\Parser;
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
        

        if ($hoy->day === 1) {
            $new = new Honorarios();
            $new ->id_usuario = 6;
            $new -> nombre_usuario = 'Angelica Cabrera';
            $new -> fecha_pago = $fecha;
            $new -> concepto = 'HONORARIOS PROFESIONALES TALENTOS ' . $mesActual;
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
                $newdetalle -> subtotal = 0.00;
                $newdetalle -> iva = 0.00;
                $newdetalle -> iva_retenido = 0.00;
                $newdetalle -> isr = 0.00;
                $newdetalle -> total = 0.00;
                $newdetalle -> estatus = 1;
                $newdetalle -> save();
            }
            return $new;

        }

        if ($hoy->day === 10) {
            // Cambiar el estatus si existe
            $mesActual = Carbon::now()->format('m');
            $añoActual = Carbon::now()->format('Y');
            
            $registro = Honorarios::whereYear('fecha_pago', $añoActual)
                ->whereMonth('fecha_pago', $mesActual)
                ->first();

            $edit = Honorarios::find($registro->id_pago_honorario);
            $edit->estatus = 1;
            $edit->save();

            $detalle = DetalleHonorarios::where('id_pago_honorario',$registro->id_pago_honorario)->get();
            foreach ($detalle as $det) {
                $det->estatus = 3;
                $det->save();
            }
        }
    }

    /**
     * Funcion que mostrara los honorarios por cada usuario
     **/
    public function DetalleHonorario($id){
        $detalle = DetalleHonorarios::where('user_id',$id)->whereIn('estatus',[0,1,2])->get();
        $valida = $this->EstatusHono($detalle);
        $banco = DatoBancario::where('id_user',$id)->get();
        return response()->json(['detalle' => $detalle, 'banco' => $banco]);
    }

    /**
     * Funcion que validara el estatus de cada honorario
     **/
    public function EstatusHono($detalle){
        foreach ($detalle as $value) {

            if ($value->estatus == 0) {
                $value->color = 'warning';
                $value->text = 'Revisión';
            }
            if ($value->estatus == 1) {
                $value->color = 'info';
                $value->text = 'En Proceso';
            }
        }
    }


    /**
     * FUNCION QUE LEE EL ARCHIVO PDF
     **/

     private function extract($text, $pattern){
        preg_match($pattern, $text, $matches);
        return $matches[1] ?? null;
    }
    public function lectorPDF(Request $request){
        
        $file = $request->file('file');

        $parser = new Parser();
        $pdf = $parser->parseFile($file->getPathname());
        $text = $pdf->getText();

        // Preprocesado
        $text = preg_replace('/\s+/', ' ', $text);

        $edit = DetalleHonorarios::find($request->id_detalle_pago_honorario);
            if ($edit->archivo_recibo != null) {
                \Storage::disk('honorario')->delete($edit->archivo_recibo);
            }
            $file = $request->file('file');
            if(isset($file)){
                $file = $request->file('file');
                $nombre = $file->getClientOriginalName();
                $hoy = Carbon::today()->format('Ymd'); 
                $url = $hoy."-".$request->nombre_honorario."-".$nombre;
                \Storage::disk('honorario')->put($url, \File::get($file));
                $edit->archivo_recibo = $url;
            }
        $edit -> save();

        // Extracción de datos
        $data = [
            'id_detalle_pago_honorario' => $request->id_detalle_pago_honorario,
            'nombre_emisor' => $this->extract($text, '/Nombre emisor:\s*(.*?)RFC receptor/'),
            'numero_recibo' => $this->extract($text, '/Folio fiscal:\s*([A-Z0-9\-]+)/'),
            'RFC' => $this->extract($text, '/RFC emisor:\s*(\w{13})/'),
            'subtotal' => $this->extract($text, '/Subtotal\s+\$\s*([\d,\.]+)/'),
            'iva' => $this->extract($text, '/IVA\s+16\.00%\s+\$\s*([\d,\.]+)/'),
            'iva_retenido' => $this->extract($text, '/Impuestos retenidos\s+IVA\s+.*?\$?\s*([\d,\.]+)/'),
            'isr' => $this->extract($text, '/ISR\s+\$\s*([\d,\.]+)/'),
            'total' => $this->extract($text, '/Total\s+\$\s*([\d,\.]+)/'),
            'nombre_honorario' => $request->nombre_honorario,
            'sede' => $request->sede,
            'archivo_recibo' => $edit->archivo_recibo,
        ];

        // Limpieza de datos numéricos
        foreach (['subtotal', 'iva_trasladado', 'iva_retenido', 'isr_retenido', 'total'] as $key) {
            if (isset($data[$key])) {
                $data[$key] = floatval(str_replace(',', '', $data[$key]));
            }
        }



        return $data;
    }

    /**
     * FUNCION QUE AGREGARA UN NUEVO HONORARIO
     **/
    public function AgregarHonorario(Request $request){
        $edit = DetalleHonorarios::find($request->id_detalle_pago_honorario);
        $edit->RFC = $request->RFC;
        $edit->banco = $request->banco;
        $edit->cuenta_bancaria = $request->cuenta_bancaria;
        $edit->clabe_interbancaria = $request->clabe_interbancaria;
        $edit->subtotal = $request->subtotal;
        $edit->iva = $request->iva;
        $edit->iva_retenido = $request->iva_retenido;
        $edit->isr = $request->isr;
        $edit->total = $request->total;
        $edit->numero_recibo = $request->numero_recibo;
        $edit->estatus = 0;
        $edit->save();

        $pagosN = DetalleHonorarios::where('id_pago_honorario',$edit->id_pago_honorario)->get();

        $total_pago = 0;
        foreach ($pagosN as $total) {
            $total_pago += $total->total;
        }


        $date = Honorarios::find($edit->id_pago_honorario);
        $date->total_honorario = $total_pago;
        $date->save();
        return $date;
    }
}

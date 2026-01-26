<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sedes;
use App\Models\Perfil;
use App\Models\Usuarios;
use App\Models\Jugadores;
use App\Models\RegistroJugador;
use DB;
use Hash;
use Carbon\Carbon;

class VisoriasController extends Controller
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
            return view('Visorias.principal')->with(['rol_usuario' => $rol_usuario,'imagen' => $imagen,'sede'=>$sede,'permisos'=>$permisos,'existJugador'=>$existJugador]);
        }else {
            return view('auth.login');
        }
    }

    /**
     * FUNCION QUE MUESTRA LOS JUGADORES POR SEDE
     **/
    public function listaJugadores($sede,$rol_usuario){
        if($rol_usuario == 'Root'){
            $jugadores = RegistroJugador::latest()->get();
        }else{
            $jugadores = RegistroJugador::where('lugar_visoria', $sede)->latest()->get();
        }
        $total = $jugadores->count();
        foreach ($jugadores as $jugador) {
            $jugador->fecha_nacimiento_texto = Carbon::parse($jugador->fecha_nacimiento)->locale('es')->isoFormat('D [de] MMMM [de] Y');
            $jugador->fecha_registro_texto = Carbon::parse($jugador->created_at)->locale('es')->isoFormat('D [de] MMMM [de] Y');
        }
        return response()->json([
            'total' => $total,
            'jugadores' => $jugadores
        ]);
    }

    public function updateArchivo(Request $request, $id) {
        // 1. Validar que el archivo sea correcto
        $request->validate([
            'nuevo_archivo' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $registro = RegistroJugador::findOrFail($id);

        if ($request->hasFile('nuevo_archivo')) {
            // 2. Eliminar el archivo anterior para no llenar el servidor de basura
            if ($registro->formato_firmado) {
                \Storage::disk('perfil')->delete($registro->formato_firmado);
            }

            // 3. Procesar el nuevo archivo
            $file = $request->file('nuevo_archivo');
            $nombreLimpio = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $nombreFinal = $nombreLimpio . '_' . date('Ymd_His') . '.' . $file->getClientOriginalExtension();
            
            $url = $id . "/" . $nombreFinal;
            
            // 4. Guardar en el disco 'perfil'
            \Storage::disk('perfil')->put($url, \File::get($file));
            
            // 5. Actualizar la base de datos
            $registro->formato_firmado = $url;
            $registro->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Documento actualizado'
            ]);
        }
    }

    /**
     * funcion que valida el estatus del jugador al momento de la visoria
     */
    public function validarEstatus($id) {
        $registro = RegistroJugador::find($id);
        if (!$registro) {
            return redirect()->to('/visorias')
                            ->with('error', 'Registro no encontrado o código QR inválido.');
        }

        // 3. Actualizar la variable de estatus
        $registro->estatus = 1;
        $registro->save();
        return redirect()->to('/visorias')
                        ->with('status', "¡Registro actualizado! Asistencia confirmada para: {$registro->nombre}");
    }
}

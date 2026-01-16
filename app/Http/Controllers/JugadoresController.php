<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\JugadoresHelper;
use App\Repositories\JugadoresRepository;
use App\Models\Perfil;
use App\Models\Sedes;
use App\Models\Jugadores;
use App\Models\RegistroJugador;
use Carbon\Carbon;

class JugadoresController extends Controller
{
 
    /**
     * @var JugadoresHelper
     */
    private $JugadoresHelper;
    
    /**
     * @var JugadoresRepository
     */
    private $JugadoresRepository;

    public function __construct(JugadoresHelper $JugadoresHelper, JugadoresRepository $JugadoresRepository)
    {
        $this->JugadoresHelper = $JugadoresHelper;
        $this->JugadoresRepository = $JugadoresRepository;
    }

    /**
     * FUNCION QUE MUESTRA LA VISTA
     **/
    public function index(){
        if (auth()->check()) {
            $info_usuario = $this->JugadoresRepository->rolUsuarioGeneral();
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
            return view('Jugadores.principal')->with(['rol_usuario' => $rol_usuario,'imagen' => $imagen,'sede'=>$sede,'permisos'=>$permisos,'existJugador'=>$existJugador]);
        }else {
            return view('auth.login');
        }
    }

    /**
     * FUNCION QUE MUESTRA LOS JUGADORES
     **/
    public function getJugador(Request $request){
        $muestra = $this->JugadoresRepository->getJugador($request);
        $valida = $this->JugadoresHelper->validaJugador($muestra);
        return response()->json(['muestra'=>$muestra,
        'pagination'=>['total' => $muestra->total(),
            'current_page' => $muestra->currentPage(),
            'per_page' => $muestra->perPage(),
            'last_page' => $muestra->lastPage(),
            'from' => $muestra->firstItem(),
            'to' => $muestra->lastPage()
            ]]);
    }

    /**
     * verifica si el numero del dorsal esta en uso
     **/
    public function verificaDorsal(Request $request){
        return $this->JugadoresRepository->verificaDorsal($request);
    }

    /**
     * FUNCION QUE CREARA LOS JUGADORES
     **/
    public function createJugador(Request $request){
        return $this->JugadoresRepository->createJugador($request);
    }
    

    /**
     * FUNCION QUE EDITARA EL JUGADOR
     **/
    public function updateJugador(Request $request){
        return $this->JugadoresRepository->updateJugador($request);
    }

    /**
     * FUNCION QUE ELIMINA LOS ARCHIVOS DE LOS JUGADORES
     **/
    public function deleteArchivo($id){
        return $this->JugadoresRepository->deleteArchivo($id);
    }

    /**
     * FUNCION QUE GUARDARA LA INFORMACION DE TUTOR
     **/
    public function createTutor(Request $request){
        return $this->JugadoresRepository->createTutor($request);
    }

    /**
     * funcion que cambiara de estatus al jugador 
     **/
    public function cambioEstatus(Request $request){
        return $this->JugadoresRepository->cambioEstatus($request);
    }


    /**
     * funcion que eliminara el jugador
     **/
    public function deleteJugador(Request $request){
        return $this->JugadoresRepository->deleteJugador($request);
    }

    public function registroVisorias(Request $request){
            $fecha_nacimiento  = $request->fecha_nacimiento;
            $edad = Carbon::parse($fecha_nacimiento )->age;
            $registro = new RegistroJugador();
            $registro->nombre              = $request->nombre;
            $registro->lugar_visoria       = $request->lugar_visoria;
            $registro->edad                = $edad;
            $registro->fecha_nacimiento    = $request->fecha_nacimiento;
            $registro->posicion            = $request->posicion;
            $registro->perfil              = $request->perfil;
            $registro->estatura            = $request->estatura;
            $registro->peso                = $request->peso;
            $registro->tiempo_jugando      = $request->tiempo_jugando;
            $registro->equipos_jugando     = $request->equipos_jugando;
            $registro->profesional_amateur = $request->profesional_amateur;
            $registro->domicilio           = $request->domicilio;
            $registro->telefono            = $request->telefono;
            $registro->correo              = $request->correo;
            $registro->escuela             = $request->escuela;
            $registro->persona_recomienda  = $request->persona_recomienda;
            $registro->enfermedad          = ($request->enfermedad == 'Si') ? $request->enfermedad_detalle : 'Ninguna';
            $registro->terminos            = $request->terminos;
            $registro->solicitud_dinero    = $request->solicitud_dinero;
            $registro->nombre_quien_pago   = $request->nombre_quien_pago;
            $file = $request->file('formato_firmado');
            if ($request->hasFile('formato_firmado')) {
                $file = $request->file('formato_firmado');
                
                // Obtenemos el nombre original y su extensión
                $extension = $file->getClientOriginalExtension();
                $nombreLimpio = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                
                // Creamos el nuevo nombre: nombreOriginal_20260116_161025.pdf
                $nombreFinal = $nombreLimpio . '_' . date('Ymd_His') . '.' . $extension;
                
                // Definimos la ruta: id/nombre_fecha_hora.ext
                $url = $request->id . "/" . $nombreFinal;
                
                // Guardamos en el disco 'perfil'
                \Storage::disk('perfil')->put($url, \File::get($file));
                
                // Guardamos la ruta en la base de datos
                $registro->formato_firmado = $url;
            }
            
            $registro->save();

            return response()->json([
                'status'  => 'success',
                'message' => 'Registro de visoria guardado correctamente.'
            ], 200);

       
    }
}

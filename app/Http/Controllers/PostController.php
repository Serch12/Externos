<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositories\PostRepository;
use App\Helpers\PostHelper;
use App\Models\Perfil;
use App\Models\Sedes;
use App\Models\Post;
use App\Models\ImagenesComunicado;
use DB;
use Hash;
use Cookie;

class PostController extends Controller
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
            return view('Post.principal')->with(['rol_usuario' => $rol_usuario,'imagen' => $imagen,'sede'=>$sede,'permisos'=>$permisos]);
        }else {
            return view('auth.login');
        }
    }

    /**
     * funcion que retorna la busqueda
     */
    public function busquedaPost(Request $request){
        $parametro = $request->buscador;
        if ($parametro == null) {

            $listaPost = Post::select('*')
            ->orderBy('id_p','DESC')
            ->paginate(10);
        } else {
            $listaPost = Post::select('*')
            ->where(function($query) use ($parametro) {
                $query->where('titulo','LIKE','%'.$parametro.'%')
                ->orWhere('categoria','LIKE','%'.$parametro.'%')
                ->orWhere('fecha','LIKE','%'.$parametro.'%');
            })
            ->orderBy('id_p','DESC')
            ->paginate(10);
        }

        $data = Post::latest('id_p')->first();
        $ultimo_id = $data->id_p;
        foreach ($listaPost as $value) {
          $value-> exist_imgp  = Storage::disk('post')->exists($value->imagen_p);
        }
        return response()->json(['listaPost'=>$listaPost,
        'ultimo'=>$ultimo_id,
        'pagination'=>['total' => $listaPost->total(),
        'current_page' => $listaPost->currentPage(),
        'per_page' => $listaPost->perPage(),
        'last_page' => $listaPost->lastPage(),
        'from' => $listaPost->firstItem(),
        'to' => $listaPost->lastPage()
        ]]);
    }

    /**
     * funcion que creara un nuevo post
     */
    public function nuevoPost(Request $request){

        $post = new Post();
        $post->titulo = $request->titulo;
        $post->subtitulo = $request->subtitulo;
        $post->ruta = $request->ruta;
        $post->fecha = $request->fecha;
        $post->categoria = $request->categoria;
        $post->informacion = $request->informacion;
        $post->estatus = 0;
        $imagen = $request->file('imagen_sola');
        if(isset($imagen)){
            $file = $request->file('imagen_sola');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $url = $nombre;
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('post')->put($url,  \File::get($file));
            $post->imagen_p = $url;
        }else{
            $post->imagen_p = '';
        }
        $post->save();

        $var = $request->file('files');
        if (isset($var)){
            foreach ($request->file('files') as $key => $value) {
                $imagen = new ImagenesComunicado();
                $imagen->id_comunicado = $post->id_p;
                //obtenemos el nombre del archivo
                $nombre = $value->getClientOriginalName();
                $urlimagen = $nombre;
                //indicamos que queremos guardar un nuevo archivo en el disco local
                \Storage::disk('post')->put($urlimagen,  \File::get($value));
                $imagen->nombre = $urlimagen;
                $imagen->activo = 1;
                $imagen->save();
            }
        }
        return $imagen;

    }

    /**
     * funcion que cambia el estatus del post
     */
    public function estatus($id,$estatus){
        $edc = Post::find($id);
        $edc->estatus = $estatus;
        $edc->save();
        return $edc;
    }
    /**
     * funcion que edita un post
     */

     public function edita(Request $request, $id){

        $edita = Post::find($id);

        if ($request->file('imagen_sola')) {
            $imagenAnterior = $edita['imagen_p'];
            \Storage::disk('post')->delete($imagenAnterior);
        }

        if ($request->file('imagen_sola')) {
            $file = $request->file('imagen_sola');
            $nombre = $file->getClientOriginalName();
            $url = $nombre;
            \Storage::disk('post')->put($url,  \File::get($file));
            $edita->imagen_p = $url;
        }else{
            $edita->imagen_p = $request->imagen_sola;
        }
        $edita->titulo = $request->titulo;
        $edita->subtitulo = $request->subtitulo;
        $edita->ruta = $request->ruta;
        $edita->fecha = $request->fecha;
        $edita->categoria = $request->categoria;
        $edita->informacion = $request->informacion;

        $img = $request->file('filesEdita');
        if (isset($img)){
            foreach ($request->file('filesEdita') as $key => $value) {
                $imagen = new ImagenesComunicado();
                $imagen->id_comunicado = $edita->id_p;
                //obtenemos el nombre del archivo
                $nombre = $value->getClientOriginalName();
                $urlimagen = $nombre;
                //indicamos que queremos guardar un nuevo archivo en el disco local
                \Storage::disk('post')->put($urlimagen,  \File::get($value));
                $imagen->nombre = $urlimagen;
                $imagen->activo = 1;
                $imagen->save();
            }
        }
        $edita->save();
     }
     /**
      * funcion que recibe los archivo cargados
      */
      public function cargaImagenes (Request $request){
        $files = $request->file('files');
           return response()->json(['success' => true]);
      }
      /**
       * funcion que retorna todas la imagenes por su id relacionado con la publicacion
       */
    public function muestraImagenes($id){
        $imagenes = ImagenesComunicado::select('*')
        ->where('id_comunicado',$id)
        ->get();
        foreach ($imagenes as $value) {
            $value-> img_value  = Storage::disk('post')->exists($value->nombre);
        }

        return response()->json(['imagenes'=>$imagenes]);
    }
      /**
       * funcion que elimina la imagen en la base de datos
       */
    public function eliminaImagen($id){

        $imagen = ImagenesComunicado::find($id);

        if ($imagen) {
            // Elimina la imagen de la base de datos
            $imagen->delete();
            // Elimina la imagen del almacenamiento
            \Storage::disk('post')->delete($imagen->ruta);
            return response()->json(['mensaje' => 'Imagen eliminada correctamente']);
        }
    }

}

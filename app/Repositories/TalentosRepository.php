<?php


namespace App\Repositories;
use Illuminate\Support\Facades\Storage;
use App\Models\Talentos;
use App\Models\IMGTalentos;
use App\Models\Torneo;
use App\Models\DateBanners;
use App\Models\DateIMGBanner;
use Carbon\Carbon;
use DateTime;
use Mail;
use DB;
use Hash;
use Cookie;

class TalentosRepository
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
     * funcion que mostrar las publicaciones de talentos
     **/
    public function getTalentos($request){
        $parametro = $request->buscador;

        $data = Talentos::select('*')
            ->where(function($query) use ($parametro) {
                $query->where('copa','LIKE','%'.$parametro.'%')
                ->orWhere('fase','LIKE','%'.$parametro.'%')
                ->orWhere('categoria','LIKE','%'.$parametro.'%');
            })
            ->orderBy('id_talento','DESC')
            ->paginate(10);
            foreach ($data as $value) {
                $value-> exit_hidder  = Storage::disk('talentos')->exists($value->hidder);
            }
        return $data;
    }

    /**
     * funcion que mostrara la galeria de talentos
     **/
    public function galeriaTalento($id){
        $data = IMGTalentos::where('talento_id',$id)->get();
        foreach ($data as $value) {
            $value-> exit_img  = Storage::disk('talentos')->exists($value->img);
        }
        return $data;
    }


    /**
     * funcion que cambiara el estatus de la publicacion
     **/
    public function activacion($request) {
        $r = Talentos::find($request->id_talento);
        $r -> estatus = $request->estatus;
        $r -> save();
        return $r;
    }

    /**
     * funcion para eliminar una imagen de la galeria
     **/
    public function eliminarImagen($id){
        $data = IMGTalentos::find($id);
            \Storage::disk('talentos')->delete($data->img);
        $data->delete();
        return $data;
    }

    /**
     * funcion que editara la informacion de talentos
     **/
    public function updateTalento($request){

        $update = Talentos::find($request->id_talento);

        $hidder = $request->file('hidder');
        if (isset($hidder)) {
            $file = $request->file('hidder');
            //obtenemos el nombre del archivo
            $nombre = $file->getClientOriginalName();
            $url = $request->copa."-".$request->year."-".$nombre;
            //indicamos que queremos guardar un nuevo archivo en el disco local
            \Storage::disk('talentos')->put($url,  \File::get($file));
            $update->hidder = $url;
        }
        $update -> fecha = $request -> fecha;
        $update -> year = $request -> year;
        $update -> copa = $request -> copa;
        $update -> fase = $request -> fase; 
        $update -> categoria = $request -> categoria;
        $update -> num_jugadores = $request -> num_jugadores;
        $update -> descripcion = $request -> descripcion;
        $update -> save();

        $imagenes = $request->file('galerianew');
        if (isset($imagenes)) {
            foreach ($imagenes as $img) {
                $i = new IMGTalentos();
                    // Obtener el nombre original del archivo
                    $nombre = $img->getClientOriginalName();
                    $url = $request->copa."-".$request->year."-".$nombre;
                    //indicamos que queremos guardar un nuevo archivo en el disco local
                    \Storage::disk('talentos')->put($url, \File::get($img));
                $i ->talento_id = $update -> id_talento;
                $i ->img = $url;
                $i -> estatus_img = 0;
                $i -> save();
            }
        }
        return $update;
    }

    /**
     * funcion que eliminara la publicacion de talentos
     **/
    public function Talentodelete($request){

        $delete = Talentos::find($request->id_talento);
            \Storage::disk('talentos')->delete($delete->hidder);
            $data = IMGTalentos::where('talento_id',$request->id_talento)->get();
            $torneo = Torneo::where('id_talento',$request->id_talento)->get();
            foreach ($torneo as $t) {
                $update = Torneo::find($t->id_torneo);
                $update->id_talento = 0;
                $update->save();
            }
            foreach ($data as $value) {
                $data1 = IMGTalentos::find($value->id_img_talento);
                    \Storage::disk('talentos')->delete($data1->img);
                $data1->delete();
            }
        $delete->delete();
       return $delete;
    }

    /* FUNCIONES DE BANNERS */

    /**
     * funcion que mostrar los banner
     **/
    public function getBanner($request) {
        $parametro = $request->buscador;

        $data = DateIMGBanner::select('*',\DB::raw('DATE(tbl_date_imgbanners.created_at) as created_date'))

            ->orderBy('id_imgbanner','DESC')
            ->paginate(10);
        return $data;
    }

    /**
     * funciones que se registrara los banners
     **/
    public function createBanner($request){
    
        $galeria = $request->file('img');
        if (isset($galeria)){
            foreach ($request->file('img') as $key => $value) {
                $imagen = new DateIMGBanner();
                //obtenemos el nombre del archivo
                $nombre = $value->getClientOriginalName();
                $urlimagen = $hoy = Carbon::today()->format('Y/m/d').'gale'."-". $nombre;
                //indicamos que queremos guardar un nuevo archivo en el disco local
                \Storage::disk('datebanner')->put($urlimagen,  \File::get($value));
                $imagen->img_banner = $urlimagen;
                $imagen->save();
            }
        }
        return $imagen;
    }

    /**
     * funcion de activacion/desactivacion de banners
     **/
    public function InactivoActivo($request){
        $update = DateIMGBanner::find($request->id_imgbanner);
        $update->estatus = $request->estatus;
        $update -> save();
        return $update;
    }

    /**
     * funcion de activacion/desactivacion de banners
     **/
    public function deleteBanner($request){
        $update = DateIMGBanner::find($request->id_imgbanner);
        \Storage::disk('datebanner')->delete($update->img_banner);
        $update -> delete();
        return $update;
    }

}
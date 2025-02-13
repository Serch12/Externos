<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    use HasFactory;
    protected $table='tbl_notificaciones';
    protected $primaryKey = 'id_notificacion';
    protected $fillable= ['descripcion', 'id_user_de', 'id_user_para', 'modulo', 'detalle_notificacion', 'url', 'estatus'];
}

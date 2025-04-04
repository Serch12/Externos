<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recordatorio extends Model
{
    use HasFactory;
    protected $table='tbl_recordatorios';
    protected $primaryKey = 'id_recordario';
    protected $fillable= ['id_user','titulo','fecha_inicia','fecha_termina','descripcion','estatus'];
}

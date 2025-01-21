<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sedes extends Model
{
    use HasFactory;
    protected $table='tbl_sedes';
    protected $primaryKey = 'id_sede';
    protected $fillable= ['id_sede','nombre', 'ubicacion','lugar_entrenamiento','contactos','fecha_registro', 'estatus_sede'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;
    protected $table='tbl_perfil';
    protected $primaryKey = 'id_perfil';
    protected $fillable= ['id','foto', 'nombre','apellido_paterno','apellido_materno','direccion', 'telefono','sede'];
}

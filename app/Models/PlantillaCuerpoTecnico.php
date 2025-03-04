<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantillaCuerpoTecnico extends Model
{
    use HasFactory;
    protected $table='tbl_plantilla_cuerpo_tecnico';
    protected $primaryKey = 'id_plantilla_tecnico';
    protected $fillable= ['id_plantilla_tecnico','id_torneo','folio', 'nombre','puesto','sexo','edad','sede', 'estatus'];
}

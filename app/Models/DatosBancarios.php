<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosBancarios extends Model
{
    use HasFactory;
    protected $table='tbl_datos_bancarios';
    protected $primaryKey = 'id_datos_bancarios';
    protected $fillable= ['id_datos_bancarios','id_torneo', 'nombre','banco','cuenta_bancaria','clabe_bancaria', 'numero_tarjeta','tipo_tarjeta','archivo','estatus'];
}

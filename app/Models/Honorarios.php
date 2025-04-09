<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Honorarios extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table='tbl_pago_honorarios';
    protected $primaryKey = 'id_pago_honorario';
    protected $fillable= ['id_usuario',
                          'nombre_usuario',
                          'fecha_pago',
                          'concepto',
                          'total_honorario',
                          'estatus',
                          'archivo_pago'
                         ];
                         
}

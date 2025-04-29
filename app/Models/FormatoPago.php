<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormatoPago extends Model
{
    use HasFactory;
    protected $table='tbl_formato_pago_torneo'; 
    protected $primaryKey = 'id_formato';
    protected $fillable= ['id_formato',
        'crecion',
        'nombre',
        'rfc',
        'banco',
        'cuenta_bancaria',
        'clabe_bancaria',
        'direccion',
        'telefono',
        'email',
        'subtotal',
        'total',
        'tipo_persona',
        'inscripcion',
        'estatus'];
}

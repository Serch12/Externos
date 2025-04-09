<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleHonorarios extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table='tbl_detalle_pago_honorarios';
    protected $primaryKey = 'id_detalle_pago_honorario';
    protected $fillable= ['id_pago_honorario',
                          'id_honorario',
                          'nombre_honorario',
                          'sede',
                          'RFC',
                          'banco',
                          'cuenta_bancaria',
                          'clabe_interbancaria',
                          'subtotal',
                          'iva',
                          'iva_retenido',
                          'isr',
                          'total',
                          'numero_recibo',
                          'archivo_recibo',
                          'archivo_recibo_pago_persona',
                          'estatus'];
}

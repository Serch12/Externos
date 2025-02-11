<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProveedoresIntranet extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table='adm_proveedores';
    protected $primaryKey = 'id_pro';
    protected $fillable= ['id_user', 'nombre', 'rfc', 'banco','ctaBanc','cbeBanc','direccion','telefono','mail','ejecutivo','tipo_persona','estatus', 'fec_sys'];
}

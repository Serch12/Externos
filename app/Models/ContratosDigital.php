<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContratosDigital extends Model
{
    use HasFactory;
    protected $table='tbl_contratos_digital';
    protected $primaryKey = 'id_contrato_digital';
    protected $fillable= ['id_usuario','nombre_completo','id_usuario_creo','origen','origen_sede','nacionalidad','sexo','edad','estado_civil','profesion','cedula_profesional','domicilio','codigo_postal','entidad','RFC','curp','puesto_desempenar','salario_numero','salario_texto','fecha_antiguedad','fecha_firma_contrato','fecha_inicio','fecha_fin','actividades_realizar','tipo_contrato','estatus'];
}

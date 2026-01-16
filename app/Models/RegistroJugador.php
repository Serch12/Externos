<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroJugador extends Model
{
    use HasFactory;
    protected $table='tbl_registro_jugador';
    protected $primaryKey = 'id_registro_jugador';
    protected $fillable= ['nombre','lugar_visoria','edad','fecha_nacimiento','posicion','perfil','estatura','peso','tiempo_jugando','equipos_jugando','profesional_amateur','domicilio','telefono','correo','escuela','persona_recomienda','enfermedad','terminos','solicitud_dinero','nombre_quien_pago','formato_firmado','estatus'];
}

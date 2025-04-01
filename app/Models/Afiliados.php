<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afiliados extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table='afiliados';
    protected $primaryKey = 'id_afi';
    protected $fillable= ['key_amf',
                            'nombre', 
                          'apellido_pat', 
                          'apellido_mat', 
                          'apodo',
                          'sexo',
                          'nacionalidad',
                          'origen',
                          'escolaridad',
                          'mail',
                          'edad',
                          'curp',
                          'nacimiento',
                          'fb',
                          'ins',
                          'tw',
                          'calle',
                          'colonia',
                          'estado',
                          'ciudad',
                          'cp',
                          'celular',
                          'telCasa',
                          'division',
                          'club',
                          'categoria',
                          'nui',
                          'posicion',
                          'seleccion',
                          'estatus',
                          'exfut',
                          'pdf',
                          'pdf2',
                          'fronttutor',
                          'backtutor',
                          'nombre_tutor',
                          'firma_tutor',
                          'firma_tutor_2',
                          'foto',
                          'estatus_app',
                          'aprobacion_app',
                          'fec_registro',
                          'fecha'];
}

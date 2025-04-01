<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Correos extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table='tbl_correos'; 
    protected $primaryKey = 'id_correo';
    protected $fillable= ['fecha', 'destinatario', 'asunto', 'informacion','enviados','pendientes','estatus'];
}

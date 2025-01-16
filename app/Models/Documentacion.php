<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentacion extends Model
{
    use HasFactory;
    protected $table='tbl_documentacion';
    protected $primaryKey = 'id_documentacion';
    protected $fillable= ['id_documentacion','id_perfil', 'tipo','archivo','estatus'];
}

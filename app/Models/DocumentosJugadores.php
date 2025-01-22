<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosJugadores extends Model
{
    use HasFactory;
    protected $table='tbl_documentos_jugador';
    protected $primaryKey = 'id_docu_jugador';
    protected $fillable= ['id_docu_jugador','id_jugador','id_perfil', 'tipo','archivo','estatus'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugadores extends Model
{
    use HasFactory;
    protected $table='tbl_jugadores';
    protected $primaryKey = 'id_jugador';
    protected $fillable= ['id_jugador','creacion', 'folio','nombre','edad','fecha_nacimiento','posicion','apodo','sexo','categoria','sede','estatus'];
}

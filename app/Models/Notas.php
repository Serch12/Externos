<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    use HasFactory;
    protected $table='tbl_notas';
    protected $primaryKey = 'id_nota';
    protected $fillable= ['descripcion', 'id_modulo','modulo'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Talentos extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table='tbl_talentos';
    protected $primaryKey = 'id_talento';
    protected $fillable= ['hidder','fecha','year','copa','fase','categoria','descripcion','estatus'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IMGCorreo extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table='tbl_imgcorreos';
    protected $primaryKey = 'id_imgcorreo';
    protected $fillable= ['id_correo','nombre','estatus_img'];
}

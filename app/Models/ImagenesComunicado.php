<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenesComunicado extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
    protected $table='tbl_imagenes_comunicado';
    protected $primaryKey = 'id_imagen';
    protected $fillable= ['id_comunicado','nombre','activo'];


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataImgBanners extends Model
{
    use HasFactory;
    protected $table='tbl_date_imgbanners';
    protected $primaryKey = 'id_imgbanner';
    protected $fillable= ['id_banner','img_banner','estatus'];
}

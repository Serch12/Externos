<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateBanners extends Model
{
    use HasFactory;
    protected $table='tbl_date_banners';
    protected $primaryKey = 'id_banner';
    protected $fillable= ['id_banner','banners', 'prox_torneo','estatus'];
}

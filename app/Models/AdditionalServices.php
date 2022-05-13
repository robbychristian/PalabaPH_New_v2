<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalServices extends Model
{
    use HasFactory;

    protected $fillable = [
        'laundry_id',
        'add_serv_name',
        'add_serv_price',
        'add_serv_image_service'
    ];
}

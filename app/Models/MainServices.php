<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainServices extends Model
{
    use HasFactory;

    protected $fillable = [
        'laundry_id',
        'main_serv_name',
        'main_serv_max_kg',
        'main_serv_price',
    ];
}

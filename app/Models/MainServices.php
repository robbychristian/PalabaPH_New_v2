<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainServices extends Model
{
    use HasFactory;

    protected $fillable = [
        'laundry_id',
        'name',
        'max_kg',
        'price',
    ];
}

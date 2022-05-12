<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'laundry_id',
        'name',
        'price',
        'image_product'
    ];
}

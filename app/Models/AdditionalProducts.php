<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'laundry_id',
        'add_prod_name',
        'add_prod_price',
        'add_prod_image_product'
    ];
}

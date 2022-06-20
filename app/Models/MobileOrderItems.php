<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileOrderItems extends Model
{
    use HasFactory;
    protected $fillable = [
        'mobile_order_id',
        'item_name',
        'item_price',
    ];
}

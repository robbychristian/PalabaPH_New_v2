<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileOrdersInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'mobile_order_id',
        'payment_status',
        'payment_image_uri'
    ];
}

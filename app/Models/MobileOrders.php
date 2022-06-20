<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileOrders extends Model
{
    use HasFactory;
    protected $fillable = [
        'laundry_id',
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'total_price',
        'mode_of_payment',
        'commodity_type',
        'segregation_type',
        'status',
    ];
}

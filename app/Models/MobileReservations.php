<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileReservations extends Model
{
    use HasFactory;
    protected $fillable = [
        'laundry_id',
        'user_id',
        'machine_id',
        'reservation_date',
        'time_start',
        'time_end',
        'status',
    ];
}

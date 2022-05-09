<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $fillable = [
        'laundry_id',
        'self_service',
        'full_service',
        'pick_up',
        'reservations',
        'cash',
        'cashless',
        'gcash_qr_code',
    ];
}

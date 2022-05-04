<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'laundry_id',
        'street',
        'barangay',
        'city',
        'region',
    ];
}

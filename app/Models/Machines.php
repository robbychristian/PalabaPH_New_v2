<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machines extends Model
{
    use HasFactory;

    protected $fillable = [
        'laundry_id',
        'machine_name',
        'machine_service',
        'max_kg',
        'timer',
        'price',
        'status',
        'is_reserved',
        'maintenance_date'
    ];
}

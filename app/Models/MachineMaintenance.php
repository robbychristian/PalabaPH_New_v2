<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineMaintenance extends Model
{
    use HasFactory;
    protected $fillable = [
        'machine_id',
        'description',
        'maintenance_date'
    ];
}

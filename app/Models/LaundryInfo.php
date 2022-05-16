<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Laundries;

class LaundryInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'laundry_id',
        'description',
        'opening_time',
        'closing_time',
        'laundry_img'
    ];

    public function laundries()
    {
        return $this->belongsTo(Laundries::class, 'id', 'laundry_id');
    }
}

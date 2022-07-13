<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaints extends Model
{
    use HasFactory;
    protected $fillable = [
        'laundry_id',
        'user_id',
        'comment',
        'reply',
        'complaint_image',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $fillable = [
        'laundry_id',
        'user_id',
        'comment',
        'category',
        'status',
        'reply',
        'rating',
    ];
}

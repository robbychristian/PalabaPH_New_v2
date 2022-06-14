<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileUsers extends Model
{
    use HasFactory;
    protected $fillable = [
        'laundry_id',
        'first_name',
        'middle_name',
        'last_name',
        'contact_no',
        'email',
        'pass',
        'is_blocked',
        'user_role',
    ];
}

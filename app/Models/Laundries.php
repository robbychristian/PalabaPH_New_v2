<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Laundries extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
        'name',
        'landline',
        'phone',
        'valid_id',
        'bir_permit',
        'dti_permit',
        'brgy_permit',
        'is_approved',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

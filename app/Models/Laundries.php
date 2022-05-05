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
        'type_of_laundry',
        'landline',
        'phone',
        'valid_id',
        'bir_permit',
        'business_permit',
        'dti_permit',
        'is_approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

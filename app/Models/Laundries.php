<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Laundries extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'landline',
        'address',
        'phone',
        'valid_id',
        'bir_permit',
        'brgy_permit',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

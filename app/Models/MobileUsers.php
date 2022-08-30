<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class MobileUsers extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guard = 'customer';
    protected $primaryKey = 'id';
    protected $hidden = [
        'password'
    ];
    protected $fillable = [
        'id',
        'laundry_id',
        'first_name',
        'middle_name',
        'last_name',
        'contact_no',
        'email',
        'email_verified_at',
        'password',
        'is_blocked',
        'user_role',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }
}

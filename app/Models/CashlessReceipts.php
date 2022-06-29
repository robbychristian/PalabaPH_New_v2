<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashlessReceipts extends Model
{
    use HasFactory;
    protected $fillable = [
        'laundry_id',
        'user_id',
        'gcash_receipt',
        'status',
    ];
}

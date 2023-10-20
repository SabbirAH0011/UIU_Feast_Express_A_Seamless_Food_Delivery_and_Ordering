<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'address',
        'products',
        'delivery_charge',
        'total_price',
        'client',
        'delivery_man',
        'status',
        'payment_method',
        'token',
        'payment_status',
    ];
}

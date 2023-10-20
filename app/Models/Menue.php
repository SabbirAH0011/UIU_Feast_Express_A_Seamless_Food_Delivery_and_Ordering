<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menue extends Model
{
    use HasFactory;
    protected $fillable = [
        'shop_email',
        'name',
        'img',
        'description',
        'start_price',
        'discount',
        'discount_percent',
        'prev_price',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenueSlug extends Model
{
    use HasFactory;
    protected $fillable = [
        'search_tag'
    ];
}

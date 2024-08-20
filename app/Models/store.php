<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class store extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'store_name',
        'description',
        'phone',
        'address',
        'neighborhood',
        'rating'
    ];
}

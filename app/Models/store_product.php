<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class store_product extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'id_product',
        'id_store'
    ];
}

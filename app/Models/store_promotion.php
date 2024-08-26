<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class store_promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'promotion_status',
        'start_date',
        'end_date',
        'id_store',
        'id_promotion'
    ];
}

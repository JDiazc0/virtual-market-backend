<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ordered_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_product',
        'id_order',
        'id_promotion',
        'amount',
        'unit_value',
        'discounted_unit_value',
        'list_price',
        'final_value'
    ];
}

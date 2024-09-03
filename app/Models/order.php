<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_store',
        'instructions',
        'delivery_date',
        'address',
        'rate',
        'product_value',
        'shipping_value',
        'discount_value',
        'taxes_value',
        'final_value',
        'id_status'
    ];

    public function orderedItems(): HasMany
    {
        return $this->hasMany(ordered_item::class, 'id_order');
    }
}

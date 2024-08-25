<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'promotion_name',
        'percentage',
        'id_product'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_promotions', 'id_promotion', 'id_store')
            ->withPivot('promotion_status', 'start_date', 'end_date')
            ->withTimestamps();
    }
}

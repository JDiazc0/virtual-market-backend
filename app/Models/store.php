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

    public function products()
    {
        return $this->belongsToMany(Product::class, 'store_products', 'id_store', 'id_product')
            ->withPivot('amount')
            ->withTimestamps();
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'store_promotions', 'id_store', 'id_promotion')
            ->withPivot('promotion_status', 'start_date', 'end_date')
            ->withTimestamps();
    }
}

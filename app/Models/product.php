<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $fill = [
        'barcode',
        'product_name',
        'description',
        'presentation',
        'size',
        'weight'
    ];

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'store_products', 'id_product', 'id_store')
            ->withPivot('amount')
            ->withTimestamps();
    }
}

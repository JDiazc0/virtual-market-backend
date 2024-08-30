<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shopping_cart extends Model
{
    use HasFactory;

    protected $fill = [
        'id_user',
        'id_store',
        'id_product',
        'amount'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'id_store');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}

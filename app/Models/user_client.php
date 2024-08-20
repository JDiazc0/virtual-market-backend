<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_client extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'phone',
        'username',
        'gender',
        'birthday'
    ];
}

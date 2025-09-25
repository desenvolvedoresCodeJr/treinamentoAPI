<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BressanProduct extends Model
{
    protected $table = 'bressan_products';

    protected $fillable = [
        'name',
        'price',
        'image',
        'type',
        'is_highlighted',
    ];
}

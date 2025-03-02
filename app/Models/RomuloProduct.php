<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RomuloProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'image',
        'price'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalduttiCategory extends Model
{
    use HasFactory;

    protected $table = 'baldutti_categories';

    protected $fillable = [
        'title',
        'description',
        'price',
        'type',
        'image',
        'isFeatured',
    ];
}

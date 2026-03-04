<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalduttiProduct extends Model
{
    use HasFactory;

    protected $table = 'baldutti_products';

    protected $fillable = [
        'title',
        'description',
        'price',
        'type',
        'image',
        'isFeatured',
    ];
}

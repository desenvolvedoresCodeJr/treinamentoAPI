<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BayletPublication extends Model
{
    protected $table = 'bt_publications';

    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'created_by',
        'status',
    ];
}

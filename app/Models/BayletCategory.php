<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BayletCategory extends Model
{
    use HasFactory;

    protected $table = 'bt_categories';

    protected $fillable = [
        'name',
    ];
}

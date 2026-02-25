<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BayletUser extends Model
{
    use HasFactory;

    protected $table = 'bt_users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];
}

<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DelioUser extends Model
{
    use HasFactory, Authenticatable;

    protected $table = 'delio_users';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function ratings(): HasMany
    {
        return $this->hasMany(DelioRating::class, 'usuario_id');
    }
}

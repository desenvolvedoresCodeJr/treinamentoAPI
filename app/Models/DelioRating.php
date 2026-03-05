<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DelioRating extends Model
{
    use HasFactory;

    protected $table = 'delio_ratings';

    protected $fillable = [
        'usuario_id',
        'album_id',
        'nota',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(DelioUser::class, 'usuario_id');
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(DelioAlbum::class, 'album_id');
    }
}

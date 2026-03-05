<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DelioAlbum extends Model
{
    use HasFactory;

    protected $table = 'delio_albums';

    protected $fillable = [
        'titulo',
        'imagem',
        'artista',
        'genero',
        'duracao_em_segundos',
        'nota',
        'is_in_carrossel',
    ];

    public function tracks(): HasMany
    {
        return $this->hasMany(DelioTrack::class, 'album_id');
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(DelioRating::class, 'album_id');
    }
}

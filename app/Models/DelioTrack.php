<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DelioTrack extends Model
{
    use HasFactory;

    protected $table = 'delio_tracks';

    protected $fillable = [
        'album_id',
        'titulo',
        'duracao_em_segundos',
        'letra',
    ];

    public function album(): BelongsTo
    {
        return $this->belongsTo(DelioAlbum::class, 'album_id');
    }
}

<?php

namespace Database\Seeders;

use App\Models\DelioAlbum;
use Illuminate\Database\Seeder;

class DelioAlbumSeeder extends Seeder
{
    public function run(): void
    {
        $albuns = [
            [
                'titulo' => 'Thriller',
                'artista' => 'Michael Jackson',
                'genero' => 'Pop',
                'duracao_em_segundos' => 2580,
                'nota' => 4.9,
                'is_in_carrossel' => true,
            ],
            [
                'titulo' => 'Back in Black',
                'artista' => 'AC/DC',
                'genero' => 'Rock',
                'duracao_em_segundos' => 2530,
                'nota' => 4.8,
                'is_in_carrossel' => true,
            ],
            [
                'titulo' => 'The Dark Side of the Moon',
                'artista' => 'Pink Floyd',
                'genero' => 'Progressive Rock',
                'duracao_em_segundos' => 2585,
                'nota' => 4.9,
                'is_in_carrossel' => true,
            ],
            [
                'titulo' => 'Abbey Road',
                'artista' => 'The Beatles',
                'genero' => 'Rock',
                'duracao_em_segundos' => 2830,
                'nota' => 4.8,
                'is_in_carrossel' => false,
            ],
            [
                'titulo' => 'Rumours',
                'artista' => 'Fleetwood Mac',
                'genero' => 'Soft Rock',
                'duracao_em_segundos' => 2340,
                'nota' => 4.7,
                'is_in_carrossel' => false,
            ],
            [
                'titulo' => '21',
                'artista' => 'Adele',
                'genero' => 'Pop',
                'duracao_em_segundos' => 2890,
                'nota' => 4.7,
                'is_in_carrossel' => true,
            ],
            [
                'titulo' => 'Nevermind',
                'artista' => 'Nirvana',
                'genero' => 'Grunge',
                'duracao_em_segundos' => 2955,
                'nota' => 4.8,
                'is_in_carrossel' => false,
            ],
            [
                'titulo' => 'Born to Die',
                'artista' => 'Lana Del Rey',
                'genero' => 'Alternative Pop',
                'duracao_em_segundos' => 2940,
                'nota' => 4.6,
                'is_in_carrossel' => false,
            ],
        ];

        foreach ($albuns as $album) {
            DelioAlbum::query()->updateOrCreate(
                ['titulo' => $album['titulo'], 'artista' => $album['artista']],
                [
                    'imagem' => sprintf(
                        'https://dummyimage.com/600x600/111827/f9fafb.png&text=%s',
                        urlencode($album['titulo'])
                    ),
                    'genero' => $album['genero'],
                    'duracao_em_segundos' => $album['duracao_em_segundos'],
                    'nota' => $album['nota'],
                    'is_in_carrossel' => $album['is_in_carrossel'],
                ]
            );
        }
    }
}

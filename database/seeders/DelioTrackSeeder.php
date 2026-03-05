<?php

namespace Database\Seeders;

use App\Models\DelioAlbum;
use App\Models\DelioTrack;
use Illuminate\Database\Seeder;

class DelioTrackSeeder extends Seeder
{
    public function run(): void
    {
        $catalogo = [
            'Thriller' => [
                ['titulo' => 'Wanna Be Startin\' Somethin\'', 'duracao_em_segundos' => 362],
                ['titulo' => 'Beat It', 'duracao_em_segundos' => 258],
                ['titulo' => 'Billie Jean', 'duracao_em_segundos' => 294],
            ],
            'Back in Black' => [
                ['titulo' => 'Hells Bells', 'duracao_em_segundos' => 312],
                ['titulo' => 'Shoot to Thrill', 'duracao_em_segundos' => 317],
                ['titulo' => 'Back in Black', 'duracao_em_segundos' => 255],
            ],
            'The Dark Side of the Moon' => [
                ['titulo' => 'Time', 'duracao_em_segundos' => 413],
                ['titulo' => 'Money', 'duracao_em_segundos' => 382],
                ['titulo' => 'Us and Them', 'duracao_em_segundos' => 462],
            ],
            'Abbey Road' => [
                ['titulo' => 'Come Together', 'duracao_em_segundos' => 259],
                ['titulo' => 'Something', 'duracao_em_segundos' => 182],
                ['titulo' => 'Here Comes the Sun', 'duracao_em_segundos' => 185],
            ],
            'Rumours' => [
                ['titulo' => 'Dreams', 'duracao_em_segundos' => 257],
                ['titulo' => 'Go Your Own Way', 'duracao_em_segundos' => 218],
                ['titulo' => 'The Chain', 'duracao_em_segundos' => 268],
            ],
            '21' => [
                ['titulo' => 'Rolling in the Deep', 'duracao_em_segundos' => 228],
                ['titulo' => 'Someone Like You', 'duracao_em_segundos' => 285],
                ['titulo' => 'Set Fire to the Rain', 'duracao_em_segundos' => 242],
            ],
            'Nevermind' => [
                ['titulo' => 'Smells Like Teen Spirit', 'duracao_em_segundos' => 301],
                ['titulo' => 'Come as You Are', 'duracao_em_segundos' => 218],
                ['titulo' => 'Lithium', 'duracao_em_segundos' => 257],
            ],
            'Born to Die' => [
                ['titulo' => 'Born to Die', 'duracao_em_segundos' => 286],
                ['titulo' => 'Blue Jeans', 'duracao_em_segundos' => 209],
                ['titulo' => 'Summertime Sadness', 'duracao_em_segundos' => 264],
            ],
        ];

        foreach ($catalogo as $albumTitulo => $tracks) {
            $album = DelioAlbum::query()->where('titulo', $albumTitulo)->first();

            if (! $album) {
                continue;
            }

            foreach ($tracks as $track) {
                DelioTrack::query()->updateOrCreate(
                    [
                        'album_id' => $album->id,
                        'titulo' => $track['titulo'],
                    ],
                    [
                        'duracao_em_segundos' => $track['duracao_em_segundos'],
                        'letra' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                    ]
                );
            }
        }
    }
}

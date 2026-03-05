<?php

namespace Database\Factories;

use App\Models\DelioAlbum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DelioAlbum>
 */
class DelioAlbumFactory extends Factory
{
    protected $model = DelioAlbum::class;

    public function definition(): array
    {
        $catalogo = [
            ['titulo' => 'Thriller', 'artista' => 'Michael Jackson', 'genero' => 'Pop'],
            ['titulo' => 'Back in Black', 'artista' => 'AC/DC', 'genero' => 'Rock'],
            ['titulo' => 'The Dark Side of the Moon', 'artista' => 'Pink Floyd', 'genero' => 'Progressive Rock'],
            ['titulo' => 'Abbey Road', 'artista' => 'The Beatles', 'genero' => 'Rock'],
            ['titulo' => 'Rumours', 'artista' => 'Fleetwood Mac', 'genero' => 'Soft Rock'],
            ['titulo' => '21', 'artista' => 'Adele', 'genero' => 'Pop'],
            ['titulo' => 'Nevermind', 'artista' => 'Nirvana', 'genero' => 'Grunge'],
            ['titulo' => 'Born to Die', 'artista' => 'Lana Del Rey', 'genero' => 'Alternative Pop'],
        ];

        $album = fake()->randomElement($catalogo);

        return [
            'titulo' => $album['titulo'],
            'imagem' => sprintf(
                'https://dummyimage.com/600x600/1f2937/f9fafb.png&text=%s',
                urlencode($album['titulo'])
            ),
            'artista' => $album['artista'],
            'genero' => $album['genero'],
            'duracao_em_segundos' => fake()->numberBetween(1800, 3600),
            'nota' => fake()->randomFloat(1, 3.8, 5.0),
            'is_in_carrossel' => fake()->boolean(30),
        ];
    }
}

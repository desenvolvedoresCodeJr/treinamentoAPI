<?php

namespace Database\Seeders;

use App\Models\DelioUser;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DelioUserSeeder extends Seeder
{
    public function run(): void
    {
        $usuariosBase = [
            ['name' => 'Lucas Pereira', 'email' => 'lucas.delio@example.com'],
            ['name' => 'Ana Souza', 'email' => 'ana.delio@example.com'],
            ['name' => 'Joao Martins', 'email' => 'joao.delio@example.com'],
            ['name' => 'Camila Ribeiro', 'email' => 'camila.delio@example.com'],
            ['name' => 'Rafael Gomes', 'email' => 'rafael.delio@example.com'],
        ];

        foreach ($usuariosBase as $usuario) {
            DelioUser::query()->updateOrCreate(
                ['email' => $usuario['email']],
                [
                    'name' => $usuario['name'],
                    'password' => Hash::make('password'),
                ]
            );
        }

        DelioUser::factory()->count(10)->create();
    }
}

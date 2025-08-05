<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Evenement;

class EvenementSeeder extends Seeder
{
    public function run(): void
    {
        Evenement::create([
            'titre' => 'Conférence Laravel 2025',
            'description' => 'Une conférence pour les passionnés de Laravel avec des ateliers et des talks techniques.',
            'date' => now()->addDays(10)->format('Y-m-d'),
            'images' => [
                'evenements/laravel_1.jpg',
                'evenements/laravel_2.jpg',
            ],
        ]);

        Evenement::create([
            'titre' => 'Hackathon National',
            'description' => 'Un hackathon de 48h ouvert aux étudiants et professionnels du numérique.',
            'date' => now()->addWeeks(3)->format('Y-m-d'),
            'images' => [
                'evenements/hackathon_1.jpg',
            ],
        ]);

        Evenement::create([
            'titre' => 'Séminaire Leadership Tech',
            'description' => 'Un événement pour explorer le leadership dans le monde des nouvelles technologies.',
            'date' => now()->addMonth()->format('Y-m-d'),
            'images' => [],
        ]);
    }
}
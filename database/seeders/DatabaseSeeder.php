<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            LevelSeeder::class,
            MateriSeeder::class,
            QuizSeeder::class,
            BadgeSeeder::class,
            KinestheticMateriSeeder::class,
            VisualMateriSeeder::class,
            AuditoryMateriSeeder::class
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Level;

class LevelSeeder extends Seeder
{
    public function run(): void
    {
        $levels = [
            [
                'name' => 'Pengenalan Struktur Data',
                'order' => 1,
                'description' => 'Mempelajari konsep dasar struktur data dan implementasinya dalam pemrograman.'
            ],
            [
                'name' => 'Array dan List',
                'order' => 2,
                'description' => 'Mempelajari struktur data array dan list, serta operasi-operasi dasarnya.'
            ],
            [
                'name' => 'Stack dan Queue',
                'order' => 3,
                'description' => 'Mempelajari struktur data stack dan queue, serta implementasinya dalam berbagai kasus.'
            ],
            [
                'name' => 'Linked List',
                'order' => 4,
                'description' => 'Mempelajari struktur data linked list dan berbagai jenisnya.'
            ],
            [
                'name' => 'Tree dan Graph',
                'order' => 5,
                'description' => 'Mempelajari struktur data tree dan graph, serta algoritma-algoritma terkait.'
            ]
        ];

        foreach ($levels as $level) {
            Level::create($level);
        }
    }
}
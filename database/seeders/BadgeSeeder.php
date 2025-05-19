<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    public function run(): void
    {
        $badges = [
            // Berdasarkan Level
            [
                'name' => 'Data Explorer',
                'description' => 'Berhasil menyelesaikan level Pengenalan Struktur Data',
                'icon' => 'beginner.png',
                'xp_required' => null,
                'level_required' => 1
            ],
            [
                'name' => 'Array Adept',
                'description' => 'Berhasil menyelesaikan materi Array dan List',
                'icon' => 'knowledge-seeker.png',
                'xp_required' => null,
                'level_required' => 2
            ],
            [
                'name' => 'Flow Master',
                'description' => 'Berhasil menyelesaikan materi Stack dan Queue',
                'icon' => 'quiz-master.png',
                'xp_required' => null,
                'level_required' => 3
            ],
            [
                'name' => 'Chain Commander',
                'description' => 'Berhasil menyelesaikan materi Linked List',
                'icon' => 'champion.png',
                'xp_required' => null,
                'level_required' => 4
            ],
            [
                'name' => 'Structure Sage',
                'description' => 'Berhasil menyelesaikan materi Tree dan Graph',
                'icon' => 'structure-sage.png',
                'xp_required' => null,
                'level_required' => 5
            ],

            // Berdasarkan XP
            [
                'name' => 'Bronze Seeker',
                'description' => 'Mencapai 100 XP',
                'icon' => 'bronze.png',
                'xp_required' => 100,
                'level_required' => null
            ],
            [
                'name' => 'Silver Striver',
                'description' => 'Mencapai 250 XP',
                'icon' => 'silver.png',
                'xp_required' => 250,
                'level_required' => null
            ],
            [
                'name' => 'Golden Achiever',
                'description' => 'Mencapai 500 XP',
                'icon' => 'gold.png',
                'xp_required' => 500,
                'level_required' => null
            ],
            [
                'name' => 'Structopia Master',
                'description' => 'Menyelesaikan semua level',
                'icon' => 'master-glow.png',
                'xp_required' => null,
                'level_required' => 5
            ]
        ];


        foreach ($badges as $badge) {
            Badge::create($badge);
        }
    }
}
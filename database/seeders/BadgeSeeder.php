<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    public function run(): void
    {
        $badges = [
            [
                'name' => 'Pemula',
                'description' => 'Berhasil menyelesaikan level pertama',
                'icon' => 'beginner.png'
            ],
            [
                'name' => 'Pencari Ilmu',
                'description' => 'Menyelesaikan 5 materi dalam satu hari',
                'icon' => 'knowledge-seeker.png'
            ],
            [
                'name' => 'Ahli Quiz',
                'description' => 'Mendapatkan nilai sempurna dalam 3 quiz',
                'icon' => 'quiz-master.png'
            ],
            [
                'name' => 'Juara',
                'description' => 'Mendapatkan XP tertinggi dalam seminggu',
                'icon' => 'champion.png'
            ],
            [
                'name' => 'Penyelesaian',
                'description' => 'Menyelesaikan semua level',
                'icon' => 'completion.png'
            ]
        ];

        foreach ($badges as $badge) {
            Badge::create($badge);
        }
    }
}
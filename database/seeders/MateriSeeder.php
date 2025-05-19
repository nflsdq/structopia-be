<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;

class MateriSeeder extends Seeder
{
    public function run(): void
    {
        $materis = [
            [
                'level_id' => 1,
                'title' => 'Apa itu Struktur Data?',
                'type' => 'visual',
                'content' => 'Struktur data adalah cara menyimpan dan mengorganisir data agar dapat diakses dan dimodifikasi secara efisien. Dalam pemrograman, struktur data yang tepat sangat penting untuk mengoptimalkan performa aplikasi.',
                'media_url' => 'https://example.com/struktur-data-intro.jpg',
                'xp_value' => 15
            ],
            [
                'level_id' => 1,
                'title' => 'Jenis-jenis Struktur Data',
                'type' => 'visual',
                'content' => 'Struktur data dapat dikategorikan menjadi dua jenis utama: struktur data linear (array, linked list, stack, queue) dan struktur data non-linear (tree, graph).',
                'media_url' => 'https://example.com/jenis-struktur-data.jpg',
                'xp_value' => 15
            ],
            [
                'level_id' => 1,
                'title' => 'Kompleksitas Waktu',
                'type' => 'auditory',
                'content' => 'Kompleksitas waktu adalah ukuran seberapa efisien sebuah algoritma dalam hal waktu eksekusi. Notasi Big O digunakan untuk menggambarkan kompleksitas waktu.',
                'media_url' => 'https://example.com/kompleksitas-waktu.mp3',
                'xp_value' => 15
            ]
        ];

        foreach ($materis as $materi) {
            Materi::create($materi);
        }
    }
}
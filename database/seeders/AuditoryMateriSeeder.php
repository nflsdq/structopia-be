<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;
use App\Models\Level;

class AuditoryMateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $auditoryMaterials = [
            [
                'level_id' => 1,
                'title' => 'Podcast: Apa itu Struktur Data dan Mengapa Penting?',
                'type' => 'auditory',
                'content' => 'Penjelasan audio mengenai konsep dasar struktur data, jenis-jenisnya secara umum, dan relevansinya dalam pemrograman, disampaikan dengan gaya narasi yang menarik. Tujuan: Memahami konsep dasar struktur data dan kegunaannya melalui penjelasan lisan.',
                'media_url' => '/seed_assets/auditory/level1_podcast_intro_thumbnail.png', // Placeholder untuk thumbnail audio jika ada
                'xp_value' => 15,
                'meta' => [
                    'description' => 'Podcast pengantar tentang definisi, jenis, dan pentingnya struktur data.',
                    'objective' => 'Memahami konsep dasar struktur data dan kegunaannya melalui penjelasan lisan.',
                    'media_data' => [
                        'type' => 'audio_player',
                        'audio_url' => '/seed_assets/auditory/level1_podcast_intro.mp3',
                        'transcript_available' => true,
                        'transcript_url' => '/seed_assets/auditory/level1_podcast_intro_transcript.txt', // Opsional
                        'duration_seconds' => 300,
                        'key_points' => [
                            'Definisi struktur data',
                            'Jenis-jenis umum struktur data (Array, List, Stack, Queue, Tree, Graph)',
                            'Pentingnya efisiensi dalam penyimpanan dan akses data'
                        ]
                    ]
                ]
            ],
            [
                'level_id' => 2,
                'title' => 'Diskusi Audio: Kapan Menggunakan Array vs Linked List?',
                'type' => 'auditory',
                'content' => 'Dialog atau monolog audio yang membahas skenario penggunaan ideal untuk Array dan Linked List, menjelaskan kelebihan dan kekurangan masing-masing dalam konteks praktis. Tujuan: Memahami implikasi praktis penggunaan Array dan Linked List melalui pembahasan lisan.',
                'media_url' => null,
                'xp_value' => 15,
                'meta' => [
                    'description' => 'Diskusi audio mengenai pertimbangan praktis dalam memilih antara Array dan Linked List.',
                    'objective' => 'Memahami implikasi praktis penggunaan Array dan Linked List melalui pembahasan lisan.',
                    'media_data' => [
                        'type' => 'audio_player',
                        'audio_url' => '/seed_assets/auditory/level2_arrayvslist_discussion.mp3',
                        'duration_seconds' => 240,
                        'key_takeaways' => [
                            'Array: Akses elemen cepat (O(1)), ukuran tetap setelah deklarasi, insersi/delesi lambat.',
                            'Linked List: Insersi/delesi efisien (O(1) jika node diketahui), ukuran dinamis, akses elemen lambat (O(n)).',
                            'Skenario penggunaan Array: Data yang jarang berubah ukuran, sering diakses.',
                            'Skenario penggunaan Linked List: Data yang sering bertambah/berkurang, tidak memerlukan akses acak cepat.'
                        ]
                    ]
                ]
            ],
            [
                'level_id' => 3,
                'title' => 'Penjelasan Audio: Analogi Stack (Tumpukan Piring) dan Queue (Antrian Tiket)',
                'type' => 'auditory',
                'content' => 'Penjelasan audio yang menggunakan analogi sehari-hari (tumpukan piring untuk Stack, antrian tiket untuk Queue) untuk mempermudah pemahaman konsep LIFO dan FIFO. Tujuan: Memahami prinsip LIFO dan FIFO melalui analogi auditori.',
                'media_url' => null,
                'xp_value' => 15,
                'meta' => [
                    'description' => 'Penjelasan konsep Stack dan Queue menggunakan analogi yang mudah dipahami.',
                    'objective' => 'Memahami prinsip LIFO dan FIFO melalui analogi auditori.',
                    'media_data' => [
                        'type' => 'audio_player',
                        'audio_url' => '/seed_assets/auditory/level3_stackqueue_analogy.mp3',
                        'duration_seconds' => 180,
                        'analogies_explained' => [
                            ['concept' => 'Stack (LIFO)', 'analogy' => 'Tumpukan piring: piring terakhir diletakkan adalah yang pertama diambil.'],
                            ['concept' => 'Queue (FIFO)', 'analogy' => 'Antrian tiket bioskop: orang pertama datang adalah yang pertama dilayani.']
                        ]
                    ]
                ]
            ],
            [
                'level_id' => 4,
                'title' => 'Cerita Audio: Petualangan Pointer dalam Linked List',
                'type' => 'auditory',
                'content' => 'Narasi kreatif yang menceritakan "perjalanan" sebuah pointer saat node ditambahkan, dihapus, atau dicari dalam sebuah Linked List, untuk membantu memvisualisasikan proses secara imajinatif. Tujuan: Membangun pemahaman intuitif tentang bagaimana pointer bekerja dalam Linked List melalui cerita.',
                'media_url' => null,
                'xp_value' => 15,
                'meta' => [
                    'description' => 'Narasi cerita untuk menjelaskan operasi pada Linked List dari perspektif pointer.',
                    'objective' => 'Membangun pemahaman intuitif tentang bagaimana pointer bekerja dalam Linked List melalui cerita.',
                    'media_data' => [
                        'type' => 'audio_player',
                        'audio_url' => '/seed_assets/auditory/level4_pointer_adventure.mp3',
                        'duration_seconds' => 260,
                        'story_elements' => [
                            'Node sebagai \'pulau\' atau \'rumah\' dalam sebuah rantai.',
                            'Pointer sebagai \'jembatan\' atau \'peta jalan\' yang menghubungkan antar pulau.',
                            'Proses insersi dan delesi sebagai pembangunan atau peruntuhan jembatan.'
                        ]
                    ]
                ]
            ],
            [
                'level_id' => 5,
                'title' => 'Wawancara Audio dengan "Pakar": Membedah Algoritma Traversal DFS dan BFS',
                'type' => 'auditory',
                'content' => 'Format wawancara audio simulasi dengan seorang "pakar" yang menjelaskan perbedaan logika, langkah-langkah, dan kasus penggunaan DFS dan BFS pada Tree dan Graph. Tujuan: Memahami perbedaan fundamental antara algoritma traversal DFS dan BFS melalui format diskusi.',
                'media_url' => null,
                'xp_value' => 15,
                'meta' => [
                    'description' => 'Wawancara audio yang menjelaskan perbedaan dan aplikasi dari DFS dan BFS.',
                    'objective' => 'Memahami perbedaan fundamental antara algoritma traversal DFS dan BFS melalui format diskusi.',
                    'media_data' => [
                        'type' => 'audio_player',
                        'audio_url' => '/seed_assets/auditory/level5_dfsbfs_interview.mp3',
                        'duration_seconds' => 320,
                        'interview_questions_covered' => [
                            'Apa perbedaan mendasar antara DFS dan BFS dalam cara menjelajahi node?',
                            'Bagaimana struktur data (Stack untuk DFS, Queue untuk BFS) mendukung cara kerja masing-masing algoritma?',
                            'Berikan contoh kasus di mana DFS lebih cocok digunakan.',
                            'Berikan contoh kasus di mana BFS lebih cocok digunakan.',
                            'Apakah kompleksitas waktu dan ruang untuk DFS dan BFS?',
                            'Bagaimana DFS dan BFS dapat digunakan untuk mendeteksi siklus dalam graf?'
                        ]
                    ]
                ]
            ]
        ];

        foreach ($auditoryMaterials as $material) {
            if (Level::find($material['level_id'])) {
                Materi::create($material);
            } else {
                $this->command->warn("Level dengan ID {$material['level_id']} tidak ditemukan. Materi auditori '{$material['title']}' tidak di-seed.");
            }
        }
    }
}
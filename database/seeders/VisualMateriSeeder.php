<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;
use App\Models\Level;

class VisualMateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $visualMaterials = [
            [
                'level_id' => 1,
                'title' => 'Infografis Klasifikasi Struktur Data',
                'type' => 'visual',
                'content' => 'Infografis yang menampilkan berbagai jenis struktur data dan pengelompokannya (Linear/Non-Linear, Static/Dynamic) dengan diagram dan ikon. Tujuan: Memahami klasifikasi dasar struktur data melalui representasi visual yang jelas.',
                'media_url' => '/seed_assets/visual/level1_infographic_banner.png', // Placeholder untuk gambar banner jika ada
                'xp_value' => 15,
                'meta' => [
                    'description' => 'Visualisasi klasifikasi struktur data menggunakan diagram alir dan ikon representatif.',
                    'objective' => 'Memahami klasifikasi dasar struktur data melalui representasi visual yang jelas.',
                    'presentation_data' => [
                        'type' => 'infographic_viewer',
                        'image_url' => '/seed_assets/visual/level1_infographic_detail.png', // URL ke gambar infografis utama
                        'interactive_elements' => [
                            ['area_coords' => '...', 'tooltip' => 'Stack: Linear, Dynamic'] // Contoh elemen interaktif (opsional)
                        ],
                        'zoom_enabled' => true
                    ]
                ]
            ],
            [
                'level_id' => 2,
                'title' => 'Diagram Perbandingan Array vs Linked List',
                'type' => 'visual',
                'content' => 'Diagram berdampingan yang memvisualisasikan struktur memori array (kontinu) dan linked list (node dengan pointer), menyoroti perbedaan akses, insersi, dan delesi. Tujuan: Memahami perbedaan fundamental antara Array dan Linked List secara visual.',
                'media_url' => null,
                'xp_value' => 15,
                'meta' => [
                    'description' => 'Diagram perbandingan struktur internal dan karakteristik performa Array dan Linked List.',
                    'objective' => 'Memahami perbedaan fundamental antara Array dan Linked List secara visual.',
                    'presentation_data' => [
                        'type' => 'comparative_diagram_viewer',
                        'diagrams' => [
                            ['title' => 'Array', 'image_url' => '/seed_assets/visual/level2_array_diagram.png', 'notes' => 'Elemen disimpan secara kontinu.'],
                            ['title' => 'Linked List', 'image_url' => '/seed_assets/visual/level2_linkedlist_diagram.png', 'notes' => 'Elemen dihubungkan melalui pointer.']
                        ],
                        'comparison_points' => [
                            'Alokasi Memori: Array (Statis/Kontinu), Linked List (Dinamis/Tersebar)',
                            'Akses Elemen: Array (Cepat via Indeks), Linked List (Lambat via Traversal)',
                            'Insersi/Delesi di Tengah: Array (Lambat), Linked List (Cepat jika pointer diketahui)'
                        ]
                    ]
                ]
            ],
            [
                'level_id' => 3,
                'title' => 'Animasi Operasi Stack (LIFO) dan Queue (FIFO)',
                'type' => 'visual',
                'content' => 'Animasi singkat yang menunjukkan bagaimana elemen ditambahkan (Push/Enqueue) dan dikeluarkan (Pop/Dequeue) dari Stack dan Queue, dengan visualisasi tumpukan dan antrian. Tujuan: Memahami prinsip kerja Stack dan Queue melalui demonstrasi animasi.',
                'media_url' => null,
                'xp_value' => 15,
                'meta' => [
                    'description' => 'Animasi yang menggambarkan proses LIFO pada Stack dan FIFO pada Queue.',
                    'objective' => 'Memahami prinsip kerja Stack dan Queue melalui demonstrasi animasi.',
                    'presentation_data' => [
                        'type' => 'animation_player',
                        'animations' => [
                            ['title' => 'Stack (LIFO)', 'animation_url' => '/seed_assets/visual/level3_stack_animation.gif', 'description' => 'Last In, First Out'],
                            ['title' => 'Queue (FIFO)', 'animation_url' => '/seed_assets/visual/level3_queue_animation.gif', 'description' => 'First In, First Out']
                        ],
                        'controls' => ['play', 'pause', 'restart', 'speed_control']
                    ]
                ]
            ],
            [
                'level_id' => 4,
                'title' => 'Visualisasi Langkah-demi-Langkah Modifikasi Linked List',
                'type' => 'visual',
                'content' => 'Serangkaian gambar atau slideshow yang menunjukkan step-by-step pembuatan node, penautan pointer, insersi node baru, dan penghapusan node pada singly linked list. Tujuan: Memahami mekanisme internal Linked List, termasuk peran pointer, secara visual.',
                'media_url' => null,
                'xp_value' => 15,
                'meta' => [
                    'description' => 'Ilustrasi visual proses pembuatan, penambahan, dan penghapusan node dalam sebuah Linked List.',
                    'objective' => 'Memahami mekanisme internal Linked List, termasuk peran pointer, secara visual.',
                    'presentation_data' => [
                        'type' => 'step_by_step_slideshow',
                        'steps' => [
                            ['image_url' => '/seed_assets/visual/level4_linkedlist_step1_create.png', 'caption' => '1. Membuat Node Baru (data: 10, next: null)'],
                            ['image_url' => '/seed_assets/visual/level4_linkedlist_step2_link.png', 'caption' => '2. Menambahkan Node Kedua (data: 20) dan Menautkannya'],
                            ['image_url' => '/seed_assets/visual/level4_linkedlist_step3_insert.png', 'caption' => '3. Menyisipkan Node (data: 15) di Antara Node 10 dan 20'],
                            ['image_url' => '/seed_assets/visual/level4_linkedlist_step4_delete.png', 'caption' => '4. Menghapus Node (data: 15) dan Memperbarui Pointer']
                        ]
                    ]
                ]
            ],
            [
                'level_id' => 5,
                'title' => 'Diagram Tree & Graph dengan Contoh Traversal (DFS & BFS)',
                'type' => 'visual',
                'content' => 'Diagram yang jelas menunjukkan struktur Tree (Binary Tree, BST) dan Graph (Directed, Undirected), dilengkapi dengan contoh jalur traversal (DFS dan BFS) yang di-highlight. Tujuan: Mengenali struktur visual Tree dan Graph serta memahami perbedaan pola traversal DFS dan BFS.',
                'media_url' => null,
                'xp_value' => 15,
                'meta' => [
                    'description' => 'Diagram struktur Tree dan Graph, beserta contoh visualisasi jalur traversal DFS dan BFS.',
                    'objective' => 'Mengenali struktur visual Tree dan Graph serta memahami perbedaan pola traversal DFS dan BFS.',
                    'presentation_data' => [
                        'type' => 'graph_tree_diagram_viewer',
                        'elements' => [
                            [
                                'title' => 'Binary Tree Traversal (DFS: Pre-order, In-order, Post-order; BFS)',
                                'image_url' => '/seed_assets/visual/level5_tree_traversal_diagram.png',
                                'description' => 'Contoh Binary Tree menunjukkan jalur untuk DFS (Pre: A-B-D-E-C-F, In: D-B-E-A-F-C, Post: D-E-B-F-C-A) dan BFS (A-B-C-D-E-F).'
                            ],
                            [
                                'title' => 'Graph Traversal (DFS & BFS)',
                                'image_url' => '/seed_assets/visual/level5_graph_traversal_diagram.png',
                                'description' => 'Contoh Graph tidak berarah menunjukkan jalur DFS (misal: A-B-D-E-C-F) dan BFS (misal: A-B-C-D-E-F) dimulai dari node A.'
                            ]
                        ]
                    ]
                ]
            ]
        ];

        foreach ($visualMaterials as $material) {
            if (Level::find($material['level_id'])) {
                Materi::create($material);
            } else {
                $this->command->warn("Level dengan ID {$material['level_id']} tidak ditemukan. Materi visual '{$material['title']}' tidak di-seed.");
            }
        }
    }
}
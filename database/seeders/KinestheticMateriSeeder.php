<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;
use App\Models\Level; // Pastikan model Level di-import jika ingin melakukan pengecekan

class KinestheticMateriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kinestheticMaterials = [
            [
                'level_id' => 1, // Pastikan ID level ini ada di tabel levels
                'title' => 'Pengenalan Struktur Data: Klasifikasi Interaktif',
                'type' => 'kinesthetic',
                'content' => 'Siswa melakukan drag and drop berbagai jenis struktur data (Stack, Tree, Queue, Graph, dll) ke dalam kategori yang benar: Linear / Non-Linear dan Static / Dynamic. Tujuan: Memahami klasifikasi dasar struktur data melalui aktivitas pengelompokan.',
                'media_url' => null,
                'xp_value' => 15,
                'meta' => [
                    'description' => 'Siswa melakukan drag and drop berbagai jenis struktur data (Stack, Tree, Queue, Graph, dll) ke dalam kategori yang benar:
→ Linear / Non-Linear
→ Static / Dynamic',
                    'objective' => 'Memahami klasifikasi dasar struktur data melalui aktivitas pengelompokan.',
                    'activity_data' => [
                        'type' => 'classification_drag_and_drop',
                        'items_to_classify' => [
                            ['id' => 'stack', 'name' => 'Stack'],
                            ['id' => 'tree', 'name' => 'Tree'],
                            ['id' => 'queue', 'name' => 'Queue'],
                            ['id' => 'graph', 'name' => 'Graph'],
                            ['id' => 'array_static', 'name' => 'Array (Ukuran Tetap)'],
                            ['id' => 'linked_list', 'name' => 'Linked List']
                        ],
                        'categories' => [
                            [
                                'group_id' => 'linearity',
                                'group_name' => 'Linearitas',
                                'options' => [
                                    ['id' => 'linear', 'name' => 'Linear'],
                                    ['id' => 'non_linear', 'name' => 'Non-Linear']
                                ]
                            ],
                            [
                                'group_id' => 'mutability',
                                'group_name' => 'Sifat Memori',
                                'options' => [
                                    ['id' => 'static', 'name' => 'Static'],
                                    ['id' => 'dynamic', 'name' => 'Dynamic']
                                ]
                            ]
                        ],
                        'correct_mappings' => [
                            'stack' => ['linearity' => 'linear', 'mutability' => 'dynamic'],
                            'tree' => ['linearity' => 'non_linear', 'mutability' => 'dynamic'],
                            'queue' => ['linearity' => 'linear', 'mutability' => 'dynamic'],
                            'graph' => ['linearity' => 'non_linear', 'mutability' => 'dynamic'],
                            'array_static' => ['linearity' => 'linear', 'mutability' => 'static'],
                            'linked_list' => ['linearity' => 'linear', 'mutability' => 'dynamic']
                        ],
                        'instructions_detail' => 'Seret dan lepas setiap jenis struktur data ke dalam kategori yang benar berdasarkan linearitas (Linear / Non-Linear) dan sifat memori (Static / Dynamic).'
                    ]
                ]
            ],
            [
                'level_id' => 2, // Pastikan ID level ini ada di tabel levels
                'title' => 'Array dan List: Simulasi Insert dan Delete pada Array',
                'type' => 'kinesthetic',
                'content' => 'Siswa menyisipkan atau menghapus elemen pada array dan melihat pergeseran elemen secara animasi. Tujuan: Memahami bagaimana array bersifat statis dan perubahan satu elemen berdampak pada elemen lainnya.',
                'media_url' => null,
                'xp_value' => 15,
                'meta' => [
                    'description' => 'Siswa menyisipkan atau menghapus elemen pada array dan melihat pergeseran elemen secara animasi.',
                    'objective' => 'Memahami bagaimana array bersifat statis dan perubahan satu elemen berdampak pada elemen lainnya.',
                    'activity_data' => [
                        'type' => 'array_insertion_deletion_simulation',
                        'initial_array_elements' => [10, 20, 30, 40, null],
                        'array_capacity' => 5,
                        'instructions_detail' => 'Gunakan tombol untuk menyisipkan elemen baru ke dalam array atau menghapus elemen yang ada. Perhatikan bagaimana elemen-elemen lain bergeser dan bagaimana kapasitas array mempengaruhi operasi.'
                    ]
                ]
            ],
            [
                'level_id' => 3, // Pastikan ID level ini ada di tabel levels
                'title' => 'Stack dan Queue: Simulasi Push/Pop dan Enqueue/Dequeue',
                'type' => 'kinesthetic',
                'content' => 'Klik tombol "Push" untuk menambahkan elemen ke Stack (LIFO), dan "Pop" untuk mengeluarkannya. Demikian juga "Enqueue" dan "Dequeue" untuk Queue (FIFO). Tujuan: Memahami urutan kerja Stack dan Queue melalui tindakan langsung.',
                'media_url' => null,
                'xp_value' => 15,
                'meta' => [
                    'description' => 'Klik tombol "Push" untuk menambahkan elemen ke Stack (LIFO), dan "Pop" untuk mengeluarkannya.
Demikian juga "Enqueue" dan "Dequeue" untuk Queue (FIFO).',
                    'objective' => 'Memahami urutan kerja Stack dan Queue melalui tindakan langsung.',
                    'activity_data' => [
                        'type' => 'stack_queue_operations_simulation',
                        'max_elements' => 5,
                        'instructions_detail' => [
                            'stack' => 'Klik \'Push\' untuk menambah elemen ke Stack (LIFO), dan \'Pop\' untuk mengeluarkannya. Elemen baru akan ditambahkan di atas, dan elemen teratas yang akan dikeluarkan.',
                            'queue' => 'Klik \'Enqueue\' untuk menambah elemen ke Queue (FIFO), dan \'Dequeue\' untuk mengeluarkannya. Elemen baru ditambahkan di belakang, dan elemen terdepan yang akan dikeluarkan.'
                        ]
                    ]
                ]
            ],
            [
                'level_id' => 4, // Pastikan ID level ini ada di tabel levels
                'title' => 'Linked List: Bangun Linked List Sendiri (Tambah dan Hapus Node)',
                'type' => 'kinesthetic',
                'content' => 'Siswa membuat node, menghubungkannya secara manual (drag pointer), lalu menghapus salah satu dan mengatur ulang pointer. Tujuan: Memahami bagaimana setiap node saling terhubung dan pentingnya pointer.',
                'media_url' => null,
                'xp_value' => 15,
                'meta' => [
                    'description' => 'Siswa membuat node, menghubungkannya secara manual (drag pointer), lalu menghapus salah satu dan mengatur ulang pointer.',
                    'objective' => 'Memahami bagaimana setiap node saling terhubung dan pentingnya pointer.',
                    'activity_data' => [
                        'type' => 'linked_list_construction_simulation',
                        'max_nodes' => 7,
                        'available_operations' => ['create_node', 'delete_node', 'link_node_to_next', 'set_head'],
                        'instructions_detail' => 'Buat node-node baru. Hubungkan node satu sama lain dengan menyeret pointer dari satu node ke node berikutnya. Coba juga untuk menghapus node dan perhatikan bagaimana Anda harus mengatur ulang pointer untuk menjaga integritas list.'
                    ]
                ]
            ],
            [
                'level_id' => 5, // Pastikan ID level ini ada di tabel levels
                'title' => 'Tree dan Graph: DFS vs BFS Simulator',
                'type' => 'kinesthetic',
                'content' => 'Siswa melakukan traversal dengan klik node satu per satu, memilih apakah pakai DFS atau BFS, lalu melihat jalur traversal dan urutannya. Tujuan: Memahami perbedaan traversal dan penerapan logika tree/graph traversal secara langsung.',
                'media_url' => null,
                'xp_value' => 15,
                'meta' => [
                    'description' => 'Siswa melakukan traversal dengan klik node satu per satu, memilih apakah pakai DFS atau BFS, lalu melihat jalur traversal dan urutannya.',
                    'objective' => 'Memahami perbedaan traversal dan penerapan logika tree/graph traversal secara langsung.',
                    'activity_data' => [
                        'type' => 'graph_traversal_simulation',
                        'default_graph' => [
                            'nodes' => [
                                ['id' => 'A', 'label' => 'A'],
                                ['id' => 'B', 'label' => 'B'],
                                ['id' => 'C', 'label' => 'C'],
                                ['id' => 'D', 'label' => 'D'],
                                ['id' => 'E', 'label' => 'E'],
                                ['id' => 'F', 'label' => 'F']
                            ],
                            'edges' => [
                                ['from' => 'A', 'to' => 'B'],
                                ['from' => 'A', 'to' => 'C'],
                                ['from' => 'B', 'to' => 'D'],
                                ['from' => 'B', 'to' => 'E'],
                                ['from' => 'C', 'to' => 'F'],
                            ],
                            'is_directed' => false
                        ],
                        'traversal_methods' => [
                            ['id' => 'dfs', 'name' => 'Depth-First Search (DFS)'],
                            ['id' => 'bfs', 'name' => 'Breadth-First Search (BFS)']
                        ],
                        'instructions_detail' => 'Pilih node awal pada graf. Kemudian, pilih metode traversal (DFS atau BFS). Klik pada node secara berurutan sesuai dengan logika traversal yang dipilih untuk melihat jalur dan urutan kunjungan node.'
                    ]
                ]
            ]
        ];

        foreach ($kinestheticMaterials as $material) {
            // Opsional: Periksa apakah level ada sebelum membuat materi
            if (Level::find($material['level_id'])) {
                Materi::create($material);
            } else {
                $this->command->warn("Level dengan ID {$material['level_id']} tidak ditemukan. Materi '{$material['title']}' tidak di-seed.");
            }
        }
    }
}
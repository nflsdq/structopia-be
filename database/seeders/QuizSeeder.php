<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $quizzes = [
            [
                'level_id' => 1,
                'question' => "Struktur data digunakan untuk...",
                'choices' => [
                    'A' => "Mencetak dokumen",
                    'B' => "Menyimpan dan mengatur data",
                    'C' => "Menghapus virus",
                    'D' => "Menyalakan komputer"
                ],
                'correct_answer' => "B"
            ],
            [
                'level_id' => 1,
                'question' => "Manakah dari struktur data berikut yang termasuk struktur data non-linear?",
                'choices' => [
                    'A' => "Stack",
                    'B' => "Queue",
                    'C' => "Tree",
                    'D' => "Array"
                ],
                'correct_answer' => "C"
            ],
            [
                'level_id' => 1,
                'question' => "Array berbeda dari list karena...",
                'choices' => [
                    'A' => "Bersifat dinamis",
                    'B' => "Ukurannya tetap",
                    'C' => "Tidak memiliki indeks",
                    'D' => "Lebih lambat"
                ],
                'correct_answer' => "B"
            ],
            [
                'level_id' => 1,
                'question' => "Pointer dalam linked list digunakan untuk...",
                'choices' => [
                    'A' => "Menambah elemen",
                    'B' => "Menghapus data",
                    'C' => "Menyimpan alamat node berikutnya",
                    'D' => "Mencetak data"
                ],
                'correct_answer' => "C"
            ],
            [
                'level_id' => 1,
                'question' => "Seorang siswa membuat antrian dengan urutan sebagai berikut:\nAntrian awal: [A, B, C, D]\nSetelah itu, siswa melakukan operasi berikut:\n1. Keluarkan satu elemen dari antrian\n2. Tambahkan 'E' ke antrian\n3. Keluarkan dua elemen dari antrian\nBagaimana isi antrian setelah operasi selesai?",
                'choices' => [
                    'A' => "[C, D, E]",
                    'B' => "[D, E]",
                    'C' => "[B, C, E]",
                    'D' => "[E]"
                ],
                'correct_answer' => "B"
            ],
            [
                'level_id' => 1,
                'question' => "Seorang siswa ingin sering menambahkan dan menghapus data di awal dan tengah. Struktur data yang tepat adalah:",
                'choices' => [
                    'A' => "Array",
                    'B' => "Tree",
                    'C' => "Linked List",
                    'D' => "Queue"
                ],
                'correct_answer' => "C"
            ],
            [
                'level_id' => 2,
                'question' => "Indeks pertama array dimulai dari...",
                'choices' => [
                    'A' => "0",
                    'B' => "1",
                    'C' => "-1",
                    'D' => "2"
                ],
                'correct_answer' => "A"
            ],
            [
                'level_id' => 2,
                'question' => "List berbeda dari array karena...",
                'choices' => [
                    'A' => "Bersifat statis",
                    'B' => "Bersifat dinamis",
                    'C' => "Lebih cepat",
                    'D' => "Tidak dapat diubah"
                ],
                'correct_answer' => "B"
            ],
            [
                'level_id' => 2,
                'question' => "Urutan ascending dari [7, 2, 9] adalah...",
                'choices' => [
                    'A' => "[9, 7, 2]",
                    'B' => "[2, 7, 9]",
                    'C' => "[7, 2, 9]",
                    'D' => "[2, 9, 7]"
                ],
                'correct_answer' => "B"
            ],
            [
                'level_id' => 2,
                'question' => "Jika array = [1,2,3] lalu disisipkan 4 di indeks 1 → hasilnya:",
                'choices' => [
                    'A' => "[1,2,3,4]",
                    'B' => "[1,4,2,3]",
                    'C' => "[4,1,2,3]",
                    'D' => "[1,2,4,3]"
                ],
                'correct_answer' => "B"
            ],
            [
                'level_id' => 2,
                'question' => "Array A = [10, 20, 30, 40]. Apa isi A[2]?",
                'choices' => [
                    'A' => "10",
                    'B' => "20",
                    'C' => "30",
                    'D' => "40"
                ],
                'correct_answer' => "C"
            ],
            [
                'level_id' => 2,
                'question' => "Guru memberi daftar angka: [15, 9, 2, 7]. Siswa diminta mengurutkan dari kecil ke besar.",
                'choices' => [
                    'A' => "[15, 9, 7, 2]",
                    'B' => "[2, 7, 9, 15]",
                    'C' => "[7, 2, 15, 9]",
                    'D' => "[9, 7, 2, 15]"
                ],
                'correct_answer' => "B"
            ],
            [
                'level_id' => 2,
                'question' => "Diberikan array: [2, 4, 6, 8, 10, ?]\nApa pola bilangan tersebut?",
                'choices' => [
                    'A' => "Dikali 2",
                    'B' => "Ditambah 1",
                    'C' => "Ditambah 2",
                    'D' => "Dikali 3"
                ],
                'correct_answer' => "C"
            ],
            [
                'level_id' => 3,
                'question' => "Stack bekerja berdasarkan prinsip...",
                'choices' => [
                    'A' => "FIFO",
                    'B' => "LIFO",
                    'C' => "FILO",
                    'D' => "Random"
                ],
                'correct_answer' => "B"
            ],
            [
                'level_id' => 3,
                'question' => "Queue digunakan dengan prinsip...",
                'choices' => [
                    'A' => "LIFO",
                    'B' => "LILO",
                    'C' => "FIFO",
                    'D' => "FILO"
                ],
                'correct_answer' => "C"
            ],
            [
                'level_id' => 3,
                'question' => "Dalam sistem antrian di bank, struktur data yang digunakan adalah...",
                'choices' => [
                    'A' => "Tree",
                    'B' => "Stack",
                    'C' => "Queue",
                    'D' => "Graph"
                ],
                'correct_answer' => "C"
            ],
            [
                'level_id' => 3,
                'question' => "Untuk menangani data pelanggan sesuai urutan masuk, maka algoritma yang cocok adalah...",
                'choices' => [
                    'A' => "Menambahkan ke akhir dan memproses dari depan",
                    'B' => "Tambah depan, proses akhir",
                    'C' => "Tambah acak, proses cepat",
                    'D' => "Sortir lalu pop"
                ],
                'correct_answer' => "A"
            ],
            [
                'level_id' => 3,
                'question' => "Rani menggunakan stack dan menjalankan:\nPush(A), Push(B), Push(C), Pop(), Pop()\nApa isi stack sekarang?",
                'choices' => [
                    'A' => "A",
                    'B' => "B",
                    'C' => "C",
                    'D' => "A dan B"
                ],
                'correct_answer' => "A"
            ],
            [
                'level_id' => 3,
                'question' => "Queue = [1,2,3]\nPerintah: enqueue(4), dequeue(), enqueue(5), dequeue()\nApa isi queue?",
                'choices' => [
                    'A' => "[3, 4, 5]",
                    'B' => "[5]",
                    'C' => "[3, 5]",
                    'D' => "[2, 4, 5]"
                ],
                'correct_answer' => "C"
            ],
            [
                'level_id' => 4,
                'question' => "Node pada linked list terdiri dari...",
                'choices' => [
                    'A' => "Data saja",
                    'B' => "Pointer saja",
                    'C' => "Data dan pointer",
                    'D' => "Key dan value"
                ],
                'correct_answer' => "C"
            ],
            [
                'level_id' => 4,
                'question' => "Berikut pernyataan yang benar tentang linked list:",
                'choices' => [
                    'A' => "Mengakses data seperti array",
                    'B' => "Dapat diakses langsung menggunakan indeks",
                    'C' => "Harus ditelusuri dari awal",
                    'D' => "Lebih lambat dari array dalam semua kasus"
                ],
                'correct_answer' => "C"
            ],
            [
                'level_id' => 4,
                'question' => "Keuntungan double linked list dibanding single:",
                'choices' => [
                    'A' => "Lebih kecil memori",
                    'B' => "Bisa ditelusuri dua arah",
                    'C' => "Lebih cepat akses",
                    'D' => "Tidak perlu pointer"
                ],
                'correct_answer' => "B"
            ],
            [
                'level_id' => 4,
                'question' => "Pointer pada linked list mengarah ke...",
                'choices' => [
                    'A' => "Node sebelumnya",
                    'B' => "Node acak",
                    'C' => "Node berikutnya",
                    'D' => "Semua node"
                ],
                'correct_answer' => "C"
            ],
            [
                'level_id' => 4,
                'question' => "Jika node ke-3 dihapus, apa yang perlu diubah?",
                'choices' => [
                    'A' => "Hapus node pertama",
                    'B' => "Ubah pointer node ke-2",
                    'C' => "Ubah data node ke-4",
                    'D' => "Semua node dihapus"
                ],
                'correct_answer' => "B"
            ],
            [
                'level_id' => 4,
                'question' => "Bagaimana menampilkan semua data dalam linked list?",
                'choices' => [
                    'A' => "Gunakan for i = 0 sampai length",
                    'B' => "Telusuri dari node awal hingga null",
                    'C' => "Cetak node terakhir",
                    'D' => "Cetak 3 node pertama"
                ],
                'correct_answer' => "B"
            ],
            [
                'level_id' => 5,
                'question' => "Node paling atas dalam struktur tree disebut...",
                'choices' => [
                    'A' => "Child",
                    'B' => "Leaf",
                    'C' => "Root",
                    'D' => "Node"
                ],
                'correct_answer' => "C"
            ],
            [
                'level_id' => 5,
                'question' => "Leaf node adalah...",
                'choices' => [
                    'A' => "Node tanpa anak",
                    'B' => "Node akar",
                    'C' => "Node dengan satu anak",
                    'D' => "Semua node"
                ],
                'correct_answer' => "A"
            ],
            [
                'level_id' => 5,
                'question' => "Urutan Inorder Traversal yaitu...",
                'choices' => [
                    'A' => "Root → Left → Right",
                    'B' => "Left → Root → Right",
                    'C' => "Right → Root → Left",
                    'D' => "Root → Right → Left"
                ],
                'correct_answer' => "B"
            ],
            [
                'level_id' => 5,
                'question' => "Setiap node dalam binary tree memiliki maksimal...",
                'choices' => [
                    'A' => "1 anak",
                    'B' => "2 anak",
                    'C' => "3 anak",
                    'D' => "Tak terbatas"
                ],
                'correct_answer' => "B"
            ],
            [
                'level_id' => 5,
                'question' => "DFS lebih dulu menjelajah...",
                'choices' => [
                    'A' => "Node anak kiri lalu kanan",
                    'B' => "Semua level dulu",
                    'C' => "Tetangga dekat",
                    'D' => "Cabang sedalam mungkin"
                ],
                'correct_answer' => "D"
            ],
            [
                'level_id' => 5,
                'question' => "Struktur data yang cocok untuk direktori folder adalah...",
                'choices' => [
                    'A' => "Stack",
                    'B' => "Graph",
                    'C' => "Tree",
                    'D' => "List"
                ],
                'correct_answer' => "C"
            ],
            [
                'level_id' => 5,
                'question' => "Graph yang memiliki arah panah antar node disebut…",
                'choices' => [
                    'A' => "Tree",
                    'B' => "Weighted Graph",
                    'C' => "Directed Graph",
                    'D' => "Linked List"
                ],
                'correct_answer' => "C"
            ]
        ];

        foreach ($quizzes as $quiz) {
            Quiz::create($quiz);
        }
    }
}
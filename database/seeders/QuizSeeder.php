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
                'question' => 'Apa yang dimaksud dengan struktur data?',
                'choices' => [
                    'A' => 'Cara menyimpan dan mengorganisir data',
                    'B' => 'Metode untuk menulis kode program',
                    'C' => 'Teknik debugging program',
                    'D' => 'Cara mengkompilasi program'
                ],
                'correct_answer' => 'A'
            ],
            [
                'level_id' => 1,
                'question' => 'Manakah yang termasuk struktur data linear?',
                'choices' => [
                    'A' => 'Tree dan Graph',
                    'B' => 'Array dan Linked List',
                    'C' => 'Hash Table dan Heap',
                    'D' => 'Semua jawaban benar'
                ],
                'correct_answer' => 'B'
            ],
            [
                'level_id' => 1,
                'question' => 'Operasi dasar apa yang umum dilakukan pada struktur data?',
                'choices' => [
                    'A' => 'Insert, Delete, Search, Sort',
                    'B' => 'Create, Read, Update, Delete',
                    'C' => 'Add, Remove, Find, Order',
                    'D' => 'Push, Pop, Peek, Clear'
                ],
                'correct_answer' => 'A'
            ],
            [
                'level_id' => 1,
                'question' => 'Apa yang dimaksud dengan kompleksitas waktu O(1)?',
                'choices' => [
                    'A' => 'Waktu eksekusi konstan',
                    'B' => 'Waktu eksekusi linear',
                    'C' => 'Waktu eksekusi kuadratik',
                    'D' => 'Waktu eksekusi logaritmik'
                ],
                'correct_answer' => 'A'
            ]
        ];

        foreach ($quizzes as $quiz) {
            Quiz::create($quiz);
        }
    }
}
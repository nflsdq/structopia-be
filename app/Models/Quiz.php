<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'level_id',
        'question',
        'choices',
        'correct_answer'
    ];

    protected $casts = [
        'choices' => 'array'
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function quizHistories()
    {
        return $this->hasMany(QuizHistory::class);
    }
}

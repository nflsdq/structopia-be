<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'order',
        'description'
    ];

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }

    public function quizzes()
    {
        return $this->hasMany(Quiz::class);
    }

    public function progress()
    {
        return $this->hasMany(Progress::class);
    }

    public function quizHistories()
    {
        return $this->hasMany(QuizHistory::class);
    }
}

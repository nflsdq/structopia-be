<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'level_id',
        'score',
        'passed'
    ];

    protected $casts = [
        'passed' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}

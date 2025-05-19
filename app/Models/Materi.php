<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $fillable = [
        'level_id',
        'title',
        'type',
        'content',
        'media_url',
        'meta',
        'xp_value',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}

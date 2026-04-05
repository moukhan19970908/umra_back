<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Verse extends Model
{
    use HasFactory, AsSource;

    protected $table = 'verses';

    protected $fillable = [
        'surah_id',
        'verse_number',
        'text_ar',
        'text_ru',
    ];

    public function surah()
    {
        return $this->belongsTo(Surah::class);
    }
}

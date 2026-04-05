<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Surah extends Model
{
    use HasFactory, AsSource;

    protected $table = 'surahs';

    protected $fillable = [
        'number', 'name', 'total_verses'
    ];

    public function verses()
    {
        return $this->hasMany(Verse::class);
    }
}

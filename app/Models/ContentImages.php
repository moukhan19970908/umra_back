<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Orchid\Screen\AsSource;

class ContentImages extends Model
{
    use HasFactory, AsSource;

    protected $fillable = [
        'name',
        'content_id',
    ];

    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'content_id');
    }
}


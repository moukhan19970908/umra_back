<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Screen\AsSource;

class Content extends Model
{
    use HasFactory, AsSource;

    protected $table = 'content';

    protected $fillable = [
        'description',
        'category_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(ContentCategory::class, 'category_id');
    }

    public function images(): HasMany
    {
        return $this->hasMany(ContentImages::class, 'content_id');
    }
}


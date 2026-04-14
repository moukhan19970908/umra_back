<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Hotel extends Model
{
    use AsSource,Attachable;
    protected $fillable = [
        'name',
        'star',
        'description',
    ];

    public function images(): HasMany
    {
        return $this->hasMany(HotelImages::class);
    }
}

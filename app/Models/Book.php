<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Book extends Model
{
    use HasFactory, AsSource;
    protected $fillable = [
        'tour_id',
        'user_id',
        'passport',
        'add_first',
        'add_second',
        'status',
        'full_name',
        'country_id',
        'address',
        'marital_status_id',
        'profession',
        'work_address',
        'whatsapp_number',
        'size',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}

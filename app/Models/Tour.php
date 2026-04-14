<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Tour extends Model
{
    use AsSource,Attachable;
    protected $fillable = [
        'start_date',
        'end_date',
        'price',
        'quantity',
        'hotel_id',
        'packet_id',
        'description',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function packet()
    {
        return $this->belongsTo(Packet::class);
    }
}

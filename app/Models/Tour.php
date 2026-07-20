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
        'hotel_medina_id',
        'packet_id',
        'description',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function hotelMedina()
    {
        return $this->belongsTo(Hotel::class, 'hotel_medina_id');
    }

    public function packet()
    {
        return $this->belongsTo(Packet::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Screen\AsSource;

class Packet extends Model
{
    use AsSource, Attachable;

    protected $fillable = [
        'name',
        'hotel_mecca',
        'hotel_medina',
        'advantages',
        'fly',
    ];
}

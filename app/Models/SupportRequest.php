<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class SupportRequest extends Model
{
    use AsSource;

    public const SUBJECTS = [
        'account' => 'Аккаунт и вход',
        'booking' => 'Бронирование тура',
        'payment' => 'Оплата',
        'bug'     => 'Ошибка в приложении',
        'other'   => 'Другое',
    ];

    protected $fillable = [
        'subject',
        'email',
        'phone',
        'message',
        'status',
    ];
}

<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Packet;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class PacketEditLayout extends Rows
{
    /**
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('packet.name')
                ->title('Название пакета')
                ->placeholder('Введите название пакета...')
                ->required(),

            Input::make('packet.hotel_mecca')
                ->title('Отель в Мекке')
                ->placeholder('Введите название отеля в Мекке...')
                ->required(),

            Input::make('packet.hotel_medina')
                ->title('Отель в Медине')
                ->placeholder('Введите название отеля в Медине...')
                ->required(),

            Input::make('packet.fly')
                ->title('Перелёт')
                ->placeholder('Например: Москва — Джидда, прямой рейс...')
                ->required(),

            TextArea::make('packet.advantages')
                ->title('Преимущества')
                ->placeholder('Опишите преимущества пакета...')
                ->rows(6)
                ->required(),
        ];
    }
}

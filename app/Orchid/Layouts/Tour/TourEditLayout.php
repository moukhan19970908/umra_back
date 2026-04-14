<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Tour;

use App\Models\Hotel;
use App\Models\Packet;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class TourEditLayout extends Rows
{
    /**
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            DateTimer::make('tour.start_date')
                ->title('Дата начала')
                ->format('Y-m-d')
                ->allowInput()
                ->required(),

            DateTimer::make('tour.end_date')
                ->title('Дата окончания')
                ->format('Y-m-d')
                ->allowInput()
                ->required(),

            Input::make('tour.price')
                ->title('Цена (сум)')
                ->type('number')
                ->min(0)
                ->placeholder('Введите цену...')
                ->required(),

            Input::make('tour.quantity')
                ->title('Количество мест')
                ->type('number')
                ->min(1)
                ->placeholder('Введите количество мест...')
                ->required(),

            Select::make('tour.hotel_id')
                ->title('Отель')
                ->fromModel(Hotel::class, 'name')
                ->empty('— Выберите отель —')
                ->required(),

            Select::make('tour.packet_id')
                ->title('Пакет')
                ->fromModel(Packet::class, 'name')
                ->empty('— Выберите пакет —')
                ->required(),

            TextArea::make('tour.description')
                ->title('Описание')
                ->placeholder('Дополнительная информация о туре...')
                ->rows(5),
        ];
    }
}

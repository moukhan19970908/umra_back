<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Tour;

use App\Models\Tour;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TourListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'tours';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', 'ID')
                ->sort()
                ->cantHide()
                ->width('80px'),

            TD::make('start_date', 'Начало')
                ->sort()
                ->render(fn(Tour $tour) => $tour->start_date),

            TD::make('end_date', 'Конец')
                ->sort()
                ->render(fn(Tour $tour) => $tour->end_date),

            TD::make('price', 'Цена (сум)')
                ->align(TD::ALIGN_RIGHT)
                ->render(fn(Tour $tour) => number_format($tour->price, 0, '.', ' ')),

            TD::make('quantity', 'Мест')
                ->align(TD::ALIGN_CENTER)
                ->render(fn(Tour $tour) => $tour->quantity),

            TD::make('hotel_id', 'Отель в Мекке')
                ->render(fn(Tour $tour) => $tour->hotel?->name ?? '—'),

            TD::make('hotel_medina_id', 'Отель в Медине')
                ->render(fn(Tour $tour) => $tour->hotel?->name ?? '—'),

            TD::make('packet_id', 'Пакет')
                ->render(fn(Tour $tour) => $tour->packet?->name ?? '—'),

            TD::make('created_at', 'Создано')
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort()
                ->defaultHidden(),

            TD::make('updated_at', 'Изменено')
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort(),

            TD::make('Действия')
                ->align(TD::ALIGN_CENTER)
                ->width('120px')
                ->render(fn(Tour $tour) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make('Редактировать')
                            ->route('platform.tours.edit', $tour->id)
                            ->icon('bs.pencil'),

                        Button::make('Удалить')
                            ->icon('bs.trash3')
                            ->confirm('Вы уверены, что хотите удалить этот тур?')
                            ->method('remove', [
                                'id' => $tour->id,
                            ]),
                    ])),
        ];
    }
}

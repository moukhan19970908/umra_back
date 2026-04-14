<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Hotel;

use App\Models\Hotel;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class HotelListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'hotels';

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

            TD::make('name', 'Название')
                ->cantHide()
                ->render(fn(Hotel $hotel) => \Illuminate\Support\Str::limit($hotel->name, 80)),

            TD::make('star', 'Звёзд')
                ->align(TD::ALIGN_CENTER)
                ->render(fn(Hotel $hotel) => str_repeat('★', (int) $hotel->star)),

            TD::make('description', 'Описание')
                ->render(fn(Hotel $hotel) => \Illuminate\Support\Str::limit($hotel->description, 80)),

            TD::make('images_count', 'Фото')
                ->render(fn(Hotel $hotel) => $hotel->images_count ?? 0)
                ->align(TD::ALIGN_CENTER),

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
                ->render(fn(Hotel $hotel) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make('Редактировать')
                            ->route('platform.hotels.edit', $hotel->id)
                            ->icon('bs.pencil'),

                        Button::make('Удалить')
                            ->icon('bs.trash3')
                            ->confirm('Вы уверены? Все фотографии отеля также будут удалены.')
                            ->method('remove', [
                                'id' => $hotel->id,
                            ]),
                    ])),
        ];
    }
}

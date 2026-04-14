<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Hotel;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class HotelEditLayout extends Rows
{
    /**
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('hotel.name')
                ->title('Название')
                ->placeholder('Введите название отеля...')
                ->required(),

            Input::make('hotel.star')
                ->title('Звёзд')
                ->type('number')
                ->min(1)
                ->max(5)
                ->placeholder('От 1 до 5')
                ->required(),

            TextArea::make('hotel.description')
                ->title('Описание')
                ->placeholder('Введите описание отеля...')
                ->rows(6)
                ->required(),

            Upload::make('images')
                ->title('Фотографии')
                ->multiple()
                ->acceptedFiles('image/*')
                ->maxFiles(20)
                ->storage('public'),
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Content;

use App\Models\ContentCategory;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class ContentEditLayout extends Rows
{
    /**
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Select::make('content.category_id')
                ->title('Категория')
                ->fromModel(ContentCategory::class, 'name')
                ->empty('— Выберите категорию —')
                ->required(),

            TextArea::make('content.description')
                ->title('Описание (контент)')
                ->placeholder('Введите описание...')
                ->rows(6)
                ->required(),

            Upload::make('content.images')
                ->title('Изображения')
                ->multiple()
                ->acceptedFiles('image/*')
                ->maxFiles(20)
                ->storage('public'),
        ];
    }
}

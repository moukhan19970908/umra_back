<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Verse;

use App\Models\Surah;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class VerseEditLayout extends Rows
{
    /**
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Select::make('verse.surah_id')
                ->title('Сура')
                ->fromModel(Surah::class, 'name')
                ->required(),

            Input::make('verse.verse_number')
                ->title('Номер аята')
                ->type('number')
                ->min(1)
                ->required(),

            TextArea::make('verse.text_ar')
                ->title('Текст (арабский)')
                ->rows(4)
                ->required(),

            TextArea::make('verse.text_ru')
                ->title('Текст (русский)')
                ->rows(4)
                ->required(),
        ];
    }
}

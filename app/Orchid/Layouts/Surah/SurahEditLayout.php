<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Surah;

use App\Models\ContentCategory;
use Illuminate\Support\Number;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class SurahEditLayout extends Rows
{
    /**
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('surah.number')->title('Номер суры')->required(),
            Input::make('surah.name')->title('Название суры')->required(),
            Input::make('surah.total_verses')->title('Кол-во аятов')->required(),
        ];
    }
}

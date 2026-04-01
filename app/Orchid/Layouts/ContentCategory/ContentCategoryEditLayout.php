<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\ContentCategory;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Rows;

class ContentCategoryEditLayout extends Rows
{
    /**
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('contentCategory.name')
                ->title('Название категории')
                ->placeholder('Введите название категории')
                ->required(),
        ];
    }
}

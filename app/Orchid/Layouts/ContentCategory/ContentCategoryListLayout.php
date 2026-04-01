<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\ContentCategory;

use App\Models\ContentCategory;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ContentCategoryListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'contentCategories';

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
                ->sort()
                ->cantHide(),

            TD::make('created_at', 'Создано')
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),

            TD::make('updated_at', 'Изменено')
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort(),

            TD::make('Действия')
                ->align(TD::ALIGN_CENTER)
                ->width('120px')
                ->render(fn (ContentCategory $category) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make('Редактировать')
                            ->route('platform.content-categories.edit', $category->id)
                            ->icon('bs.pencil'),

                        Button::make('Удалить')
                            ->icon('bs.trash3')
                            ->confirm('Вы уверены, что хотите удалить эту категорию?')
                            ->method('remove', [
                                'id' => $category->id,
                            ]),
                    ])),
        ];
    }
}

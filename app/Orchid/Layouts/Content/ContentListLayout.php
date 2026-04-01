<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Content;

use App\Models\Content;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ContentListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'contents';

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

            TD::make('title', 'Название')
                ->cantHide()
                ->render(fn(Content $content) => \Illuminate\Support\Str::limit($content->description, 80)),

            TD::make('description', 'Описание')
                ->cantHide()
                ->render(fn(Content $content) => \Illuminate\Support\Str::limit($content->description, 80)),

            TD::make('category_id', 'Категория')
                ->render(fn(Content $content) => optional($content->category)->name ?? '—'),

            TD::make('images_count', 'Изображений')
                ->render(fn(Content $content) => $content->images_count ?? 0)
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
                ->render(fn(Content $content) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make('Редактировать')
                            ->route('platform.contents.edit', $content->id)
                            ->icon('bs.pencil'),

                        Button::make('Удалить')
                            ->icon('bs.trash3')
                            ->confirm('Вы уверены, что хотите удалить этот контент? Все привязанные изображения также будут удалены.')
                            ->method('remove', [
                                'id' => $content->id,
                            ]),
                    ])),
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Verse;

use App\Models\Verse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class VerseListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'verses';

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

            TD::make('surah_id', 'Сура')
                ->cantHide()
                ->render(fn(Verse $verse) => optional($verse->surah)->name ?? '—'),

            TD::make('verse_number', 'Номер аята')
                ->sort()
                ->align(TD::ALIGN_CENTER)
                ->width('120px'),

            TD::make('text_ar', 'Текст (ар)')
                ->render(fn(Verse $verse) => \Illuminate\Support\Str::limit($verse->text_ar, 60)),

            TD::make('text_ru', 'Текст (рус)')
                ->render(fn(Verse $verse) => \Illuminate\Support\Str::limit($verse->text_ru, 60)),

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
                ->render(fn(Verse $verse) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make('Редактировать')
                            ->route('platform.verse.edit', $verse->id)
                            ->icon('bs.pencil'),

                        Button::make('Удалить')
                            ->icon('bs.trash3')
                            ->confirm('Вы уверены, что хотите удалить этот аят?')
                            ->method('remove', [
                                'id' => $verse->id,
                            ]),
                    ])),
        ];
    }
}

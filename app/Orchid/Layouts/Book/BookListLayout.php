<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Book;

use App\Models\Book;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Illuminate\Support\Facades\Storage;

class BookListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'books';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', 'ID')
                ->sort()
                ->cantHide()
                ->width('60px'),

            TD::make('user_id', 'Пользователь')
                ->cantHide()
                ->render(fn(Book $book) => $book->user
                    ? ($book->user->name . ($book->user->surname ? ' ' . $book->user->surname : ''))
                    : '—'
                ),

            TD::make('tour_id', 'Тур')
                ->render(fn(Book $book) => $book->tour
                    ? 'Тур #' . $book->tour->id . ' (' . $book->tour->start_date . ' — ' . $book->tour->end_date . ')'
                    : '—'
                ),

            TD::make('passport', 'Паспорт')
                ->render(fn(Book $book) => $book->passport
                    ? Link::make('Скачать')
                        ->href(Storage::url($book->passport))
                        ->target('_blank')
                        ->icon('bs.download')
                    : '—'
                ),

            TD::make('add_first', 'Доп. документ 1')
                ->render(fn(Book $book) => $book->add_first
                    ? Link::make('Скачать')
                        ->href(Storage::url($book->add_first))
                        ->target('_blank')
                        ->icon('bs.download')
                    : '—'
                ),

            TD::make('add_second', 'Доп. документ 2')
                ->render(fn(Book $book) => $book->add_second
                    ? Link::make('Скачать')
                        ->href(Storage::url($book->add_second))
                        ->target('_blank')
                        ->icon('bs.download')
                    : '—'
                ),

            TD::make('status', 'Статус')
                ->cantHide()
                ->render(function (Book $book) {
                    $badges = [
                        'pending'  => '<span class="badge bg-warning text-dark">Ожидает</span>',
                        'approved' => '<span class="badge bg-success">Одобрено</span>',
                        'rejected' => '<span class="badge bg-danger">Отклонено</span>',
                    ];

                    return $badges[$book->status] ?? '<span class="badge bg-secondary">Неизвестно</span>';
                }),

            TD::make('created_at', 'Дата создания')
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort(),

            TD::make('Действия')
                ->align(TD::ALIGN_CENTER)
                ->width('120px')
                ->render(function (Book $book) {
                    if ($book->status !== 'pending') {
                        return '';
                    }

                    return DropDown::make()
                        ->icon('bs.three-dots-vertical')
                        ->list([
                            Button::make('Одобрить')
                                ->icon('bs.check-circle')
                                ->confirm('Вы уверены, что хотите одобрить эту заявку?')
                                ->method('approve', [
                                    'id' => $book->id,
                                ]),

                            Button::make('Отклонить')
                                ->icon('bs.x-circle')
                                ->confirm('Вы уверены, что хотите отклонить эту заявку?')
                                ->method('reject', [
                                    'id' => $book->id,
                                ]),
                        ]);
                }),
        ];
    }
}

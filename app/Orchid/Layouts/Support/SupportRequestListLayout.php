<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Support;

use App\Models\SupportRequest;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SupportRequestListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'supportRequests';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', 'ID')
                ->cantHide()
                ->width('60px'),

            TD::make('subject', 'Тема')
                ->render(fn(SupportRequest $item) => e(SupportRequest::SUBJECTS[$item->subject] ?? $item->subject)),

            TD::make('email', 'Почта')
                ->render(fn(SupportRequest $item) => '<a href="mailto:' . e($item->email) . '">' . e($item->email) . '</a>'),

            TD::make('phone', 'Телефон')
                ->render(fn(SupportRequest $item) => '<a href="tel:+' . e($item->phone) . '">+' . e($item->phone) . '</a>'),

            TD::make('message', 'Проблема')
                ->width('360px')
                ->render(fn(SupportRequest $item) => '<span title="' . e($item->message) . '" style="white-space: pre-line">'
                    . e(Str::limit($item->message, 300)) . '</span>'),

            TD::make('status', 'Статус')
                ->cantHide()
                ->render(function (SupportRequest $item) {
                    $badges = [
                        'new'         => '<span class="badge bg-warning text-dark">Новое</span>',
                        'in_progress' => '<span class="badge bg-primary">В работе</span>',
                        'resolved'    => '<span class="badge bg-success">Решено</span>',
                    ];

                    return $badges[$item->status] ?? '<span class="badge bg-secondary">Неизвестно</span>';
                }),

            TD::make('created_at', 'Дата')
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT),

            TD::make('Действия')
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn(SupportRequest $item) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Button::make('В работу')
                            ->icon('bs.hourglass-split')
                            ->method('setStatus', ['id' => $item->id, 'status' => 'in_progress']),

                        Button::make('Решено')
                            ->icon('bs.check-circle')
                            ->method('setStatus', ['id' => $item->id, 'status' => 'resolved']),

                        Button::make('Удалить')
                            ->icon('bs.trash3')
                            ->confirm('Удалить это обращение?')
                            ->method('remove', ['id' => $item->id]),
                    ])),
        ];
    }
}

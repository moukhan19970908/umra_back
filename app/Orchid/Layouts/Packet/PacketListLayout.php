<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Packet;

use App\Models\Packet;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class PacketListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'packets';

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
                ->cantHide()
                ->render(fn(Packet $packet) => \Illuminate\Support\Str::limit($packet->name, 60)),

            TD::make('hotel_mecca', 'Отель в Мекке')
                ->render(fn(Packet $packet) => \Illuminate\Support\Str::limit($packet->hotel_mecca, 40)),

            TD::make('hotel_medina', 'Отель в Медине')
                ->render(fn(Packet $packet) => \Illuminate\Support\Str::limit($packet->hotel_medina, 40)),

            TD::make('fly', 'Перелёт')
                ->render(fn(Packet $packet) => \Illuminate\Support\Str::limit($packet->fly, 40)),

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
                ->render(fn(Packet $packet) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make('Редактировать')
                            ->route('platform.packets.edit', $packet->id)
                            ->icon('bs.pencil'),

                        Button::make('Удалить')
                            ->icon('bs.trash3')
                            ->confirm('Вы уверены, что хотите удалить этот пакет?')
                            ->method('remove', [
                                'id' => $packet->id,
                            ]),
                    ])),
        ];
    }
}

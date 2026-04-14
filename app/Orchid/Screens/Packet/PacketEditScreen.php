<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Packet;

use App\Models\Packet;
use App\Orchid\Layouts\Packet\PacketEditLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class PacketEditScreen extends Screen
{
    /**
     * @var Packet
     */
    public $packet;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Packet $packet): iterable
    {
        return [
            'packet' => $packet,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->packet->exists ? 'Редактировать пакет' : 'Добавить пакет';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return $this->packet->exists
            ? 'Изменить информацию о пакете.'
            : 'Добавить новый пакет умры.';
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Удалить')
                ->icon('bs.trash3')
                ->confirm('Вы уверены, что хотите удалить этот пакет?')
                ->method('remove')
                ->canSee($this->packet->exists),

            Button::make('Сохранить')
                ->icon('bs.check-circle')
                ->method('save'),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::block(PacketEditLayout::class)
                ->title('Информация о пакете')
                ->description('Заполните название, отели, перелёт и преимущества пакета.')
                ->commands(
                    Button::make('Сохранить')
                        ->type(Color::BASIC)
                        ->icon('bs.check-circle')
                        ->method('save')
                ),
        ];
    }

    /**
     * Save or update the packet.
     *
     * @return RedirectResponse
     */
    public function save(Packet $packet, Request $request): RedirectResponse
    {
        $request->validate([
            'packet.name'         => ['required', 'string'],
            'packet.hotel_mecca'  => ['required', 'string'],
            'packet.hotel_medina' => ['required', 'string'],
            'packet.fly'          => ['required', 'string'],
            'packet.advantages'   => ['required', 'string'],
        ]);

        $packet->fill([
            'name'         => $request->input('packet.name'),
            'hotel_mecca'  => $request->input('packet.hotel_mecca'),
            'hotel_medina' => $request->input('packet.hotel_medina'),
            'fly'          => $request->input('packet.fly'),
            'advantages'   => $request->input('packet.advantages'),
        ])->save();

        Toast::info('Пакет сохранён.');

        return redirect()->route('platform.packets');
    }

    /**
     * Delete the packet.
     *
     * @return RedirectResponse
     */
    public function remove(Packet $packet): RedirectResponse
    {
        $packet->delete();

        Toast::info('Пакет удалён.');

        return redirect()->route('platform.packets');
    }
}

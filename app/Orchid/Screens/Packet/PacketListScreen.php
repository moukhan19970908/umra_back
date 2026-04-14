<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Packet;

use App\Models\Packet;
use App\Orchid\Layouts\Packet\PacketListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class PacketListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'packets' => Packet::orderByDesc('id')->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Пакеты';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Управление пакетами: добавление, редактирование и удаление записей.';
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Добавить')
                ->icon('bs.plus-circle')
                ->route('platform.packets.create'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            PacketListLayout::class,
        ];
    }

    /**
     * Delete a packet.
     */
    public function remove(Request $request): void
    {
        Packet::findOrFail($request->get('id'))->delete();

        Toast::info('Пакет удалён.');
    }
}

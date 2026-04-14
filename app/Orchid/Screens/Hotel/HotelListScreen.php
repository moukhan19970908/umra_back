<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Hotel;

use App\Models\Hotel;
use App\Orchid\Layouts\Hotel\HotelListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class HotelListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'hotels' => Hotel::withCount('images')
                ->orderByDesc('id')
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Отели';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Управление отелями: добавление, редактирование и удаление записей.';
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
                ->route('platform.hotels.create'),
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
            HotelListLayout::class,
        ];
    }

    /**
     * Delete hotel with all related images.
     */
    public function remove(Request $request): void
    {
        $hotel = Hotel::with('images')->findOrFail($request->get('id'));

        foreach ($hotel->images as $image) {
            $path = storage_path('app/public/' . $image->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $hotel->images()->delete();
        $hotel->delete();

        Toast::info('Отель удалён.');
    }
}

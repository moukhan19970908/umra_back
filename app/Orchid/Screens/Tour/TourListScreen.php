<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Tour;

use App\Models\Tour;
use App\Orchid\Layouts\Tour\TourListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class TourListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'tours' => Tour::with(['hotel', 'packet'])
                ->orderByDesc('id')
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Туры';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Управление турами: добавление, редактирование и удаление записей.';
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
                ->route('platform.tours.create'),
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
            TourListLayout::class,
        ];
    }

    /**
     * Delete a tour.
     */
    public function remove(Request $request): void
    {
        Tour::findOrFail($request->get('id'))->delete();

        Toast::info('Тур удалён.');
    }
}

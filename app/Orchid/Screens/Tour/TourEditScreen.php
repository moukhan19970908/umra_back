<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Tour;

use App\Models\Tour;
use App\Orchid\Layouts\Tour\TourEditLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class TourEditScreen extends Screen
{
    /**
     * @var Tour
     */
    public $tour;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Tour $tour): iterable
    {
        return [
            'tour' => $tour,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->tour->exists ? 'Редактировать тур' : 'Добавить тур';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return $this->tour->exists
            ? 'Изменить информацию о туре.'
            : 'Добавить новый тур.';
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
                ->confirm('Вы уверены, что хотите удалить этот тур?')
                ->method('remove')
                ->canSee($this->tour->exists),

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
            Layout::block(TourEditLayout::class)
                ->title('Информация о туре')
                ->description('Заполните даты, цену, количество мест и выберите отель с пакетом.')
                ->commands(
                    Button::make('Сохранить')
                        ->type(Color::BASIC)
                        ->icon('bs.check-circle')
                        ->method('save')
                ),
        ];
    }

    /**
     * Save or update the tour.
     *
     * @return RedirectResponse
     */
    public function save(Tour $tour, Request $request): RedirectResponse
    {
        $request->validate([
            'tour.start_date' => ['required', 'date'],
            'tour.end_date' => ['required', 'date', 'after_or_equal:tour.start_date'],
            'tour.price' => ['required', 'integer', 'min:0'],
            'tour.quantity' => ['required', 'integer', 'min:1'],
            'tour.hotel_id' => ['required', 'exists:hotels,id'],
            'tour.hotel_medina_id' => ['required', 'exists:hotels,id'],
            'tour.packet_id' => ['required', 'exists:packets,id'],
            'tour.description' => ['nullable', 'string'],
        ]);

        $tour->fill($request->input('tour'))->save();

        Toast::info('Тур сохранён.');

        return redirect()->route('platform.tours');
    }

    /**
     * Delete the tour.
     *
     * @return RedirectResponse
     */
    public function remove(Tour $tour): RedirectResponse
    {
        $tour->delete();

        Toast::info('Тур удалён.');

        return redirect()->route('platform.tours');
    }
}

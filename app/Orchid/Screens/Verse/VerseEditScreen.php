<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Verse;

use App\Models\Verse;
use App\Orchid\Layouts\Verse\VerseEditLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class VerseEditScreen extends Screen
{
    /**
     * @var Verse
     */
    public $verse;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Verse $verse): iterable
    {
        return [
            'verse' => $verse,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->verse->exists ? 'Редактировать аят' : 'Создать аят';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return $this->verse->exists
            ? 'Изменить данные аята.'
            : 'Добавить новый аят.';
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
                ->confirm('Вы уверены, что хотите удалить этот аят?')
                ->method('remove')
                ->canSee($this->verse->exists),

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
            Layout::block(VerseEditLayout::class)
                ->title('Аят')
                ->description('Заполните данные: суру, номер аята и текст.')
                ->commands(
                    Button::make('Сохранить')
                        ->type(Color::BASIC)
                        ->icon('bs.check-circle')
                        ->method('save')
                ),
        ];
    }

    /**
     * Save or update the verse.
     *
     * @return RedirectResponse
     */
    public function save(Verse $verse, Request $request): RedirectResponse
    {
        $request->validate([
            'verse.surah_id'     => ['required', 'integer', 'exists:surahs,id'],
            'verse.verse_number' => ['required', 'integer', 'min:1'],
            'verse.text_ar'      => ['required', 'string'],
            'verse.text_ru'      => ['required', 'string'],
        ]);

        $verse->fill([
            'surah_id'     => $request->input('verse.surah_id'),
            'verse_number' => $request->input('verse.verse_number'),
            'text_ar'      => $request->input('verse.text_ar'),
            'text_ru'      => $request->input('verse.text_ru'),
        ])->save();

        Toast::info('Аят сохранён.');

        return redirect()->route('platform.verse');
    }

    /**
     * Delete the verse.
     *
     * @return RedirectResponse
     */
    public function remove(Verse $verse): RedirectResponse
    {
        $verse->delete();

        Toast::info('Аят удалён.');

        return redirect()->route('platform.verse');
    }
}

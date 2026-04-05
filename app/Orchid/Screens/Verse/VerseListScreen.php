<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Verse;

use App\Models\Verse;
use App\Orchid\Layouts\Verse\VerseListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class VerseListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'verses' => Verse::with('surah')
                ->select(['id', 'surah_id', 'verse_number', 'text_ar', 'text_ru', 'created_at', 'updated_at'])
                ->orderBy('surah_id')
                ->orderBy('verse_number')
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Аяты';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Управление аятами: добавление, редактирование и удаление записей.';
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
                ->route('platform.verse.create'),
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
            VerseListLayout::class,
        ];
    }

    /**
     * Delete a verse.
     */
    public function remove(Request $request): void
    {
        $verse = Verse::findOrFail($request->get('id'));
        $verse->delete();

        Toast::info('Аят удалён.');
    }
}

<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Surah;

use App\Models\Content;
use App\Models\Surah;
use App\Orchid\Layouts\Surah\SurahListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class SurahListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'surahs' => Surah::select(['id','name','total_verses'])->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Суры';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Управление контентом: добавление, редактирование и удаление записей.';
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
                ->route('platform.surah.create'),
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
            SurahListLayout::class,
        ];
    }

    /**
     * Delete content with all related images.
     */
    public function remove(Request $request): void
    {
    }
}

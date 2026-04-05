<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Surah;

use App\Models\Content;
use App\Models\ContentImages;
use App\Models\Surah;
use App\Orchid\Layouts\Content\ContentEditLayout;
use App\Orchid\Layouts\Surah\SurahEditLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class SurahEditScreen extends Screen
{
    /**
     * @var Content
     */
    public $surah;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Surah $surah): iterable
    {
        return [
            'surah' => $surah,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->surah->exists ? 'Редактировать суру' : 'Создать суру';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return $this->surah->exists
            ? 'Изменить суру.'
            : 'Добавить новую суру';
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
                ->confirm('Вы уверены? Все изображения также будут удалены.')
                ->method('remove')
                ->canSee($this->surah->exists),

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
            Layout::block(SurahEditLayout::class)
                ->title('Контент')
                ->description('Заполните данные: категорию, тему, описание и загрузите изображения.')
                ->commands(
                    Button::make('Сохранить')
                        ->type(Color::BASIC)
                        ->icon('bs.check-circle')
                        ->method('save')
                ),
        ];
    }

    /**
     * Save or update the content and its images.
     *
     * @return RedirectResponse
     */
    public function save(Surah $content, Request $request)
    {
        $request->validate([
            'surah.number' => ['required', 'integer'],
            'surah.name' => ['required','string'],
            'surah.total_verses'  => ['required', 'integer'],
        ]);

        // Сохраняем основную запись
        $content->fill([
            'number' => $request->input('surah.number'),
            'name' => $request->input('surah.name'),
            'total_verses' => $request->input('surah.total_verses'),
        ])->save();

        // Upload в Orchid возвращает ПОЛНЫЙ список attachment ID (старые + новые).
        // Поэтому удаляем все старые записи и пересоздаём из актуального списка.
        Toast::info('Сура сохранён.');

        return redirect()->route('platform.surah');
    }



    /**
     * Delete the content and all its images.
     *
     * @return RedirectResponse
     */
    public function remove(Surah $content)
    {

        $content->delete();

        Toast::info('Сура удалён.');

        return redirect()->route('platform.surah');
    }
}

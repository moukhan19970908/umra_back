<?php

declare(strict_types=1);

namespace App\Orchid\Screens\ContentCategory;

use App\Models\ContentCategory;
use App\Orchid\Layouts\ContentCategory\ContentCategoryEditLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ContentCategoryEditScreen extends Screen
{
    /**
     * @var ContentCategory
     */
    public $contentCategory;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(ContentCategory $contentCategory): iterable
    {
        return [
            'contentCategory' => $contentCategory,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->contentCategory->exists
            ? 'Редактировать категорию'
            : 'Создать категорию';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return $this->contentCategory->exists
            ? 'Изменить название категории контента.'
            : 'Добавить новую категорию контента.';
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
                ->confirm('Вы уверены, что хотите удалить эту категорию?')
                ->method('remove')
                ->canSee($this->contentCategory->exists),

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
            Layout::block(ContentCategoryEditLayout::class)
                ->title('Категория контента')
                ->description('Укажите название для категории контента.')
                ->commands(
                    Button::make('Сохранить')
                        ->type(Color::BASIC)
                        ->icon('bs.check-circle')
                        ->method('save')
                ),
        ];
    }

    /**
     * Save or update the content category.
     *
     * @return RedirectResponse
     */
    public function save(ContentCategory $contentCategory, Request $request)
    {
        $request->validate([
            'contentCategory.name' => ['required', 'string', 'max:255'],
        ]);

        $contentCategory->fill($request->input('contentCategory'))->save();

        Toast::info('Категория сохранена.');

        return redirect()->route('platform.content-categories');
    }

    /**
     * Delete the content category.
     *
     * @return RedirectResponse
     */
    public function remove(ContentCategory $contentCategory)
    {
        $contentCategory->delete();

        Toast::info('Категория удалена.');

        return redirect()->route('platform.content-categories');
    }
}

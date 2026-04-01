<?php

declare(strict_types = 1)
;

namespace App\Orchid\Screens\ContentCategory;

use App\Models\ContentCategory;
use App\Orchid\Layouts\ContentCategory\ContentCategoryListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class ContentCategoryListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'contentCategories' => ContentCategory::select('id', 'name', 'created_at', 'updated_at')
            ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Категории контента';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Управление категориями контента: добавление, редактирование и удаление.';
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
            ->route('platform.content-categories.create'),
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
            ContentCategoryListLayout::class ,
        ];
    }

    /**
     * Delete a content category.
     */
    public function remove(Request $request): void
    {
        ContentCategory::findOrFail($request->get('id'))->delete();

        Toast::info('Категория удалена.');
    }
}

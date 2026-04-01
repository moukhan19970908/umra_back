<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Content;

use App\Models\Content;
use App\Orchid\Layouts\Content\ContentListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class ContentListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'contents' => Content::withCount('images')
                ->with('category')
                ->orderByDesc('id')
                ->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Контент';
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
                ->route('platform.contents.create'),
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
            ContentListLayout::class,
        ];
    }

    /**
     * Delete content with all related images.
     */
    public function remove(Request $request): void
    {
        $content = Content::with('images')->findOrFail($request->get('id'));

        // Удаляем файлы с диска
        foreach ($content->images as $image) {
            $path = storage_path('app/public/' . $image->name);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $content->images()->delete();
        $content->delete();

        Toast::info('Контент удалён.');
    }
}

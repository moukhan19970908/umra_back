<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Content;

use App\Models\Content;
use App\Models\ContentImages;
use App\Orchid\Layouts\Content\ContentEditLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class ContentEditScreen extends Screen
{
    /**
     * @var Content
     */
    public $content;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Content $content): iterable
    {
        $content->load('images', 'category');

        return [
            'content' => $content,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->content->exists ? 'Редактировать контент' : 'Создать контент';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return $this->content->exists
            ? 'Изменить описание, категорию или изображения контента.'
            : 'Добавить новую запись контента с описанием, категорией и изображениями.';
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
                ->canSee($this->content->exists),

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
            Layout::block(ContentEditLayout::class)
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
    public function save(Content $content, Request $request)
    {
        $request->validate([
            'content.category_id' => ['required', 'integer'],
            'content.title' => ['required','string'],
            'content.description'  => ['required', 'string'],
        ]);

        // Сохраняем основную запись
        $content->fill([
            'title' => $request->input('content.title'),
            'description' => $request->input('content.description'),
            'category_id' => $request->input('content.category_id'),
        ])->save();

        // Upload в Orchid возвращает ПОЛНЫЙ список attachment ID (старые + новые).
        // Поэтому удаляем все старые записи и пересоздаём из актуального списка.
        $attachmentIds = array_filter((array) $request->input('content.images', []));

        $content->images()->delete();

        foreach ($attachmentIds as $attachmentId) {
            /** @var Attachment|null $attachment */
            $attachment = Attachment::find($attachmentId);

            if ($attachment) {
                ContentImages::create([
                    'content_id' => $content->id,
                    'name'       => $attachment->url(),
                ]);
            }
        }

        Toast::info('Контент сохранён.');

        return redirect()->route('platform.contents');
    }



    /**
     * Delete the content and all its images.
     *
     * @return RedirectResponse
     */
    public function remove(Content $content)
    {
        foreach ($content->images as $image) {
            $path = storage_path('app/public/' . $image->name);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $content->images()->delete();
        $content->delete();

        Toast::info('Контент удалён.');

        return redirect()->route('platform.contents');
    }
}

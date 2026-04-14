<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Hotel;

use App\Models\Hotel;
use App\Models\HotelImages;
use App\Orchid\Layouts\Hotel\HotelEditLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Attachment\Models\Attachment;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class HotelEditScreen extends Screen
{
    /**
     * @var Hotel
     */
    public $hotel;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Hotel $hotel): iterable
    {
        return [
            'hotel' => $hotel,
            'images' => $hotel->images->map(function ($img) {
                return [
                    'id'   => $img->id,
                    'url'  => $img->image, // ВАЖНО: не image, а url
                    'name' => basename($img->image),
                    'size' => 0, // можно 0 или реальный размер
                ];
            })->toArray(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return $this->hotel->exists ? 'Редактировать отель' : 'Добавить отель';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return $this->hotel->exists
            ? 'Изменить название, звёзды, описание или фотографии отеля.'
            : 'Добавить новый отель с названием, звёздами, описанием и фотографиями.';
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
                ->confirm('Вы уверены? Все фотографии отеля также будут удалены.')
                ->method('remove')
                ->canSee($this->hotel->exists),

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
            Layout::block(HotelEditLayout::class)
                ->title('Информация об отеле')
                ->description('Заполните название, количество звёзд, описание и загрузите фотографии.')
                ->commands(
                    Button::make('Сохранить')
                        ->type(Color::BASIC)
                        ->icon('bs.check-circle')
                        ->method('save')
                ),
        ];
    }

    /**
     * Save or update the hotel and its images.
     *
     * @return RedirectResponse
     */
    public function save(Hotel $hotel, Request $request)
    {
        $request->validate([
            'hotel.name'        => ['required', 'string'],
            'hotel.star'        => ['required', 'integer', 'min:1', 'max:5'],
            'hotel.description' => ['required', 'string'],
        ]);

        $hotel->fill([
            'name'        => $request->input('hotel.name'),
            'star'        => $request->input('hotel.star'),
            'description' => $request->input('hotel.description'),
        ])->save();

        // The field is named 'images' in the layout, not 'hotel.images'.
        $attachmentIds = array_filter((array) $request->input('images', []));

        // Get currently associated images to prevent deletion of existing ones
        $oldImages = $hotel->images->keyBy('id');
        $hotel->images()->delete();

        foreach ($attachmentIds as $attachmentId) {
            /** @var Attachment|null $attachment */
            $attachment = Attachment::find($attachmentId);

            if ($attachment) {
                HotelImages::create([
                    'hotel_id' => $hotel->id,
                    'image'    => $attachment->url(),
                ]);
            } elseif (isset($oldImages[$attachmentId])) {
                // If it is an ID of an existing HotelImages record, retain it
                HotelImages::create([
                    'hotel_id' => $hotel->id,
                    'image'    => $oldImages[$attachmentId]->image,
                ]);
            }
        }

        Toast::info('Отель сохранён.');

        return redirect()->route('platform.hotels');
    }

    /**
     * Delete the hotel and all its images.
     *
     * @return RedirectResponse
     */
    public function remove(Hotel $hotel)
    {
        foreach ($hotel->images as $image) {
            $path = storage_path('app/public/' . $image->image);
            if (file_exists($path)) {
                unlink($path);
            }
        }

        $hotel->images()->delete();
        $hotel->delete();

        Toast::info('Отель удалён.');

        return redirect()->route('platform.hotels');
    }
}

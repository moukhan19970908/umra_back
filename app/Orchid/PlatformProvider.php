<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make('Туры')
                ->icon('bs.geo-alt')
                ->route('platform.tours')
                ->title('Умра'),

            Menu::make('Пакеты')
                ->icon('bs.box-seam')
                ->route('platform.packets'),

            Menu::make('Отели')
                ->icon('bs.building')
                ->route('platform.hotels'),

            Menu::make('Категории контента')
                ->icon('bs.tags')
                ->route('platform.content-categories')
                ->title('Контент'),

            Menu::make('Контент')
                ->icon('bs.file-richtext')
                ->route('platform.contents'),

            Menu::make('Суры')
                ->icon('bs.tags')
                ->route('platform.surah'),

            Menu::make('Аяты')
                ->icon('bs.journal-text')
                ->route('platform.verse'),
            ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}

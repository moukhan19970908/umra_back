<?php

declare(strict_types=1);

use App\Orchid\Screens\Examples\ExampleActionsScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleGridScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\Content\ContentEditScreen;
use App\Orchid\Screens\Content\ContentListScreen;
use App\Orchid\Screens\ContentCategory\ContentCategoryEditScreen;
use App\Orchid\Screens\ContentCategory\ContentCategoryListScreen;
use App\Orchid\Screens\Verse\VerseListScreen;
use App\Orchid\Screens\Verse\VerseEditScreen;
use App\Orchid\Screens\Hotel\HotelListScreen;
use App\Orchid\Screens\Hotel\HotelEditScreen;
use App\Orchid\Screens\Packet\PacketListScreen;
use App\Orchid\Screens\Packet\PacketEditScreen;
use App\Orchid\Screens\Tour\TourListScreen;
use App\Orchid\Screens\Tour\TourEditScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Tours > Edit
Route::screen('tours/{tour}/edit', TourEditScreen::class)
    ->name('platform.tours.edit')
    ->breadcrumbs(fn(Trail $trail, $tour) => $trail
        ->parent('platform.tours')
        ->push('Редактировать', route('platform.tours.edit', $tour)));

// Platform > Tours > Create
Route::screen('tours/create', TourEditScreen::class)
    ->name('platform.tours.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.tours')
        ->push('Добавить', route('platform.tours.create')));

// Platform > Tours
Route::screen('tours', TourListScreen::class)
    ->name('platform.tours')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Туры', route('platform.tours')));

// Platform > Packets > Edit
Route::screen('packets/{packet}/edit', PacketEditScreen::class)
    ->name('platform.packets.edit')
    ->breadcrumbs(fn(Trail $trail, $packet) => $trail
        ->parent('platform.packets')
        ->push('Редактировать', route('platform.packets.edit', $packet)));

// Platform > Packets > Create
Route::screen('packets/create', PacketEditScreen::class)
    ->name('platform.packets.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.packets')
        ->push('Добавить', route('platform.packets.create')));

// Platform > Packets
Route::screen('packets', PacketListScreen::class)
    ->name('platform.packets')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Пакеты', route('platform.packets')));

// Platform > Hotels > Edit
Route::screen('hotels/{hotel}/edit', HotelEditScreen::class)
    ->name('platform.hotels.edit')
    ->breadcrumbs(fn(Trail $trail, $hotel) => $trail
        ->parent('platform.hotels')
        ->push('Редактировать', route('platform.hotels.edit', $hotel)));

// Platform > Hotels > Create
Route::screen('hotels/create', HotelEditScreen::class)
    ->name('platform.hotels.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.hotels')
        ->push('Добавить', route('platform.hotels.create')));

// Platform > Hotels
Route::screen('hotels', HotelListScreen::class)
    ->name('platform.hotels')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Отели', route('platform.hotels')));

// Platform > Books (Заявки)
Route::screen('books', \App\Orchid\Screens\Book\BookListScreen::class)
    ->name('platform.books')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Заявки на туры', route('platform.books')));

// Platform > Contents > Edit
Route::screen('contents/{content}/edit', ContentEditScreen::class)
    ->name('platform.contents.edit')
    ->breadcrumbs(fn(Trail $trail, $content) => $trail
        ->parent('platform.contents')
        ->push('Редактировать', route('platform.contents.edit', $content)));

// Platform > Contents > Create
Route::screen('contents/create', ContentEditScreen::class)
    ->name('platform.contents.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.contents')
        ->push('Создать', route('platform.contents.create')));

// Platform > Contents
Route::screen('contents', ContentListScreen::class)
    ->name('platform.contents')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Контент', route('platform.contents')));

Route::screen('surah', \App\Orchid\Screens\Surah\SurahListScreen::class)
    ->name('platform.surah')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Суры', route('platform.surah')));

// Platform > Contents > Create
Route::screen('surah/create', \App\Orchid\Screens\Surah\SurahEditScreen::class)
    ->name('platform.surah.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.surah')
        ->push('Создать', route('platform.surah.create')));

Route::screen('surah/{content}/edit', \App\Orchid\Screens\Surah\SurahEditScreen::class)
    ->name('platform.surah.edit')
    ->breadcrumbs(fn(Trail $trail, $surah) => $trail
        ->parent('platform.surah')
        ->push('Редактировать', route('platform.surah.edit', $surah)));


// Platform > Verses
Route::screen('verse', VerseListScreen::class)
    ->name('platform.verse')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Аяты', route('platform.verse')));

// Platform > Verses > Create
Route::screen('verse/create', VerseEditScreen::class)
    ->name('platform.verse.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.verse')
        ->push('Создать', route('platform.verse.create')));

// Platform > Verses > Edit
Route::screen('verse/{verse}/edit', VerseEditScreen::class)
    ->name('platform.verse.edit')
    ->breadcrumbs(fn(Trail $trail, $verse) => $trail
        ->parent('platform.verse')
        ->push('Редактировать', route('platform.verse.edit', $verse)));


// Platform > Content Categories > Edit
Route::screen('content-categories/{contentCategory}/edit', ContentCategoryEditScreen::class)
    ->name('platform.content-categories.edit')
    ->breadcrumbs(fn(Trail $trail, $contentCategory) => $trail
        ->parent('platform.content-categories')
        ->push($contentCategory->name, route('platform.content-categories.edit', $contentCategory)));

// Platform > Content Categories > Create
Route::screen('content-categories/create', ContentCategoryEditScreen::class)
    ->name('platform.content-categories.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.content-categories')
        ->push('Создать', route('platform.content-categories.create')));

// Platform > Content Categories
Route::screen('content-categories', ContentCategoryListScreen::class)
    ->name('platform.content-categories')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Категории контента', route('platform.content-categories')));

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn(Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn(Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Example Screen'));

Route::screen('/examples/form/fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('/examples/form/advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');
Route::screen('/examples/form/editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('/examples/form/actions', ExampleActionsScreen::class)->name('platform.example.actions');

Route::screen('/examples/layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('/examples/grid', ExampleGridScreen::class)->name('platform.example.grid');
Route::screen('/examples/charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('/examples/cards', ExampleCardsScreen::class)->name('platform.example.cards');

// Route::screen('idea', Idea::class, 'platform.screens.idea');

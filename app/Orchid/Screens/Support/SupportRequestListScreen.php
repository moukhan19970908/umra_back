<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Support;

use App\Models\SupportRequest;
use App\Orchid\Layouts\Support\SupportRequestListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class SupportRequestListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'supportRequests' => SupportRequest::orderByDesc('id')->paginate(15),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Обращения в поддержку';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Обращения пользователей со страницы поддержки.';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            SupportRequestListLayout::class,
        ];
    }

    /**
     * Change request status.
     */
    public function setStatus(Request $request): void
    {
        $status = $request->get('status');
        abort_unless(in_array($status, ['new', 'in_progress', 'resolved'], true), 422);

        SupportRequest::findOrFail($request->get('id'))->update(['status' => $status]);

        Toast::info('Статус обращения обновлён.');
    }

    /**
     * Delete a request.
     */
    public function remove(Request $request): void
    {
        SupportRequest::findOrFail($request->get('id'))->delete();

        Toast::info('Обращение удалено.');
    }
}

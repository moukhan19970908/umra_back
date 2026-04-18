<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Book;

use App\Models\Book;
use App\Orchid\Layouts\Book\BookListLayout;
use App\Orchid\Layouts\Book\BookFiltersLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class BookListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Request $request): iterable
    {
        $books = Book::with(['user', 'tour'])
            ->when($request->get('status'), function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->get('user_id'), function ($query, $userId) {
                $query->where('user_id', $userId);
            })
            ->when($request->get('tour_id'), function ($query, $tourId) {
                $query->where('tour_id', $tourId);
            })
            ->when($request->get('date_from'), function ($query, $dateFrom) {
                $query->whereDate('created_at', '>=', $dateFrom);
            })
            ->when($request->get('date_to'), function ($query, $dateTo) {
                $query->whereDate('created_at', '<=', $dateTo);
            })
            ->orderByDesc('id')
            ->paginate(15);

        return [
            'books' => $books,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Заявки на туры';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Управление заявками: просмотр, одобрение и отклонение заявок на туры.';
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
            BookFiltersLayout::class,
            BookListLayout::class,
        ];
    }

    /**
     * Approve a booking.
     */
    public function approve(Request $request): void
    {
        $book = Book::findOrFail($request->get('id'));
        $book->update(['status' => 'approved']);

        Toast::info('Заявка одобрена.');
    }

    /**
     * Reject a booking.
     */
    public function reject(Request $request): void
    {
        $book = Book::findOrFail($request->get('id'));
        $book->update(['status' => 'rejected']);

        Toast::warning('Заявка отклонена.');
    }
}

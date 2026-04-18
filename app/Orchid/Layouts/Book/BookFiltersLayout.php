<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Book;

use Orchid\Filters\Filter;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Selection;

class BookFiltersLayout extends Selection
{
    /**
     * @return Filter[]
     */
    public function filters(): array
    {
        return [
            BookStatusFilter::class,
            BookUserFilter::class,
            BookTourFilter::class,
            BookDateFromFilter::class,
            BookDateToFilter::class,
        ];
    }
}

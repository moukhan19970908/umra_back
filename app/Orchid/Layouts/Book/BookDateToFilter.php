<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Book;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\DateTimer;

class BookDateToFilter extends Filter
{
    /**
     * The displayable name of the filter.
     */
    public function name(): string
    {
        return 'Дата до';
    }

    /**
     * The array of matched parameters.
     */
    public function parameters(): ?array
    {
        return ['date_to'];
    }

    /**
     * Apply to a given Eloquent query builder.
     */
    public function run(Builder $builder): Builder
    {
        return $builder->whereDate('created_at', '<=', $this->request->get('date_to'));
    }

    /**
     * Get the display fields.
     */
    public function display(): array
    {
        return [
            DateTimer::make('date_to')
                ->value($this->request->get('date_to'))
                ->title('Дата до')
                ->allowInput(),
        ];
    }
}

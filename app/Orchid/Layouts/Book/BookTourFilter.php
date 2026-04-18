<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Book;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Input;

class BookTourFilter extends Filter
{
    /**
     * The displayable name of the filter.
     */
    public function name(): string
    {
        return 'ID тура';
    }

    /**
     * The array of matched parameters.
     */
    public function parameters(): ?array
    {
        return ['tour_id'];
    }

    /**
     * Apply to a given Eloquent query builder.
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('tour_id', $this->request->get('tour_id'));
    }

    /**
     * Get the display fields.
     */
    public function display(): array
    {
        return [
            Input::make('tour_id')
                ->type('number')
                ->value($this->request->get('tour_id'))
                ->title('ID тура')
                ->placeholder('Введите ID'),
        ];
    }
}

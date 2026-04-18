<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Book;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Input;

class BookUserFilter extends Filter
{
    /**
     * The displayable name of the filter.
     */
    public function name(): string
    {
        return 'ID пользователя';
    }

    /**
     * The array of matched parameters.
     */
    public function parameters(): ?array
    {
        return ['user_id'];
    }

    /**
     * Apply to a given Eloquent query builder.
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('user_id', $this->request->get('user_id'));
    }

    /**
     * Get the display fields.
     */
    public function display(): array
    {
        return [
            Input::make('user_id')
                ->type('number')
                ->value($this->request->get('user_id'))
                ->title('ID пользователя')
                ->placeholder('Введите ID'),
        ];
    }
}

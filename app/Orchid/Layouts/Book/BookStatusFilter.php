<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Book;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Select;

class BookStatusFilter extends Filter
{
    /**
     * The displayable name of the filter.
     */
    public function name(): string
    {
        return 'Статус';
    }

    /**
     * The array of matched parameters.
     */
    public function parameters(): ?array
    {
        return ['status'];
    }

    /**
     * Apply to a given Eloquent query builder.
     */
    public function run(Builder $builder): Builder
    {
        return $builder->where('status', $this->request->get('status'));
    }

    /**
     * Get the display fields.
     */
    public function display(): array
    {
        return [
            Select::make('status')
                ->options([
                    ''         => 'Все статусы',
                    'pending'  => 'Ожидает',
                    'approved' => 'Одобрено',
                    'rejected' => 'Отклонено',
                ])
                ->value($this->request->get('status'))
                ->title('Статус'),
        ];
    }
}

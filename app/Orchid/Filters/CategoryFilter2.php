<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Field;
use App\Models\Category;
use Orchid\Screen\Fields\Select;


class CategoryFilter extends Filter
{
    /**
     * The displayable name of the filter.
     *
     * @return string
     */
    public function name(): string
    {
        return __('Category');
    }

    /**
     * The array of matched parameters.
     *
     * @return array|null
     */
    public function parameters(): ?array
    {
        return ['category'];
    }

    /**
     * Apply to a given Eloquent query builder.
     *
     * @param Builder $builder
     *
     * @return Builder
     */
    public function run(Builder $builder): Builder
    {
        return $builder->whereHas('category', function (Builder $query) {
            $query->where('slug', $this->request->get('category'));
        });
    }

    /**
     * Get the display fields.
     *
     * @return Field[]
     */
    public function display(): iterable
    {
        return [

            Select::make('category')
                ->fromModel(Category::class, 'name', 'slug')
                ->empty()
                ->value($this->request->get('category'))
                ->title(__('Category')),

        ];
    }

    /**
     * Value to be displayed
     */
    public function value(): string
    {
        return $this->name().': '.Category::where('slug', $this->request->get('category'))->first()->name;
    }
}

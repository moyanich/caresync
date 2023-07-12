<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Medicine;

use App\Models\Category;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class CategoryEditLayout extends Rows
{
    /**
     * Views.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Input::make('category.id') ->type('hidden'),

            Input::make('category.name')
                ->title('Name:')
                ->value('category.name')
                ->horizontal()
                ->required(),

            TextArea::make('category.description')
                ->title('Description')
                ->value('category.description')
                ->rows(5)
                ->horizontal(),
        ];
    }
}

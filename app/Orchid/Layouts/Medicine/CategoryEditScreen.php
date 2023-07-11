<?php

namespace App\Orchid\Screens\Medicine;

use App\Models\Category;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;

use Illuminate\Http\Request;


class CategoryEditScreen extends Screen
{

    /**
     * @var Category
     */
    public $category;


    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(Category $category): iterable
    {
        $category->get();

        return [
            'medicine' => $category,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Edit Category';
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
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::modal('categoryModalEdit', Layout::rows([
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
            ]))

            ->title('Edit Category')
            ->applyButton('Edit Category'),
        ];
    }
}

<?php

namespace App\Orchid\Screens\Medicine;

use App\Models\Category;
use Orchid\Screen\Screen;

use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;


use Illuminate\Http\Request;

class MedicineCategoryScreen extends Screen
{

    /**
     * @var string
     */
   // public $target = 'category';

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'category' => Category::filters()->defaultSort('id')->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Medicine Category Screen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [

            ModalToggle::make('Add Category')
            ->modal('categoryModal')
            ->method('create')
            ->icon('plus'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('category', [
                TD::make('name')->sort()->filter(Input::make()),
                TD::make('description', 'Description'),
                TD::make('Actions')
                ->render(function ($category) {
                    return Link::make($category->id)
                        ->route('platform.medicine.edit', $category);
                }),
            ]),

            Layout::modal('categoryModal', Layout::rows([
                Input::make('category.name')
                    ->title('Name:')
                    ->placeholder('Enter category name')
                    ->horizontal()
                    ->required(),

                TextArea::make('category.description')
                    ->title('Description')
                    ->rows(5)
                    ->horizontal(),
            ]))

            ->title('Add Category')
            ->applyButton('Add Category'),


        ];
    }

    public function create(Request $request)
    {
        // Validate form data, save task to database, etc.
        $request->validate([
            'category.name' => 'required|max:255',
        ]);

        $category = new Category();
        $category->name = $request->input('category.name');
        $category->description= $request->input('category.description');

        $category->save();

        Toast::info(__('Category added.'));

    }

}

<?php

namespace App\Orchid\Screens\Medicine;

use App\Models\Category;
use Orchid\Screen\Screen;

use App\Orchid\Layouts\Medicine\CategoryEditLayout;

use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\TD;

use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

use Illuminate\Http\Request;

class MedicineCategoryScreen extends Screen
{

    /**
     * @var string
     */
    public $target = 'category';

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
                TD::make(__('Actions'))
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(fn (Category $category) => DropDown::make()
                        ->icon('bs.three-dots-vertical')
                        ->list([

                            /*ModalToggle::make('Edit')
                                ->modal('categoryEditModal')
                                ->icon('bs.pencil')
                                ->method('edit')
                                ->asyncParameters([ 'id' => $category->id]),
                                */

                            Link::make(__('Edit'))
                               ->route('platform.category.edit', $category->id)
                                ->icon('bs.pencil'),

                            Button::make(__('Delete'))
                                ->icon('bs.trash3')
                                ->confirm(__('Once this item is deleted, all of its resources and data will be permanently deleted. Before deleting this item, please download any data or information that you wish to retain.'))
                                ->method('remove', [
                                    'id' => $category->id,
                                ]),
                        ])),

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


            Layout::modal('categoryEditModal', [
                CategoryEditLayout ::class
            ])
                ->async('asyncCategoryEditModal')
                ->rawClick()
                ->applyButton(__('Save')),

        ];
    }

    /**
     * @param Category $category
     *
     * @return array
     */
   /* public function asyncCategoryEditModal(Category $category): array
    {
        return [
            'category' => $category
        ];
    } */

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

    public function remove(Request $request): void
    {
        Category::findOrFail($request->get('id'))->delete();

        Toast::info(__('Category was removed'));
    }

}

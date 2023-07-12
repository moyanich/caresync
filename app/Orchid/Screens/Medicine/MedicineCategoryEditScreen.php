<?php

namespace App\Orchid\Screens\Medicine;

use Orchid\Screen\Screen;
use App\Models\Category;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

use Illuminate\Http\Request;

class MedicineCategoryEditScreen extends Screen
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
        return [
            'category' => $category,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Category Edit Screen';
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
            Layout::rows([
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

                Button::make('Update')
                    ->method('createOrUpdate')
                    ->canSee($this->category->exists)
                    ->type(Color::BASIC),

            ]), //->title('Textual HTML5 Inputs'),

            Layout::browsing('http://127.0.0.1:8000/telescope'),

        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createOrUpdate(Request $request)
    {
        $this->category->fill($request->get('category'))->save();

        Toast::info(__($this->category->name . ' changes were saved.'));

        return redirect()->route('platform.category.edit', $this->category->id);
    }
}

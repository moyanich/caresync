<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Medicine;

use App\Models\Medicine;
use App\Models\Category;
use App\Orchid\Layouts\Medicine\MedicineListLayout;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;

use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

use Illuminate\Http\Request;

class MedicineListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'medicines' => Medicine::filters()->defaultSort('id')->paginate(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Medicine List';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "List of medicine in inventory";
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            ModalToggle::make('Add Medicine')
                ->modal('medicineModal')
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
           /* Layout::table('medicinelists', [
                TD::make('name')->sort()->filter(Input::make()),
                TD::make('generic_name', 'Generic Name')->sort(),
                TD::make('purchase_price', 'Purchase Price')->sort(),
                TD::make('qty', 'Quantity')->sort(),
                TD::make('company', 'Company')->sort(),
                TD::make('location', 'Storage Location')->sort(),
                TD::make('expiration_date', 'Expiration Date')->sort(),
                TD::make('Actions')
                ->render(function ($medicine) {
                    return Link::make($medicine->id)
                        ->route('platform.medicine.edit', $medicine);
                }),
            ]), */


            MedicineListLayout::class,

            Layout::modal('medicineModal', Layout::rows([
                Input::make('medicine.name')
                ->title('Name:')
                ->placeholder('Enter medicine name')
                ->required(),

                Input::make('medicine.purchase_price')
                    ->type('number')
                    ->title('Purchase Price:'),

                Input::make('medicine.qty')
                    ->type('number')
                    ->title('Quantity:'),

                Input::make('medicine.generic_name')
                    ->type('text')
                    ->title('Generic Name:'),

                Select::make('medicine.category_id')
                    ->fromModel(Category::class, 'name', 'id')
                    ->title('Category'),

                Input::make('medicine.company')
                    ->type('text')
                    ->title('Company:'),

                Input::make('medicine.location')
                    ->type('text')
                    ->title('Storage Location:'),

                Input::make('medicine.expiration_date')
                    ->type('date')
                    ->title('Expiration Date'),

                TextArea::make('medicine.effects')
                    ->title('Side Effects')
                    ->rows(5),

            ]))

            ->title('Add Medicine')
            ->applyButton('Add Medicine'),
        ];
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function create(Request $request)
    {
        // Validate form data, save task to database, etc.
        $request->validate([
            'medicine.name' => 'required|max:255',
        ]);

        $medicine = new Medicine();
        $medicine->name = $request->input('medicine.name');
        $medicine->category_id = $request->input('medicine.category_id');
        $medicine->purchase_price= $request->input('medicine.purchase_price');
        $medicine->qty = $request->input('medicine.qty');
        $medicine->generic_name = $request->input('medicine.generic_name');
        $medicine->company = $request->input('medicine.company');
        $medicine->location = $request->input('medicine.location');
        $medicine->effects = $request->input('medicine.effects');
        $medicine->expiration_date = $request->input('medicine.expiration_date');
        $medicine->save();

        Toast::info(__('Medicine added.'));
    }

    public function remove(Request $request): void
    {
        Medicine::findOrFail($request->get('id'))->delete();

        Toast::info(__('Medicine was removed'));
    }

}

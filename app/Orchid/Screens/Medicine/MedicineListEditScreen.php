<?php

namespace App\Orchid\Screens\Medicine;

use App\Models\MedicineList;
use Orchid\Screen\Screen;

use Orchid\Screen\Actions\Link;
use Illuminate\Http\Request;

use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class MedicineListEditScreen extends Screen
{
    /**
     * @var MedicineList
     */
    public $medicine;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(MedicineList $medicine): iterable
    {
        $medicine->get();

        return [
            'medicine' => $medicine,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Edit Medicine';
    }

    public function permission(): ?iterable
    {
        return [
            'platform.systems.users',
        ];
    }



    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            //TODO create route
            Link::make(__('Add'))
                ->icon('bs.plus-circle')
               // ->route('platform.medicine.create'),
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
            Layout::rows([
                Input::make('medicine.name')
                    ->title('Name:')
                    ->value('medicine.name')
                    ->horizontal(),

                Input::make('medicine.purchase_price')
                    ->title('Purchase Price:')
                    ->value('medicine.purchase_price')
                    ->type('number')
                    ->horizontal(),

                Input::make('medicine.qty')
                    ->type('number')
                    ->title('Quantity:')
                    ->value('medicine.qty')
                    ->horizontal(),

                Input::make('medicine.generic_name')
                    ->type('text')
                    ->title('Generic Name:')
                    ->value('medicine.generic_name')
                    ->horizontal(),

                Input::make('medicine.company')
                    ->type('text')
                    ->title('Company:')
                    ->value('medicine.company')
                    ->horizontal(),

                Input::make('medicine.location')
                    ->type('text')
                    ->title('Storage Location:')
                    ->value('medicine.location')
                    ->horizontal(),

                Input::make('medicine.expiration_date')
                    ->type('date')
                    ->title('Expiration Date')
                    ->value('medicine.expiration_date')
                    ->horizontal(),

                Input::make('medicine.effects')
                    ->type('textarea')
                    ->title('Side Effects')
                    ->rows(3)
                    ->value('medicine.effects')
                    ->horizontal(),


                Button::make('Submit')
                    ->method('save')
                    ->canSee($this->medicine->exists)
                    ->type(Color::BASIC),

            ]), //->title('Textual HTML5 Inputs'),




            Layout::browsing('http://127.0.0.1:8000/telescope'),

        ];
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request, MedicineList $medicinelist)
    {
        $request->validate([
            'medicine.name' => [
                //'required',
               // MedicineList::unique(MedicineList::class, 'name')->ignore($user),
            ],
        ]);

        $medicinelist = MedicineList::findOrFail($request->get('id'));

        //$medicinelist = MedicineList::findOrFail($medicinelist->id);

        $medicinelist->name = $request->input('medicine.name');
        $medicinelist->purchase_price= $request->input('medicine.purchase_price');
        $medicinelist->qty = $request->input('medicine.qty');
        $medicinelist->generic_name = $request->input('medicine.generic_name');
        $medicinelist->company = $request->input('medicine.company');
        $medicinelist->location = $request->input('medicine.location');
        $medicinelist->effects = $request->input('medicine.effects');
        $medicinelist->expiration_date = $request->input('medicine.expiration_date');



        // Generic name is unique
        $medicinelist->fill($request->all())->save();

        //$medicinelist->save();

        Toast::info(__('Medicine was saved.'));

        return redirect()->route('platform.medicine.edit', $medicinelist->id);
    }
}

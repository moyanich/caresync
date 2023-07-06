<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Layouts\Modal;

use App\Models\MedicineList;
use Illuminate\Http\Request;



class MedicineListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'MedicineListScreen';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return "TMedicineListScreen";
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
            Layout::modal('medicineModal', Layout::rows([
                Input::make('medicine.name')
                    ->title('Name:')
                    ->placeholder('Enter medicine name')
                    ->required()
                    ->popover('The name of the medicine to be created'),

                Input::make('medicine.purchase_price')
                    ->type('number')
                    ->title('Purchase Price:'),

                Input::make('medicine.qty')
                    ->type('number')
                    ->title('Quantity:'),

                Input::make('medicine.generic_name')
                    ->type('text')
                    ->title('Generic Name:')
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

        $medicine_list = new MedicineList();
        $medicine_list->name = $request->input('medicine.name');
        $medicine_list->purchase_price= $request->input('medicine.purchase_price');
        $medicine_list->qty = $request->input('medicine.qty');
        $medicine_list->generic_name = $request->input('medicine.generic_name');
        
        $medicine_list->save();
    }


}

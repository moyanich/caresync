<?php

namespace App\Orchid\Screens\Medicine;

use Orchid\Screen\Screen;

use App\Models\MedicineList;
use Illuminate\Http\Request;

class MedicineListEditScreen extends Screen
{
    /**
     * @var Medicine
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
            'medicine'       => $medicine,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'MedicineListEditScreen';
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
        return [];
    }
}

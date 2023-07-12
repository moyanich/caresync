<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Medicine;

use App\Models\Medicine;
use App\Models\Category;
use App\Orchid\Layouts\Medicine\MedicineCreateLayout;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class MedicineCreateScreen extends Screen
{
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
        return 'Add Medicine Screen';
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
            MedicineCreateLayout::class,

            Layout::browsing('http://127.0.0.1:8000/telescope'),
        ];
    }

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

        return redirect()->route('platform.medicines.list');
    }


}

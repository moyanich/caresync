<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Medicine;

//use Orchid\Platform\Models\MedicineList;
use App\Models\MedicineList;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class MedicineListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'medicinelists';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [

            TD::make('name')->sort()->filter(Input::make()),
                TD::make('generic_name', 'Generic Name')->sort()
                ->render(fn (MedicineList $medicinelist) => $medicinelist->name),
                TD::make('purchase_price', 'Purchase Price')->sort(),
                TD::make('qty', 'Quantity')->sort(),
                TD::make('company', 'Company')->sort(),
                TD::make('location', 'Storage Location')->sort(),
                TD::make('expiration_date', 'Expiration Date')->sort(),
                TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (MedicineList $medicinelist) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.medicine.edit', $medicinelist->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once an item is deleted, all of its resources and data will be permanently deleted. Before deleting this item, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $medicinelist->id,
                            ]),
                    ])),

        ];
    }




}

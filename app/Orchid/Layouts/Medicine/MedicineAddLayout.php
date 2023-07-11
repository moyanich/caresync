<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Medicine;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;
use Orchid\Support\Color;

class MedicineAddLayout extends Rows
{

    /**
     * @var string
     */
    public $target = 'medicines';


    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('medicine.name')
            ->title('Name:')
            ->placeholder('Enter medicine name')
            ->horizontal()
            ->required(),

            Input::make('medicine.purchase_price')
                ->type('number')
                ->title('Purchase Price:')
                ->horizontal(),

            Input::make('medicine.qty')
                ->type('number')
                ->title('Quantity:')
                ->horizontal(),

            Input::make('medicine.generic_name')
                ->type('text')
                ->title('Generic Name:')
                ->horizontal(),

            Input::make('medicine.company')
                ->type('text')
                ->title('Company:')
                ->horizontal(),

            Input::make('medicine.location')
                ->type('text')
                ->title('Storage Location:')
                ->horizontal(),

            Input::make('medicine.expiration_date')
                ->type('date')
                ->title('Expiration Date')
                ->horizontal(),

            TextArea::make('medicine.effects')
                ->title('Side Effects')
                ->rows(5)
                ->horizontal(),

            Button::make('Submit')
            ->method('create')
            ->horizontal()
            ->type(Color::PRIMARY),
        ];
    }
}

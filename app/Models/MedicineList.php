<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class MedicineList extends Model
{
    use HasFactory, AsSource;

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'purchase_price',
        'qty',
        'generic_name'
    ];
}

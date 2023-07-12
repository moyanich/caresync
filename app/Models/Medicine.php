<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Attachment\Attachable;
use Orchid\Attachment\Models\Attachment;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class Medicine extends Model
{
    use HasFactory, AsSource, Attachable, Filterable;

    protected $table = 'medicines';

    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'category_id',
        'purchase_price',
        'qty',
        'generic_name',
        'company',
        'effects',
        'location',
        'expiration_date'
    ];

    /**
     * Name of columns to which http sorting can be applied
     *
     * @var array
     */
    protected $allowedSorts = [
        'name',
        'category_id',
        'purchase_price',
        'qty',
        'generic_name',
        'company',
        'effects',
        'location',
        'expiration_date'
    ];

    /**
     * Get the parish associated with the employee.
     */
   /*  public function category()
    {
        return $this->hasOne(Category::class, 'category_id');
    } */
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;


class Category extends Model
{
    use HasFactory, AsSource, Filterable;

    // Table Name
    protected $table = 'category';

    // Primary Key
    public $primaryKey = 'id';

     /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * Name of columns to which http sorting can be applied
     *
     * @var array
     */
    protected $allowedSorts = [
        'name'
    ];


     /**
     * Get the parish associated with the employee.
     */
  /*  public function medicine()
    {
        return $this->hasOne(Medicine::class, 'id');
    } */


}

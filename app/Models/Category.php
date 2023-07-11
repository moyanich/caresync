<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;


class Category extends Model
{
    use HasFactory, AsSource, Filterable;

    protected $table = 'category';


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
}

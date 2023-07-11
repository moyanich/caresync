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

    /**
     * @var array
     */
    protected $fillable = [
        'name',
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
        'purchase_price',
        'qty',
        'generic_name',
        'company',
        'effects',
        'location',
        'expiration_date'
    ];
}

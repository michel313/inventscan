<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildProduct extends Model
{

    protected $table = 'childProducts';

    protected $fillable = [
        'product_id',
        'sku',
        'title',
        'unit',
        'content',
        'mainPrice',
        'secondaryPrice',
        'ean_code',
        'supplier_id',
        'category_id',
        'subcategory_id'
    ];

}
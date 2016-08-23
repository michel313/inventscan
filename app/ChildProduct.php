<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ChildProduct
 * @package App
 */
class ChildProduct extends Model
{
    /**
     * @var array $table
     */
    protected $table = 'child_products';
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'product_id',
        'sku',
        'title',
        'unit',
        'content',
        'price',
        'ean_code',
        'supplier_id',
        'category_id',
        'subcategory_id'
    ];

}
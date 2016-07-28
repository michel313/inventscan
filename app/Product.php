<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App
 */
class Product extends Model
{
    /**
     * @var array $fillable
     */
    protected $fillable = [
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

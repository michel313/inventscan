<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MergedTable
 * @package App
 */
class RememberedSuppliers extends Model
{
    protected $table = 'remembered_suppliers';
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'supplier_code',
        'sku',
        'title',
        'unit',
        'content',
        'price',
        'ean_code',
        'supplier_id',
        'category_id',
        'subcategory_id',
    ];

}
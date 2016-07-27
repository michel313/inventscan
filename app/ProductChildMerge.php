<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MergedTable
 * @package App
 */
class ProductChildMerge extends Model
{
    /**
     * @var string $table
     */
    protected $table = 'merged_table';
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'id',
        'sku',
        'title',
        'unit',
        'content',
        'price',
        'ean_code',
        'supplier_id',
        'category_id',
        'subcategory_id',
        'product_id'
    ];

    /**
     * MergedTable constructor.
     */
    public function __construct()
    {
        parent::__construct();
        \DB::select(\DB::raw("CALL getProdChild()"));
    }
}

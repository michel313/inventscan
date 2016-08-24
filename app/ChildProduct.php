<?php

namespace App;

use Illuminate\Support\Facades\DB;
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


    /**
     * method productChild
     * @param $sku
     * @return array
     */
    public function productChild($sku){

        $result = DB::select(DB::raw("SELECT * FROM ".$this->table." WHERE SUBSTRING_INDEX(`sku`,'.',1) = '{$sku}' ORDER BY id DESC"));

        return $result;
    }

    /**
     * method getChildAll
     * @return array
     */
    public static function getChildAll(){

       $result = ChildProduct::join('suppliers','child_products.supplier_id', '=' ,'suppliers.id')
            ->join('categories','child_products.category_id','=','categories.id')
            ->select('child_products.*','suppliers.title as supplier_title','categories.title as category_title')->orderBy('child_products.sku')->get();

       return $result;

    }

}
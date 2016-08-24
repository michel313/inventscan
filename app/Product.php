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



    public  static  function getAllProducts(){
        $result = Product::join('suppliers','products.supplier_id', '=' ,'suppliers.id')
            ->join('categories','products.category_id','=','categories.id')
            ->select('products.*','suppliers.title as supplier_title','categories.title as category_title')->orderBy('products.sku')->get();

        return $result;
    }
}

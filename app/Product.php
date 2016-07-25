<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['sku', 'title', 'unit', 'content', 'price', 'ean_code', 'supplier_id', 'category_id', 'subcategory_id'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Supplier
 * @package App
 */
class Supplier extends Model
{
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'title', 
        'shortcode'
    ];
}

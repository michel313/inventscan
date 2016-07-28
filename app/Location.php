<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Location
 * @package App
 */
class Location extends Model
{
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'location_id',
        'shortcode'
    ];
}

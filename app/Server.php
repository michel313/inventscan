<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Server
 * @package App
 */
class Server extends Model
{
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'location_id', 
        'type', 
        'server',
        'username', 
        'password', '
        param1',
        'param2', 
        'param3'
    ];
}

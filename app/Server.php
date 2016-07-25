<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = ['location_id', 'type', 'server', 'username', 'password', 'param1', 'param2', 'param3'];
}

<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ChildProduct
 * @package App
 */
class ExportPaths extends Model
{
    /**
     * @var array $table
     */
    protected $table = 'export_paths';
    /**
     * @var array $fillable
     */
    protected $fillable = [
        'path',
    ];

}
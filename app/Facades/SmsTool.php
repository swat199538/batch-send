<?php
/**
 * Created by PhpStorm.
 * User: 18048
 * Date: 2017/5/16
 * Time: 16:59
 */
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class SmsTool extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'SmsTool';
    }
}
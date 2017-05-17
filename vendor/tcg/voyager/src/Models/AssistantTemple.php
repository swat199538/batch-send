<?php
/**
 * Created by PhpStorm.
 * User: 18048
 * Date: 2017/5/15
 * Time: 16:56
 */
namespace TCG\Voyager\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\Translatable;

class AssistantTemple extends Model
{
    use Translatable;

    protected $table = 'as_assistant_temple';




}
<?php
/**
 * Created by PhpStorm.
 * User: 18048
 * Date: 2017/5/15
 * Time: 10:25
 */
namespace TCG\Voyager\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Traits\Translatable;

class AsCategory extends Model
{
    use Translatable;


    protected $table = 'as_category';

    protected $translatable = [
        'category_id',
        'name',
        'price',
        'price',
        'image',
        'seo_word',
        'is_hot',
        'order',
        'click_count',
        'update_at',
        'create_at',
    ];
    const PUBLISHED = 'PUBLISHED';


}
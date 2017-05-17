<?php
/**
 * Created by PhpStorm.
 * User: 18048
 * Date: 2017/5/15
 * Time: 17:00
 */
namespace TCG\Voyager\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Models\Category;
use TCG\Voyager\Models\AsCategory;

class VoyagerATController extends VoyagerBreadController
{

    public function index(Request $request)
    {
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);
        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();
        // Check permission
        Voyager::canOrFail('browse_'.$dataType->name);

        $getter = $dataType->server_side ? 'paginate' : 'get';

        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            $relationships = $this->getRelationships($dataType);

            if ($model->timestamps) {
                $dataTypeContent = call_user_func([$model->with($relationships)->latest(), $getter]);
            } else {
                $dataTypeContent = call_user_func([$model->with($relationships)->orderBy('id', 'DESC'), $getter]);
            }

            //Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType,true);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }

        foreach($dataTypeContent as $key=>$row){
            $category_id=$row->{"category_id"};
            $category = Voyager::model('asCategory')->where('id', '=', $category_id)->select('name')->get();
            $category = $this->object2array($category);
            $category_name = $category['0']['attributes']['name'];
            $content = $row->{"content"};
            if(strlen($content)>=50){
                $content = mb_substr($content,0,30);
                $content .='...';
            }
            $dataTypeContent[$key]->{"content"} = $content;
            $dataTypeContent[$key]->{"category_name"} = $category_name;
        }

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($model);

        $view = 'voyager::bread.browse';
        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }
        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable'));
    }

    public function show(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        Voyager::canOrFail('read_'.$dataType->name);

        $relationships = $this->getRelationships($dataType);
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);
            $dataTypeContent = call_user_func([$model->with($relationships), 'findOrFail'], $id);
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        //Replace relationships' keys for labels and create READ links if a slug is provided.
        $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType, true);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'voyager::bread.read';

        if (view()->exists("voyager::$slug.read")) {
            $view = "voyager::$slug.read";
        }
        $category_id = $dataTypeContent['attributes']['category_id'];
        $AsCategory = new Ascategory();
        $category = $AsCategory->where('id', '=', $category_id)->select('name')->get();
        $category = $this->object2array($category);
        $category_name = $category['0']['attributes']['name'];
        return view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable','category_name'));
    }

    function object2array($object) {
        if (is_object($object)) {
            foreach ($object as $key => $value) {
                $array[$key] = $value;
            }
        }
        else {
            $array = $object;
        }
        return $array;
    }

    function array2object($array) {

        if (is_array($array)) {
            $obj = new StdClass();

            foreach ($array as $key => $val){
                $obj->$key = $val;
            }
        }
        else { $obj = $array; }

        return $obj;
    }

}
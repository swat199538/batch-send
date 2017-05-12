<?php

namespace App\Http\Controllers\SmsAssistant;

use App\Http\Controllers\Controller;
use App\Model\category;
use Illuminate\Http\Request;
use Mockery\Exception;

class IndexController extends Controller
{

    //短信群发页面
    public function index(Request $request, category $category, $id)
    {
        $smsInfo = $category->getSmsTempleById($id);
        if ($smsInfo == null){
            return '没有数据';
        }
        echo $smsInfo->name;
    }

}

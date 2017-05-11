<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\ExcelImport;
use Illuminate\Support\Facades\Storage;
use function MongoDB\BSON\toJSON;

class ExcelController extends Controller
{

    public function upload(Request $request)
    {
        if (!$request->hasFile('file')){
            return json_encode([
                'code'=>'error',
                'msg'=>'没有上传文件'
            ]);
        }
        $file = $request->file('file');
        $suffix = $file->getClientOriginalExtension();
        if ($suffix!='xls'&&$suffix!='xlsx'){
            return json_encode([
                'code'=>'error',
                'msg'=>'文件格式错误,不想是xls或者xlsx文件'
            ]);
        }
        $page = Storage::disk('local')->putFileAs('temple', $file, time().rand(1,999).'.xlsx');
        $render = Excel::load(storage_path('app/').$page);
        Storage::disk('local')->delete($page);
        $info =$render->takeRows(100000)->toArray();
        $newData = [];
        foreach ($info as $key=>$value){
            //格式化
            $newData[] = $value[0];
        }
        //去重前长度
        $oldeCount = count($newData);
        //去重
        $newData = array_unique($newData);
        //去重后非法过滤前长度
        $newCount = count($newData);
        //重复号码
        $repeatCount = $oldeCount-$newCount;
        //过滤非法号码
        $newData = array_filter($newData, function ($k){
            if(!preg_match('/^1[34578]{1}\d{9}$/', $k)){
                return false;
            }
            return true;
        });
        //成功号码
        $successCount = count($newData);
        //非法号码
        $illegalCount = $newCount - $successCount;
        //删除临时文件
        return json_encode([
            "code"=>"success",
            "msg"=>[
                'repeat'=>$repeatCount,
                'illegal'=>$illegalCount,
                'success'=>$successCount,
                'number'=>$newData
            ]
        ]);

    }

    public function checkPhone(Request $request)
    {
        $phone = $request->input('number');
        if (empty($phone)){
            return json_encode([
                'code'=>'fail',
                'msg'=>'没有手机号码'
            ]);
        }
        $oldCount = count($phone);

        if ($oldCount > 100000){
            for ($i = 100000; $i <= $oldCount; $i++){
                unset($phone[$i]);
            }
            $oldCount = count($phone);
        }

        $phone = array_unique($phone);
        $uniqueCount = count($phone);

        $repeatCount = $oldCount - $uniqueCount;

        $phone = array_filter($phone, function ($value){
            if(!preg_match('/^1[34578]{1}\d{9}$/', $value)){
                return false;
            }
            return true;
        });

        $successCount = count($phone);

        $illegalCount = $uniqueCount - $successCount;

        return json_encode([
            'code'=>'success',
            'msg'=>[
                'success'=>$successCount,
                'illegal'=>$illegalCount,
                'repeat'=>$repeatCount,
                'phone'=>$phone
            ]
        ]);



    }

}

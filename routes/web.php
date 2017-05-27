<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['namespace'=>'SmsAssistant'], function(){

    Route::get('/', function(){
        return '我是首页';
    });

    Route::post('/send', 'IndexController@sendSms')->middleware('smsinfo');

    //新的短信群发页面
    Route::get('/qunfa/{id}', 'IndexController@index');

    //文件上传
    Route::any('/upload', 'ExcelController@upload');

    //模版Excel下载
    Route::get('/download/excel', function (){
        return response()->download(
            realpath(base_path('public/')).'/file/sms-template.xls','sms-template.xls'
        );
    });

    //查看发送记录
    Route::get('/send-log', 'IndexController@log');

    //AJAX检查手机号码格式
    Route::post('/check/phone', 'ExcelController@checkPhone');

    //获取短信
    Route::get('/assistant/{uuid}/{taskId}/{token}', 'IndexController@getGroupSms');

    //导入历史发送记录
    Route::get('/import/{id}', 'IndexController@import');

    //Ajax获取新的分类
    Route::post('/ajax/category', 'IndexController@getTemplateByCategory');

    //发送未发送记录
    Route::get('/unsent/{id}', 'IndexController@unsent');

    //未发送记录视图页面
    Route::get('/unsent', 'IndexController@unsentView');

});

Route::group(['namespace' => 'SmsTools','prefix' => 'smstool'],function(){
    Route::get('/','IndexController@index')->name('mysearch');;
    Route::get('/{cid}','IndexController@index');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

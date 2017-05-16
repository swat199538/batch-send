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

    //AJAX检查手机号码格式
    Route::post('/check/phone', 'ExcelController@checkPhone');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

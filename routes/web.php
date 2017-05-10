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

Route::get('/', function () {
    return 'hello world';
});

//老的短信群发页面
Route::get('/tool/sales', 'IndexController@index');

//新的短信群发页面
Route::get('/qunfa', 'IndexController@groupSend');


//文件上传
Route::any('/upload', 'ExcelController@upload')->middleware([
    'middleware'=>'web'
]);
<?php

namespace App\Http\Controllers\SmsAssistant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    //短信群发页面
    public function index()
    {
        return view('tool.groupSend');
    }

}

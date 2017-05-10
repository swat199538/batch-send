<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SmsTemple;

class IndexController extends Controller
{
    //显示小工具首页
    public function index(SmsTemple $smsTemple)
    {
        $templeData = $smsTemple->getTempleByCategory();
        return view('group-message.index')->with([
            'temple'=>$templeData
        ]);
    }

    //短信群发页面
    public function groupSend()
    {
        return view('tool.groupSend');
    }

}

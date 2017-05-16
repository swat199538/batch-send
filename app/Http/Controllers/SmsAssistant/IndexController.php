<?php

namespace App\Http\Controllers\SmsAssistant;

use App\Http\Controllers\Controller;
use App\Model\assistantTemple;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __construct()
    {
    }

    //短信群发页面
    public function index(assistantTemple $assistantTemple, $id)
    {
        $TempleInfo = $assistantTemple->getTempleById($id);
        if ($TempleInfo == null){
            return '没有模版';
        }
        return view('tool.groupSend')->with(['TempleInfo'=>$TempleInfo]);
    }


    //发送短信
    public function sendSms()
    {

    }

}

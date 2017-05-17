<?php

namespace App\Http\Controllers\SmsAssistant;

use App\Http\Controllers\Controller;
use App\Model\AssistantSubmitLog;
use App\Model\assistantTemple;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private $uuid = '';

    public function __construct(Request $request)
    {
        $this->uuid = $request->cookie('uuid');
        if($this->uuid == null){
            setcookie('uuid', md5(time().rand(10000,99999)), time()+3600*168, '/');
        }
    }

    //短信群发页面
    public function index(assistantTemple $assistantTemple, $id)
    {
        $TempleInfo = $assistantTemple->getTempleById($id);
        if ($TempleInfo == null){
            return '没有此模版';
        }
        return view('tool.groupSend')->with(['TempleInfo'=>$TempleInfo]);
    }


    //发送短信
    public function sendSms(Request $request, AssistantSubmitLog $assistantSubmitLog, assistantTemple $assistantTemple)
    {
        $numbers = json_encode(explode("\r\n", $request->input('numbers')));
        $content = '['.$request->input('signature').']'.$request->input('content');
        $template = $request->input('id');
        $category = $assistantTemple->getCategory($template);
        $taskId = md5($this->uuid.time());

        if ($assistantSubmitLog->saveNewSubmitLog($this->uuid, $numbers, $content, $category, $template, $taskId)){
            $url = "http://www.smsbao.com/member/sms/assistant_send.jhtml?uuid=".$this->uuid."&taskId=".$taskId;
            return redirect()->away($url);
        } else{
            return back()->withInput()->withErrors(['msg'=>'提交失败']);
        }

    }

    public function getGroupSms($uuid, $taskid, $token, AssistantSubmitLog $assistantSubmitLog)
    {
        if ($token != 'dxb2048'){
            return response()->json(['code'=>'1']);
        }

        $info = $assistantSubmitLog->getTaskByTaskIdAndUuid($uuid, $taskid);

        return response()->json($info);

    }

}

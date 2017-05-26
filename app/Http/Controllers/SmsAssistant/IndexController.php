<?php

namespace App\Http\Controllers\SmsAssistant;

use App\Http\Controllers\Controller;
use App\Model\AssistantSubmitLog;
use App\Model\assistantTemple;
use App\Model\category;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    private $uuid = '';

    public function __construct(Request $request)
    {
        $this->uuid = $request->cookie('uuid');
        if($this->uuid == null){
            $cookieValue = md5(time().rand(10000,99999));
            setcookie('uuid', $cookieValue, time()+3600*168, 'smsbao.com');
            $this->uuid = $cookieValue;
        }
    }

    //短信群发页面
    public function index(AssistantSubmitLog $assistantSubmitLog,assistantTemple $assistantTemple, category $category,$id)
    {
        $TempleInfo = $assistantTemple->getTempleById($id);
        if ($TempleInfo == null){
            return '没有此模版';
        }
        $info = $assistantSubmitLog->getLogInfoByuuid($this->uuid);
        $template = $assistantTemple->getTempleByCategory($TempleInfo->category_id, 1);
        $unsent = $assistantSubmitLog->getUnsentLogByUuid($this->uuid);
        $unsentCount =count($unsent);
        setcookie('unsent', $unsentCount, time()+3600*168, '.smsbao.com');
        $assistantTemple->increment('click_count');
        return view('tool.groupSend')->with([
            'TempleInfo'=>$TempleInfo,
            'template'=>$template,
            'category'=>$category->all()->toArray(),
            'info'=>$info,
            'unsent'=>$unsent,
            'unsentCount'=>$unsentCount
        ]);
    }


    //发送短信
    public function sendSms(Request $request, AssistantSubmitLog $assistantSubmitLog, assistantTemple $assistantTemple)
    {
        $numbers = json_encode(explode("\r\n", $request->input('numbers')));
        $content = '【'.$request->input('signature').'】'.$request->input('content');
        $template = $request->input('id');
        $category = $assistantTemple->getCategory($template);
        $taskId = md5($this->uuid.time());

        if ($assistantSubmitLog->saveNewSubmitLog($this->uuid, $numbers, $content, $category, $template, $taskId)){
            $url = "http://tuser.smsbao.com/member/sms/send_assistant.jhtml?uuid=".$this->uuid."&taskId=".$taskId;
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


    public function log(AssistantSubmitLog $assistantSubmitLog)
    {
        $info = $assistantSubmitLog->getLogInfoByuuid($this->uuid);
        return view('tool.content.log')->with(['info'=>$info]);
    }

    public function import($id, AssistantSubmitLog $assistantSubmitLog, assistantTemple $assistantTemple, category $category)
    {
        $info = $assistantSubmitLog->getImpoerInfo($id, $this->uuid);
        if (!$info == null){
            //整理短信内容
            $content = $info->content;
            preg_match('/^【(?<signature>.*?)】/', $content, $signature);
            preg_match('/】(?<content>.*)$/', $content, $content);
            $signature = $signature['signature'];
            $content = $content['content'];
            //整理号码
            $phones = json_decode($info->phone, true);
            $number = '';
            foreach ($phones as $key=>$value){
                $number.=$value."\r\n";
            }
            $data = [
                'phone'=>$number,
                'content'=>$content,
                'signature'=>$signature,
                'obj'=>$info
            ];

            $template = $assistantTemple->getTempleByCategory($data['obj']->category_id, 1);
            $info2 = $assistantSubmitLog->getLogInfoByuuid($this->uuid);
            $unsent = $assistantSubmitLog->getUnsentLogByUuid($this->uuid);
            $unsentCount =count($unsent);
            setcookie('unsent', $unsentCount, time()+3600*168, '.smsbao.com');

            return view('tool.importSend')->with([
                'TempleInfo'=>$data,
                'template'=>$template,
                'category'=>$category->all()->toArray(),
                'info'=>$info2,
                'unsent'=>$unsent,
                'unsentCount'=>$unsentCount
            ]);

        } else{
            back();
        }
    }

    public function getTemplateByCategory(Request $request, assistantTemple $assistantTemple)
    {
        $category = $request->input('category');
        $page = $request->input('current');
        $response = $assistantTemple->getTempleByCategory($category, $page);
        return json_encode($response);
    }

    public function unsent($id, AssistantSubmitLog $assistantSubmitLog)
    {
        $info = $assistantSubmitLog->getUnsentAssignLog($this->uuid, $id);
        if (!null){
            $url = "http://tuser.smsbao.com/member/sms/send_assistant.jhtml?uuid=".$info->uuid."&taskId=".$info->task_id;
            return redirect()->away($url);
        }else{
            return '无效操作';
        }
    }

}

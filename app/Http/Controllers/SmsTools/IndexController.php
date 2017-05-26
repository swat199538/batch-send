<?php

namespace App\Http\Controllers\SmsTools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TCG\Voyager\Facades\Voyager;


class IndexController extends Controller
{
    public function __construct(Request $request)
    {
        $this->Request = $request;
    }


    public function index()
    {
        $cid=$this->Request->cid;
        if($cid==null){
            $search=$this->Request->search;
            $category = (object) array('name'=>$search);
            $temple = Voyager::model('AssistantTemple')->where('tag','like',"%$search%")->paginate(12);
            $topSms = $temple;
        }else{
            $category = Voyager::model('AsCategory')->whereNotIn('status',[2])->find($cid);
            Voyager::model('AsCategory')->increment('click_count');
            $temple = Voyager::model('AssistantTemple')->where('category_id',$cid)->paginate(12);
            $topSms = $this->topSms($cid);
            $search = '';
        }
        $Tool = Voyager::model('AsCategory')->whereNotIn('status',[2])->get();
        $topTool = Voyager::model('AsCategory')->whereNotIn('status',[2])->orderBy('order','desc')->limit(5)->get();
        foreach($temple as $key=>$row){
            $content = $row->{"content"};
            if(strlen($content)>=50){
                $content = mb_substr($content,0,60);
                $content .='...';
            }
            $temple[$key]->{"content"} = $content;
        }
        return view('tool.content.tools')->with(['category'=>$category,'temple'=>$temple,'topSms'=>$topSms,'topTool'=>$topTool,'tool'=>$Tool,'search'=>$search]);
    }

    public function topSms($cid){
        $topSms = Voyager::model('AssistantTemple')->where('category_id',$cid)->orderBy('click_count')->limit(10)->get();
        foreach($topSms as $key=>$row){
            $content = $row->{"content"};
            if(strlen($content)>=50){
                $content = mb_substr($content,0,200);
            }
            $topSms[$key]->{"content"} = $content;
        }
        return $topSms;
    }
}

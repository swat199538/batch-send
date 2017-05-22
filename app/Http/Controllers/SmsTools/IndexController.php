<?php

namespace App\Http\Controllers\SmsTools;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TCG\Voyager\Facades\Voyager;


class IndexController extends Controller
{
    public function __construct()
    {
    }

    public function show(){
        $topTool = Voyager::model('AsCategory')->orderBy('click_count','desc')->limit(5)->get();
        $topSms = $this->topSms();
        return view('tool.content.toolCategory')->with(['topSms'=>$topSms,'topTool'=>$topTool]);
    }

    public function index($cid)
    {
        $category = Voyager::model('AsCategory')->whereRaw('status =? or status =?',['1','0'])->find($cid);
        Voyager::model('AsCategory')->increment('click_count');
        $temple = Voyager::model('AssistantTemple')->where('category_id',$cid)->get();
        $topTool = Voyager::model('AsCategory')->orderBy('click_count','desc')->limit(5)->get();
        $topSms = $this->topSms();
        foreach($temple as $key=>$row){
            $content = $row->{"content"};
            if(strlen($content)>=50){
                $content = mb_substr($content,0,60);
                $content .='...';
            }
            $temple[$key]->{"content"} = $content;
        }
        return view('tool.content.tools')->with(['category'=>$category,'temple'=>$temple,'topSms'=>$topSms,'topTool'=>$topTool]);
    }

    public function topSms(){
        $topSms = Voyager::model('AssistantTemple')->orderBy('click_count')->limit(10)->get();
        foreach($topSms as $key=>$row){
            $content = $row->{"content"};
            if(strlen($content)>=50){
                $content = mb_substr($content,0,30);
                $content .='...';
            }
            $topSms[$key]->{"content"} = $content;
        }
        return $topSms;
    }
}

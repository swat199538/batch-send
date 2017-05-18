<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AssistantSubmitLog extends Model
{
    protected $table="as_assistant_submit_log";

    public function saveNewSubmitLog($uuid,$phone,$content, $category, $template, $taskId)
    {
        $this->uuid = $uuid;
        $this->phone = $phone;
        $this->content = $content;
        $this->category_id=$category;
        $this->template_id=$template;
        $this->task_id= $taskId;
        return $this->save();
    }

    public function getTaskByTaskIdAndUuid($uuid, $taskId)
    {
        $data = $this->where([
            ['uuid', '=', $uuid],
            ['task_id', '=', $taskId]
        ])->first();

        if ($data == null){
            return ['code'=>2];
        }

        if ($data->is_request == 0){
            $mobiles = json_decode($data->phone, true);
            $info = ['code'=>0, 'data'=>['mobiles'=>$mobiles, 'content'=>$data->content]];
            $this->where([['uuid', '=', $uuid], ['task_id', '=', $taskId]])->update(['is_request'=>1]);
            return $info;
        } else{
            return ['code'=>3];
        }

    }

    public function category()
    {
        return $this->belongsTo('App\Model\category', 'category_id', 'id');
    }

    public function getLogInfoByuuid($uuid)
    {
        $info = $this->with('category')->where([['uuid', '=', $uuid]])->get();
        if ($info->isEmpty()){
            return null;
        } else{
            return $info->toArray();
        }
    }

    public function getImpoerInfo($id, $uuid)
    {
        return $this->where([['id', '=', $id], ['uuid', '=', $uuid]])->first();
    }

}

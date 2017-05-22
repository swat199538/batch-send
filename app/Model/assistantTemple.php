<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class assistantTemple extends Model
{
    protected $table = 'as_assistant_temple';

    public function getTempleById($id)
    {
        return parent::find($id);
    }

    public function getCategory($id)
    {
        $obj = parent::find($id);
        return $obj->category_id;
    }

    public function getTempleByCategory($category, $page,$pageSize = 5)
    {
        //总记录说
        $count = $this->where('category_id', '=', $category)->count();
        //总页数
        $totalPage = (int)(($count + $pageSize -1)/$pageSize)   ;


        //指定页数数据
        $data = $this->where('category_id', '=', $category)
            ->offset(($page-1)*$pageSize)->limit($pageSize)->get()->toArray();

        if ($page <= 1){
            $leftPage = 1;
        } else{
            $leftPage = $page -1;
        }

        if ($page >= $totalPage){
            $rightPage = $totalPage;
        } else{
            $rightPage = $page + 1;
        }

        return [
            'total'=>$count,
            'totalPage'=>$totalPage,
            'currentPage'=>$page,
            'data'=>$data,
            'leftPage'=>$leftPage,
            'rightPage'=>$rightPage
        ];
    }

}

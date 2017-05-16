<?php
namespace App\Services;

use Illuminate\Http\Request;
use App\Model\assistantSession;

class TempleUserServices
{
    public function getIdBySession(Request $request, assistantSession $assistantSession)
    {
        $session = $request->cookie('');

        if ($session == null){
            //没有cookie，直接跳到选择模版页面
            return redirect()->route('test');
        }

        $id = $assistantSession->getIdBySession($session);

        if ($id == null){
            return $this->setId($request, $assistantSession);
        } else{
            return $id;
        }


    }

    public function setId(Request $request, assistantSession $assistantSession)
    {
        $assistantSession->session = $request->cookie('QRBS');
        return $assistantSession->save();
    }

}
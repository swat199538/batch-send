<?php

namespace App\Http\Middleware;

use Closure;

class VerifySmsInfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //验证手机号码
        $phone = explode("\r\n", $request->input('numbers'));


        if (empty($phone)){
            return back()->withInput()->withErrors(['phoneError'=>'手机号不能为空']);
        }

        if (count($phone) > 50000){
            return back()->withInput()->withErrors(['phoneError'=>'手机号太多了']);
        }

        foreach ($phone as $key=>$value){
            if (!preg_match('/^1[34578]{1}\d{9}$/', $value)){
                return back()->withInput()->withErrors(['signatureError'=>'格式错误']);
            }
        }

        //验证签名
        $signature = $request->input('signature');
        if (empty($signature)){
            return back()->withInput()->withErrors(['signatureError'=>'签名不能为空']);
        }

        //验证内容
        $content = $request->input('content');
        if (empty($content)){
            return back()->withInput()->withErrors(['content'=>'内容不能为空']);
        }

        //验证内容长度
        if (count($signature)+count($content) > 325){
            return back()->withInput()->withErrors(['content'=>'文本内容太长']);
        }

        return $next($request);
    }
}

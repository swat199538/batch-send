<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>营销短信群发</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/common.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/right_menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/tools.css')}}">
    <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>
<div class="wrapper">
    <div class="top-bar ">
        <div class="webContainer">
            <div class="top-box">
                <ul class="contact-bar">
                    <li class="tel last">400-716-3021</li>
                </ul>
                <ul id="current_member" class="user-bar" style="float:right">
                    <li class="active first"><a title="短信宝用户登入" href="/login">登录</a></li>
                    <li class="last"><a title="短信宝用户注册" href="/reg">注册</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="nav">
        <div class="nav_main">
            <div class="nav_main_div"><a title="短信宝短信平台" href="/"><img src="http://www.smsbao.com/images/logo.png" alt="短信宝短信平台"></a></div>
            <ul class="nav_main_ul_one">
                <li class="nav_item"><a title="短信宝首页" href="/">首 页</a></li>
                <li class="nav_item show_column">
                    <a href="javascript:void(0);">黑板报</a>
                    <ul class="columnShow-inline" style="display: none; width: 100px; position: absolute; top: 60px; z-index: 200; overflow: hidden; border-top: none; border-right: 1px solid rgb(238, 238, 238); border-bottom: 1px solid rgb(238, 238, 238); border-left: 1px solid rgb(238, 238, 238); border-image: initial;">
                        <li>
                            <h3><a title="短信谁在用" href="/buzz" target="_blank">谁 在 用</a></h3>
                        </li>
                        <li>
                            <h3><a title="干货分享" href="/application" target="_blank">干货分享</a></h3>
                        </li>
                    </ul>
                </li>
                <li class="nav_item"><a title="使用指南" href="/help" class="navCur">使用指南</a></li>
                <li class="nav_item"><a title="短信接口" href="/openapi">短信接口</a></li>
                <li class="nav_item"><a title="短信插件" href="/plugin">建站插件</a></li>
                <!--<li class="nav_item"><a title="合作联盟" href="/joinin">合作联盟</a></li>-->
                <li class="nav_item"><a title="短信价格查询" href="/fee">资费标准</a></li>
            </ul>
        </div>
    </div>
    <div class="main-box">
        <div class="index-banner height150">
            <div class="banner height150" alt="0" style="background-image: url(http://www.smsbao.com/style_sb/images/new_banner_bg.png); background-position: 50% 50%; background-repeat: initial initial;"></div>
            <div class="tool-wrapper">
                <div class="left-phone">
                    <div class="phone-number">
                        <h2>接收短信号码</h2>
                        <hr>
                        <ul id="phone-numbers">
                        </ul>
                    </div>
                    <div class="import-number">
                        <div class="copy-number">
                            <p class="mt">粘贴号码</p>
                            <textarea id="paste_content" style="height: 100px; width: 200px"></textarea>
                        </div>
                        <div class="file-import">
                            <button id="paste">粘贴</button>
                            <button>excel导入</button>
                            <button>txt导入</button>
                            <input style="display: none" type="file">
                            <input  style="display: none" type="file">
                        </div>
                    </div>
                </div>
                <div class="message">
                    <div class="notice">
                        <h2>短信群发使用说明</h2>
                        <p>1.批量粘导入号码时，每个号码之间确保换行</p>
                        <p>1.excel导入号码时，每个号码之间确保换行</p>
                        <p>1.批量粘导入号码时，每个号码之间确保换行</p>
                    </div>
                    <div class="message-temple">
                        <h2>短信内容模版</h2>
                        <div class="op-minifilter-main">

                            <table class="c-table op-imprecise-main">
                                <tbody>
                                @foreach($temple as $value)
                                    <tr>
                                        <td>
                                            <div class="op-imprecise-ieposition" style="z-index:4"><div id="temple-{{$value->id}}" class="op-imprecise-left">{{$value->content}}</div>
                                                <div class="op-imprecise-right">
                                                    <span data-temple="{{$value->id}}" class="use-temple">[使用此模版]</span>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="message-edit">
                        <div class="content">
                            <textarea id="sms-content" style="height: 100px;width: 790px;"></textarea>
                            <button>群发短信</button>
                        </div>
                    </div>
                    <form enctype="multipart/form-data" action="{{url('upload')}}" method="post">
                        {{csrf_field()}}
                        <input id="file" name="file" type="file" >
                        <input type="submit" value="提交">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //去重函数
    function removeDuplicatedItem(ar)
    {
        var ret = [];
        ret[0] = [];
        ret[1] = [];
        for (var i = 0, j = ar.length; i < j; i++) {
            if (ret[0].indexOf(ar[i]) === -1) {
                ret[0].push(ar[i]);
            } else{
                ret[1].push(ar[i]);
            }
        }
        return ret;
    }


    //使用短信模版
    $(".use-temple").on('click', function () {
        var id = "#temple-"+$(this).data('temple');
        var content = $(id).text();
        $("#sms-content").val(content);
    });

    //粘贴导入短信号码
    $("#paste").on('click', function () {
        var numbers = $("#paste_content").val();
        numbers = numbers.split('\n');
        var error = [];
        var dom = '';

        //去重
        var info = removeDuplicatedItem(numbers)
        if (info[1].length != 0){
            numbers = info[0];
        }
        console.log(info);

        for (var x in numbers){
            if(!(/^1[3|4|5|8][0-9]\d{4,8}$/.test(numbers[x]))){
                error.push(numbers[x]);
            }
            dom += '<li><span>'+numbers[x]+'</span>&nbsp;<span class="del">删除</span></li>';
        }
        if(error.length == 0){
            $("#phone-numbers").prepend(dom);
            //删除短信号码
            $(".del").on('click', function () {
                $(this).parent().remove();
            });
            $("#paste_content").val('');
            if (info[1].length != 0){
                var msg = '';
                for (var x in info[1]){
                    msg += info[1][x]+'\n';
                }
                alert(msg+'这些号码有重复已自动去重');
            }
        } else {
            var msg = '';
            for (var x in error){
                msg += error[x]+'\n';
            }
            alert(msg+'不是有效的手机号码');
        }
    });

    //删除短信号码
    $(".del").on('click', function () {
        $(this).parent().remove();
    });

</script>
</body>
</html>
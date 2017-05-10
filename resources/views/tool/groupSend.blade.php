<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>营销短信群发</title>
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/common.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/right_menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/tools2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/fileinput.min.css')}}">
    <script src="http://apps.bdimg.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="{{URL::asset('/js/ajaxfileupload.js')}}"></script>
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
                <div class="tool-box">
                    <div class="sms-content">
                        <form >
                            <div class="group-sms">
                                <div class="left">
                                    <label class="title">短信模版</label>
                                </div>
                                <div class="right">
                                    <a class="btn-style">其他模版</a>
                                </div>
                            </div>

                            <div class="group-sms">
                                <div class="left">
                                    <label class="title">接收号码</label>
                                </div>
                                <div class="right">
                                    <form id="fileData" enctype="multipart/form-data">
                                        <input style="display: none;" name="file" type="file" id="excel_file">
                                    </form>
                                    <a id="importBtn" class="btn-style">导入号码</a>
                                    <a href="" class="download">下载号码模版</a>
                                    <div id="receive-area" class="receive-area">
                                        <textarea id="phone-numbers" placeholder="例如：18889462200，1586208020   每个号码以英文“,”号分隔" id="receive-phone" class="receive-text"></textarea>
                                        <p class="word-count"><span>0</span>/10000</p>
                                    </div>
                                    <p class="input-info"><span class="notice-icon"></span>最多<span>10000</span>个，成功<span id="success-count">0</span>个，<span id="repeat-count">0</span>个重复，<span id="error-count">0</span>个格式错误</p>
                                </div>
                            </div>

                            <div class="group-sms">
                                <div class="left">
                                    <label class="title">短信内容</label>
                                </div>
                                <div class="right">
                                    <div class="receive-area" style="position: relative">
                                        <div class="auto-graph">
                                            <span class="flt-1">[</span>
                                            <input id="signature" class="flt-1 auto-graph-input" value="请输入签名" type="text">
                                            <span class="flt-1">]</span>
                                        </div>
                                        <textarea id="msg-content" style="text-indent:85px;line-height: 31px; " placeholder="请输入短信内容" class="receive-text"></textarea>
                                    </div>
                                    <p class="input-info"><span class="notice-icon"></span>已输入<span id="wordCount">7</span>字,最多325字(含签名),拆分为<span id="msgCount"></span>条短信</p>
                                    <p><a id="check-phone" class="btn-style">检查号码</a><a class="btn-style">发送</a></p>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="sms-preview">
                        <div class="preview-wrapper">
                            <div class="img-model">
                                <div class="bubble">
                                    <div class="talk">【<span id="signature-view"></span>】<span id="content-view"></span></div>
                                </div>
                            </div>
                            <p class="preview-info">内容预览</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    //样式JS
    $('.receive-text').on('focus', function () {
        $(this).parent().addClass('focus');
    });
    $('.receive-text').on('blur', function () {
        $(this).parent().removeClass('focus');
    });

    $("#signature-view").text($("#signature").val());
    $("#content-view").text($("#msg-content").val());

    function resetWidth($obj) {
        var text = $obj.val().length;
        var current = parseInt(text)*14;
        if (current === 0){
            current = 14;
        } else if (current > 111){
            current = 111
        }
        $obj.css('width', current+'px');
        $("#msg-content").css('text-indent', current+14+'px');
    }

    function countWord()
    {
        var sign = $("#signature").val().length+2;
        var content = $("#msg-content").val().length;
        var wordCount = sign+content;
        var msgCount = parseInt(wordCount / 64) + 1;
        console.log(msgCount);
//        console.log('字数:'+wordCount+'拆分条数:'+msgCount);
        $("#msgCount").text(msgCount);
        $("#wordCount").text(wordCount);
    }
    
    $("#signature").on('focus', function () {
       var info = $(this).val();
       if (info == '请输入签名'){
           $(this).val('');
           resetWidth($(this));
       }
    });
    $("#signature").on('keyup', function () {
        var text = $(this).val();
        if (text.length > 9){
            text = text.substring(0, 8);
            $(this).val(text);
        }
        resetWidth($(this));
        countWord();
    });
    $("#signature").on('blur', function () {
       var text = $(this).val();
       if (text == ''){
           $(this).val('请输入签名');
           resetWidth($(this));
       }
       $("#signature-view").text($(this).val());
    });

    $("#msg-content").on('blur', function () {
       $("#content-view").text($(this).val());
        countWord();
    });

    $("#check-phone").on('click', function () {
       var numbers = $("#phone-numbers").val().split('\n');
       console.log(numbers);
       //var noRepeatNumber = [];
       var trueNumers = [];
       var error = 0;
       var repeat = 0;
        //去重和检查格式
        for (var i=0; i< numbers.length; i++){
            if (trueNumers.indexOf(numbers[i]) === -1){
                if((/^1[34578]{1}\d{9}$/.test(numbers[i]))){
                    trueNumers.push(numbers[i]);
                } else {
                    error ++;
                }
            } else {
                repeat ++;
            }
        }

       var trueDome = '';

       for (var i in  trueNumers){
           trueDome += trueNumers[i]+'\n';
       }
        $("#phone-numbers").val(trueDome);
        $("#success-count").text(trueNumers.length);
        $("#error-count").text(error);
        $("#repeat-count").text(repeat);


    });

    $("#importBtn").click(function () {
        $("#excel_file").click();
    });

    $("#excel_file").change(function () {
        var formData = new FormData();
        formData.append('file', $("#excel_file")[0].files[0]);
        formData.append('_token', '{{csrf_token()}}');
        $.ajax({
            url: '{{url('upload')}}',
            type: 'POST',
            cache: false,
            data: formData,
            processData: false,
            contentType: false
        }).done(function(data) {
            data = $.parseJSON(data);
            if (data['code'] == 'fail'){
                alert(data['msg']);
            } else {
                    var phone = '';
                    for (var i in data['msg']['number']){
                        phone += data['msg']['number'][i]+'\n';
                    }
                    var old = $("#phone-numbers").val();
                    $("#phone-numbers").val(old+phone);
            }
        }).fail(function() {
            alert('文件上传失败！');
        });
    });

</script>
</body>
</html>
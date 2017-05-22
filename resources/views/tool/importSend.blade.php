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
    <script src="{{URL::asset('/plugin/layer/layer.js')}}"></script>
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
                        <form id="fileData" enctype="multipart/form-data">
                            <input style="display: none;" name="file" type="file" id="excel_file">
                        </form>
                        <form id="sendInfo" action="{{url('/send')}} " method="post">
                            <input id="tid" type="hidden" name="id" value="{{$TempleInfo['obj']->id}}">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">

                            <div class="group-sms">
                                <label class="title">接收号码</label>
                                <div id="receive-area" class="receive-area">
                                    <textarea name="numbers" id="phone-numbers" placeholder="一行为一个号码" id="receive-phone" class="receive-text">{{$TempleInfo['phone']}}</textarea>
                                    <p class="word-count"><span id="countWord">0</span>/50000</p>
                                </div>
                                <p class="input-info"><span class="notice-icon"></span>最多<span>50000</span>个号码
                            </div>

                            <div class="group-sms">
                                <label class="title">短信内容</label>
                                <div class="receive-area" style="position: relative">
                                    <div class="auto-graph">
                                        <span class="flt-1">[</span>
                                        <input name="signature" id="signature" class="flt-1 auto-graph-input" value="{{$TempleInfo['signature']}}" type="text">
                                        <span class="flt-1">]</span>
                                    </div>
                                    <textarea name="content" id="msg-content"  style="text-indent:85px;line-height: 31px; " placeholder="请输入短信内容" class="receive-text">{{$TempleInfo['content']}}</textarea>
                                </div>
                                <p class="input-info"><span class="notice-icon"></span>已输入<span id="wordCount"></span>字,最多325字(含签名),拆分为<span id="msgCount"></span>条短信</p>
                                {{--<p class="input-info"><span class="notice-icon"></span>--}}
                                {{--<span id="chieck_info">输入检查成功后才可发送短信</span>--}}
                                {{--</p>--}}
                                <p>{{--<a id="check-phone" class="btn-style">输入检查</a>--}}<a id="sendSms" class="btn-style">发送</a></p>
                            </div>

                        </form>
                    </div>
                    <div class="sms-preview">
                        <div class="more-template">
                            <div class="template-title">短信群发助手</div>
                            <div class="template-category">
                                <span>分类：</span>
                                @foreach($category as $key=>$value)
                                    @if($value['id'] == $TempleInfo['obj']->category_id)
                                        <span data-category="{{$value['id']}}" class="pointer current-category">{{$value['name']}}</span>
                                    @else
                                        <span data-category="{{$value['id']}}" class="pointer">{{$value['name']}}</span>
                                    @endif
                                @endforeach
                            </div>
                            <div class="template-content">
                                <table class="template-table">
                                    @foreach($template['data'] as $key=>$value)
                                        <tr>
                                            <td>
                                                <div>
                                                    <div id="sms-{{$value['id']}}" class="tfl">{{$value['content']}}</div>
                                                    <div data-id="{{$value['id']}}" class="tfr">[使用]</div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <div class="template-paging">
                                <p>
                                    <span id="first" class="pb page-button" data-category="{{$TempleInfo['obj']->category_id}}" data-current="1">首页</span>
                                    <span id="back" class="pb page-button" data-category="{{$TempleInfo['obj']->category_id}}" data-current="1">上一页</span>
                                    <span id="next" class="pb page-button" data-category="{{$TempleInfo['obj']->category_id}}" data-current="2">下一页</span>
                                    <span id="last" class="pb page-button" data-category="{{$TempleInfo['obj']->category_id}}" data-current="{{$template['totalPage']}}">尾页</span>
                                    <span>当前页：<span id="currentPage">{{$template['currentPage']}}</span></span>
                                    <span>总页数：<span id="totalPage">{{$template['totalPage']}}</span></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tool-wrapper">
                <div class="tool-box2">
                    <h3>历史发送记录</h3>
                    <table class="gridtable">
                        @if($info != null)
                            <tr>
                                <th>助手</th>
                                <th>发送内容</th>
                                <th>发送时间</th>
                                <th>发送号码数量</th>
                                <th>发送金额</th>
                                <th>操作</th>
                            </tr>
                            @foreach($info as $key=>$value)
                                <tr>
                                    <td>{{$value['category']['name']}}</td>
                                    <td>{{$value['content']}}</td>
                                    <td>{{$value['created_at']}}</td>
                                    <td>{{count(json_decode($value['phone'], true))}}个号码</td>
                                    <td>￥{{count(json_decode($value['phone'], true))*$value['category']['price']}}</td>
                                    <td style="cursor: pointer;"><a href="{{url('/import', ['id'=>$value['id']])}}">再次发送</a></td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    //选择分类对象
    var selectCategory = {
        //选择器
        el:".pointer",
        //变化的class
        class:"current-category",
        //选择的dataName
        dataSource:'category',
        //ajaxUrl
        url:'',
        //令牌
        token:'',
        isAjax:false,
        //ajax结果回来后执行的动作
        action: function (data, category) {
            data = $.parseJSON(data);
            console.log(category);
            $("#currentPage").text(data['currentPage']);
            $("#totalPage").text(data['totalPage']);
            $("#first").data('category', category);
            $("#last").data('category', category);
            $("#back").data('current', data['leftPage']);
            $("#back").data('category', category);
            $("#next").data('current', data['rightPage']);
            $("#next").data('category', category);
            $("#last").data('current', data['totalPage']);
            var dom = '';
            for(var i in data['data']){
                dom += '<tr>'+
                    '<td>'+
                    '<div>'+
                    '<div id="sms-'+data["data"][i]['id']+'" class="tfl">'+
                    data['data'][i]['content']+
                    '</div>'+
                    '<div data-id="'+data["data"][i]['id']+'" class="tfr">[使用]</div>'+
                    '</div>'+
                    '</td>'+
                    '</tr>';
            }
            $(".template-table").empty();
            $(".template-table").append(dom);
            bindSmsContent();
        },
        //样式变化
        style:function (thisObj) {
            $(selectCategory.el).removeClass(selectCategory.class);
            $(thisObj).addClass(selectCategory.class)
        },
        //生成AJAX数据
        createData:function (thisObj) {
            var category = $(thisObj).data(selectCategory.dataSource);
            return {
                '_token':selectCategory.token,
                'category':category,
                'current':1
            }
        },
        //开始方法
        start:function () {
            $(selectCategory.el).on('click', function () {
                selectCategory.style(this);
                if(!selectCategory.isAjax){
                    selectCategory.isAjax = true;
                    var category2 = $(this).data(selectCategory.dataSource);
                    $.post(
                        selectCategory.url,
                        selectCategory.createData(this)
                        , function (data) {
                            selectCategory.isAjax = false;
                            selectCategory.action(data, category2);
                        }
                    );
                }
            })
        }
    }

    selectCategory.url = '{{url('/ajax/category')}}';
    selectCategory.token = '{{csrf_token()}}';
    selectCategory.start();

    //选择分类对象
    var page = {
        //选择器
        el:".pointer",
        //变化的class
        class:"current-category",
        //选择的dataName
        dataSource:'category',
        //ajaxUrl
        url:'',
        //令牌
        token:'',
        isAjax:false,
        //ajax结果回来后执行的动作
        action: function (data) {
            data = $.parseJSON(data);
            $("#currentPage").text(data['currentPage']);
            $("#totalPage").text(data['totalPage']);
            $("#back").data('current', data['leftPage']);
            $("#next").data('current', data['rightPage']);
            var dom = '';
            for(var i in data['data']){
                dom += '<tr>'+
                    '<td>'+
                    '<div>'+
                    '<div id="sms-'+data["data"][i]['id']+'" class="tfl">'+
                    data['data'][i]['content']+
                    '</div>'+
                    '<div data-id="'+data["data"][i]['id']+'" class="tfr">[使用]</div>'+
                    '</div>'+
                    '</td>'+
                    '</tr>';
            }
            $(".template-table").empty();
            $(".template-table").append(dom);
            bindSmsContent();
        },
        //样式变化
        style:function (thisObj) {
        },
        //生成AJAX数据
        createData:function (thisObj) {
            var category = $(thisObj).data('category');
            var current = $(thisObj).data('current');
            return {
                '_token':page.token,
                'category':category,
                'current':current
            }
        },
        //开始方法
        start:function() {
            $(page.el).on('click', function () {
                page.style(this);
                if(!page.isAjax){
                    page.isAjax = true;
                    $.post(
                        page.url,
                        page.createData(this)
                        , function (data) {
                            page.isAjax = false;
                            page.action(data, this);
                        }
                    );
                }
            })
        }
    }
    page.el = '.pb';
    page.url = '{{url('/ajax/category')}}';
    page.token = '{{csrf_token()}}';
    page.start();

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

    $("#signature").on(
        {
            'click':function () {
                if($(this).val() == '请输入签名'){
                    $(this).val('');
                }
            },
            'blur':function () {
                if($(this).val() == ''){
                    $(this).val('请输入签名');
                } else {
                    resetWidth($(this));
                }
            }
        }
    );

    function bindSmsContent() {
        $(".tfr").on('click', function () {
            var id = $(this).data('id');
            var smsContent = $("#sms-"+id).text();
            $("#msg-content").val(smsContent);
            $("#tid").val(id);
        });
    }

    bindSmsContent();

    //发送
    $("#sendSms").on('click', function () {
        var signature = $("#signature").val();
        var content = $("#msg-content").val();
        layer.open({
            type: 1,
            area: ['450px', '610px'], //宽高
            content:
            '<div class="preview-wrapper">'+
            '<div class="img-model">'+
            '<div class="bubble">'+
            '<div class="talk">【<span id="signature-view">'+signature+'</span>】<span id="content-view">'+content+'</span></div>'+
            '</div>'+
            '</div>'+
            '<p class="preview-info">内容预览</p>'+
            '<p id="submitSms" style="margin-left: 46px; cursor:pointer;"  class="btn-style">确认发送</p>'+
            '</div>'
        });

        $("#submitSms").on('click', function () {
            $("#sendInfo").submit();
        });

    });

</script>
</body>
</html>
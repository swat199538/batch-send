<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    @yield('title')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('/css/common.css')}}">
    @yield('css')
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
                    <li class="wfs"></li>
                    <li class="active first"><a title="短信宝用户登入" href="http://twww.smsbao.com/login">登录</a></li>
                    <li class="last"><a title="短信宝用户注册" href="http://twww.smsbao.com/login">注册</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div id="nav">
        <div class="nav_main">
            <div class="nav_main_div"><a title="短信宝短信平台" href="http://twww.smsbao.com/"><img src="http://www.smsbao.com/images/logo.png" alt="短信宝短信平台"></a></div>
            <ul class="nav_main_ul_one">
                <li class="nav_item"><a title="短信宝首页" href="http://twww.smsbao.com/">首 页</a></li>
                <li class="nav_item show_column">
                    <a href="javascript:void(0);">黑板报</a>
                    <ul class="columnShow-inline" style="display: none; width: 100px; position: absolute; top: 60px; z-index: 200; overflow: hidden; border-top: none; border-right: 1px solid rgb(238, 238, 238); border-bottom: 1px solid rgb(238, 238, 238); border-left: 1px solid rgb(238, 238, 238); border-image: initial;">
                        <li>
                            <h3><a title="短信谁在用" href="http://twww.smsbao.com/buzz" target="_blank">谁 在 用</a></h3>
                        </li>
                        <li>
                            <h3><a title="干货分享" href="http://twww.smsbao.com/application" target="_blank">干货分享</a></h3>
                        </li>
                    </ul>
                </li>
                <li class="nav_item"><a title="使用指南" href="http://twww.smsbao.com/help">使用指南</a></li>
                <li class="nav_item"><a title="短信接口" href="http://twww.smsbao.com/openapi">短信接口</a></li>
                <li class="nav_item"><a title="短信插件" href="http://twww.smsbao.com/plugin">建站插件</a></li>
                <!--<li class="nav_item"><a title="合作联盟" href="/joinin">合作联盟</a></li>-->
                <li class="nav_item"><a title="短信价格查询" href="http://twww.smsbao.com/fee">资费标准</a></li>
            </ul>
        </div>
    </div>
    <div class="content">
        @yield('content')

        @yield('js')
    </div>
    <div class="footer ">
        <div class="webContainer">
            <div class="footer-nav-box service">

            </div>
            <div class="footer-nav-box support product">
                <div class="footer-title">
                    <h2><a href="/contactus" style="color:#fff">服务与产品</a></h2>
                    <span class="ft-bg"></span>
                </div>
                <div class="footer-box">
                    <ul>
                        <li class="first fw">
                            <a href=""><span>营销服务5</span></a>
                        </li>
                        <li class="first fw">
                            <a href=""><span>营销服务4</span></a>
                        </li>
                        <li class="first fw">
                            <a href=""><span>营销服务3</span></a>
                        </li>
                        <li class="first fw">
                            <a href=""><span>营销服务2</span></a>
                        </li>
                        <li class="first fw">
                            <a href=""><span>营销服务1</span></a>
                        </li>
                        <li class="first fw">
                            <a href=""><span>营销服务</span></a>
                        </li>

                    </ul>
                    <!--<p class="webQQgroup"><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=15766f40539827f7fb3d10bb9b9699b6a7ff3cfa7162341d46cb8f79e4f7dae3"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="点击这里加入此群" title="点击这里加入此群"></a></p>-->
                </div>
            </div>
            <div class="footer-nav-box support">
                <div class="footer-title">
                    <h2><a href="/contactus" style="color:#fff">联系我们</a></h2>
                    <span class="ft-bg"></span>
                </div>
                <div class="footer-box">
                    <p>
                        客服邮箱：<br>
                        support@smsbao.com
                        <a target="_blank" href="http://wpa.b.qq.com/cgi/wpa.php?ln=1&amp;key=XzkzODA0NjAyMV8yNTU0MzFfNDAwMDA5MDQ2NV8yXw">
                            <img src="http://wpa.qq.com/pa?p=2:123456:51" alt="短信宝客服" title="短信宝客服" border="0"></a>

                    </p>
                    <!--<p class="webQQgroup"><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=15766f40539827f7fb3d10bb9b9699b6a7ff3cfa7162341d46cb8f79e4f7dae3"><img border="0" src="http://pub.idqqimg.com/wpa/images/group.png" alt="点击这里加入此群" title="点击这里加入此群"></a></p>-->
                </div>
            </div>
            <div class="footer-nav-box aboutus">
                <div class="footer-title">
                    <h2>使用指南</h2>
                    <span class="ft-bg"></span>
                </div>
                <div class="footer-box">
                    <ul>

                        <li class="first">
                            <a href="/help/index.html">使用指南</a><br>
                        </li>
                        <li class="first">
                            <a href="/help/faq.html">常见问题</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-nav-box aboutus">
                <div class="footer-title">
                    <h2><a href="/aboutus" style="color:#fff">关于我们</a></h2>
                    <span class="ft-bg"></span>
                </div>
                <div class="footer-box">
                    <ul>
                        <li class="first">
                            <a href="http://t.qq.com/smsbao" target="_blank">腾讯微博</a><br>
                        </li>
                    </ul>
                </div>
            </div>
            <!--<div  class="footer-qcode">-->
            <!--<img  class="lazy"  src="/style_sb/images/qr-code.png"  height="141">-->
            <!--</div>-->
        </div>
    </div>
    <div class="page-bottom">
        <ul><li>友情链接：</li><li><a href="http://www.gap.cn/" target="_blank">GAP</a> </li><li><a href="http://www.kaola.com" target="_blank">考拉网</a> </li><li><a href="http://www.luzhou.com/" target="_blank">大泸网</a> </li><li><a href="http://www.niwodai.com" target="_blank">P2P理财论坛</a> </li><li><a href="http://www.wforder.com" target="_blank">WFPHP在线订单管理系统</a> </li><li><a href="http://www.niucms.cn/" target="_blank">Niucms智慧生活系统</a> </li><li><a href="https://www.yungoucms.com/" target="_blank">yungoucms</a> </li><li><a href="https://www.lanyeyun.com" target="_blank">蓝叶云</a> </li><li><a href="http://www.zhicms.cc/" target="_blank">zhicms</a> </li><li><a href="http://www.ddy.me/" target="_blank">兜兜友</a> </li><li><a href="http://www.demohour.com/" target="_blank">点名时间</a> </li><li><a href="http://www.hua0.com/" target="_blank">花里花店</a> </li><li><a href="http://oldnavy.gap.cn/" target="_blank">Old Navy</a> </li></ul>
        <p>Copyright © 2010-2014 smsbao.com All Rights Reserved <br>上海子橙电子科技有限公司 沪ICP备14008182号-1 上海市松江区广富林路658弄215号</p>
    </div>
    <script>
        var wfs = $(".wfs");
        $(function(){
            var source=getCookie('unsent');
            if( source > 0){
                getwfs(source);
            }
        })

        function getwfs(source){
            wfs.html('<a style="height:26px;" href="http://tassistant.smsbao.com/unsent"><img src="/public/img/sms1.png" style="height:20px;width:20px;"><div class="num">未提交短信'+source+'条</div></a>')
        }

        function getCookie(name)
        {
            var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");

            if(arr=document.cookie.match(reg))

                return unescape(arr[2]);
            else
                return null;
        }
    </script>
    <script>
        function response(words){
            if(words == 'error'){
                console.log('用户未登入');
            }else{
                document.cookie="username="+words;
                login(words);
            }
        }
        function login(words){
            $(".first").html('<a href="http://twww.smsbao.com/member/index.jhtml">'+words+'</a>')
            $("#current_member .last").html('<a href="http://twww.smsbao.com/logout.jhtml">退出</a>')
        }
        </script>
    <script src="http://twww.smsbao.com/service.php?callback=response"></script>
</div>
</body>
</html>
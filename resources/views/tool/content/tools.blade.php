@extends('tool.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/service.css') }}">
@stop

@section('content')
    <div role="main">
        <!--横幅广告开始-->
        <div class="services-banner">
            <div class="container">
                <div class="column one-half">
                    <h1 class="directory-header">
                        短信宝短信插件
                    </h1>
                    <h2 class="directory-tag">
                        海纳百川，为众多开源程序提供短信插件
                    </h2>
                    <p class="lead">
                        安全稳定的短信插件，帮助您的网站快速获得发送短信的能力
                    </p>
                </div>
                <div class="marketing-graphic column one-two">
                    <img style="width: 490px; height: 140px;" src="https://assets-cdn.github.com/images/modules/integrations/integrations-directory-graphic.svg?v=1">
                </div>
            </div>
        </div>
        <!--横幅广告结束-->
        <!--服务导航开始-->
        <div class="services-nav">
            <div class="about_site">
                你的位置：<a href="">短信宝</a>><a href="">短信服务</a>
            </div>
        </div>
        <!--服务导航结束-->
        <!--主题内容开始-->
        <div class="services-content">
            <div class="sitecon">
                <div class="service-left">
                    <!--<div class="services-show-t">-->
                    <!--<div class="services-show-t-s">-->
                    <!--<div class="title">服务分类</div>-->
                    <!--<ul class="cate">-->
                    <!--<li><img src="image/1.png" style="height:150px;"></li>-->
                    <!--<li><img src="image/2.png" style="height:150px;"></li>-->
                    <!--<li><img src="image/3.png" style="height:150px;"></li>-->
                    <!--<li><img src="image/4.png" style="height:150px;"></li>-->
                    <!--</ul>-->
                    <!--</div>-->
                    <!--</div>-->

                    <div class="services-show-k">
                        <div class="services-show-s">
                            <div class="services-title">
                                <div id="date"></div>
                                <h3>{{$category->name}}模板</h3>
                            </div>
                            @if (count($temple)==0)
                                <h3>没有搜索到你所需要的内容。</h3>
                            @endif
                            <ul>
                                @foreach($temple as $row)
                                    <li><div class="service">
                                            <p class="service-main">
                                                {{ $row->content }}
                                            </p>
                                            <a href="/qunfa/{{ $row->id }}">一键发送</a>
                                        </div></li>
                                @endforeach
                            </ul>
                            <?php echo $temple->render(); ?>
                        </div>
                    </div>
                </div>
                <div class="service-right">
                    <div class="search">
                        <form role="search" action="{{ route('mysearch') }} " method="get">
                            <input class="ss" name="search" type="text" placeholder="输入你要搜索的内容"><a class="buttom"></a>
                        </form>
                        @if(isset($category->hot_tags))
                        <h3>热门标签:</h3>
                            @php
                                $hot_tag = explode("，",$category->hot_tags);
                            @endphp
                                @foreach($hot_tag as $tag)<a href="/smstool?search={{$tag}}" class="tag">{{$tag}}</a>@endforeach
                            @endif
                    </div>
                    <div class="groom">
                        <span>热门助手TOP5</span>
                        <ul>
                            @foreach($topTool as $row)
                            <li><a href="/smstool/{{ $row->id }}"><i><img src="{{ Voyager::image( $row->image ) }}" style="height:24px;"></i><h2>{{$row->name}}</h2></a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="hot">
                        <span>为你推荐</span>
                        <div class="phone">
                            <div class="mask">
                                <ul>
                                    @foreach($topSms as $row)
                                    <li><a href="/qunfa/{{ $row->id }}">【短信签名】{{ $row->content }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="category">
                <ul>
                    @foreach($tool as $row)
                        <li><a href="/smstool/{{ $row->id }}"><i><img src="{{ Voyager::image( $row->image ) }}" style="height:60px;"></i><h3>{{$row->name}}</h3></a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!--主体内容结束-->

    </div>
@stop

@section('js')
    <script>
    $(function(){
        var t =4000//定义循环时间
        var num = $(".mask ul li").size();
        $(".mask ul li:first").addClass('show');
        function action(cl){
            var i = '.'
            i += cl;
            var object = $(i);
            realize(object);
        }
        //实现效果
        function realize(object){
            var show = object.children("ul").children(".show")
            setTimeout(function () {
                show.fadeOut("slow",function(){
                    $(this).removeClass();
                    var display = next(show);
                    display.fadeIn("fast",function(){
                        $(this).addClass('show');
                        action('mask');
                    });
                });
            }, t);
        }
        //获取下个一个
        function next(show){
            var next = show.next();
            if(next.length == 1){
                return next;
            }else{
                var ol = show.prevAll("li:first");
                return ol;
            }
        }

        $(".buttom").click(function(){
            $(".search form").submit();
        })

        if(num > 1){
        action('mask');
        }
    })

    </script>
@stop

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
                                <a href="">more</a>
                            </div>
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
                        </div>
                    </div>
                </div>
                <div class="service-right">
                    <div class="groom">
                        <span>热门助手TOP5</span>
                        <ul>
                            <li><a href=""><i><img src="{{ URL::asset('img/tbk.png') }}" style="height:24px;"></i><h2>淘宝客</h2></a></li>
                            <li><a href=""><i><img src="{{ URL::asset('img/zufu.png') }}" style="height:24px;"></i><h3>祝福短信</h3></a></li>
                            <li><a href=""><i><img src="{{ URL::asset('img/yx.png') }}" style="height:24px;"></i><h3>营销短信</h3></a></li>
                            <li><a href=""><i><img src="{{ URL::asset('img/gzh.png') }}" style="height:24px;"></i><h3>不知道什么短信</h3></a></li>
                            <li><a href=""><i><img src="{{ URL::asset('img/mi.png') }}" style="height:24px;"></i><h3>迷之短信</h3></a></li>
                        </ul>
                    </div>
                    <div class="hot">
                        <span>热门短信TOP10</span>
                        <ul>
                            @foreach($topSms as $row)
                            <li><a href="/qunfa/{{ $row->id }}">{{ $row->content }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--主体内容结束-->

    </div>
@stop
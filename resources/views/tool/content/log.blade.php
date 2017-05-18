@extends('tool.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/history.css')}}">
@endsection

@section('content')
    <div id="content">
        <title>历史记录</title>
        <div class="title"><h3>发送历史</h3></div>
        <div class="main">
            <table class="main-log">
                <thead>
                <tr>
                    <th style="width:510px;">
                        <div class="main-l">分类</div>
                        <div class="main-r">发送内容</div>
                    </th>
                    <th><h3>总金额金额</h3></th>
                    <th><h3>状态</h3></th>
                    <th><h3>操作</h3></th>
                </tr>
                </thead>

                @if($info == null)
                    <tbody>
                    没有记录
                    </tbody>
                @else
                    @foreach($info as $key=>$value)
                        <tbody>
                        <tr class="sep-row">
                            <td colspan="5"></td>
                        </tr>
                        <tr class="tr-th">
                            <td colspan="5">
                                <span class="gap"></span>
                                <span class="time">{{$value['created_at']}}</span>
                            </td>
                        </tr>
                        <tr class="tr-bd">
                            <td>
                                <div class="goods-item">
                                    <div class="p-img">
                                        <img src="/storage/{{$value['category']['image']}}">
                                    </div>
                                    <div class="p-msg">
                                        {{$value['content']}}
                                    </div>
                                </div>
                                <div class="goods-number">X{{count(json_decode($value['phone'], true))}}</div>
                            </td>
                            <td rowspan="1">
                                <span class="tooltip">￥{{count(json_decode($value['phone'], true))*$value['category']['price']}}</span>
                                <span><img src="{{asset('img/coin.png')}}"></span>
                            </td>
                            <td rowspan="1">
                                <span class="tooltip">已完成</span>
                            </td>
                            <td  rowspan="1">
                                <a class="again" href="{{url('/import',['id'=>$value['id']])}}">再次发送</a>
                            </td>
                        </tr>
                        </tbody>
                    @endforeach
                @endif

            </table>
        </div>
    </div>
@endsection
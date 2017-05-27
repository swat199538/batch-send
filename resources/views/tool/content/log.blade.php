@extends('tool.master')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{URL::asset('css/history.css')}}">
@endsection

@section('content')
    <div id="content">
        <div class="title"><h3 style=>未提交短信</h3></div>
        <div class="main">
            <table class="main-log">
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
                               <span class="tooltip">{{$value['category']['name']}}</span>
                            </td>
                            <td>
                                <div class="goods-item">
                                    {{--<div class="p-img">--}}
                                        {{--<img src="/storage/{{$value['category']['image']}}">--}}
                                    {{--</div>--}}
                                    <div class="p-msg">
                                        {{$value['content']}}
                                    </div>
                                </div>
                            </td>
                            <td rowspan="1">
                                <span class="tooltip">{{count(json_decode($value['phone'], true))}}个手机号码</span>
                            </td>
                            {{--<td rowspan="1">--}}
                                {{--<span class="tooltip">已完成</span>--}}
                            {{--</td>--}}
                            <td  rowspan="1">
                                <a class="again" href="{{url('/unsent',['id'=>$value['id']])}}">发送</a>
                            </td>
                        </tr>
                        </tbody>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
@endsection
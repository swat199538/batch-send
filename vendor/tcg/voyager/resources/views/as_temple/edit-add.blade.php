@extends('voyager::master')

@if(isset($dataTypeContent->id))
    @section('page_title','编辑 '.$dataType->display_name_singular)
@else
    @section('page_title','新增 '.$dataType->display_name_singular)
@endif

@section('css')
    <style>
        .panel .mce-panel {
            border-left-color: #fff;
            border-right-color: #fff;
        }

        .panel .mce-toolbar,
        .panel .mce-statusbar {
            padding-left: 20px;
        }

        .panel .mce-edit-area,
        .panel .mce-edit-area iframe,
        .panel .mce-edit-area iframe html {
            padding: 0 10px;
            min-height: 350px;
        }

        .mce-content-body {
            color: #555;
            font-size: 14px;
        }

        .panel.is-fullscreen .mce-statusbar {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 200000;
        }

        .panel.is-fullscreen .mce-tinymce {
            height:100%;
        }

        .panel.is-fullscreen .mce-edit-area,
        .panel.is-fullscreen .mce-edit-area iframe,
        .panel.is-fullscreen .mce-edit-area iframe html {
            height: 100%;
            position: absolute;
            width: 99%;
            overflow-y: scroll;
            overflow-x: hidden;
            min-height: 100%;
        }
    </style>
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> @if(isset($dataTypeContent->id)){{ '编辑' }}@else{{ '新增' }}@endif {{ $dataType->display_name_singular }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content container-fluid">
        <form class="form-edit-add" role="form" action="@if(isset($dataTypeContent->id)){{ route('voyager.as_temple.update', $dataTypeContent->id) }}@else{{ route('voyager.as_temple.store') }}@endif" method="POST" enctype="multipart/form-data">
            <!-- PUT Method if we are editing -->
            @if(isset($dataTypeContent->id))
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">
                    <!-- ### TITLE ### -->
                    <div class="panel">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{--<div class="panel-body">--}}
                            {{--@include('voyager::multilingual.input-hidden', [--}}
                                {{--'_field_name'  => 'title',--}}
                                {{--'_field_trans' => get_field_translations($dataTypeContent, 'title')--}}
                            {{--])--}}
                            {{--<input type="text" class="form-control" id="slug" name="name" placeholder="助手名称" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif">--}}
                        {{--</div>--}}
                    </div>

                    <!-- ### CONTENT ### -->
                <div class="panel">
                <div class="panel-heading">
                <h3 class="panel-title"><i class="icon wb-book"></i> 短信助手-短信内容</h3>
                <div class="panel-actions">
                <a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
                </div>
                </div>
                @include('voyager::multilingual.input-hidden', [
                '_field_name'  => 'content',
                '_field_trans' => get_field_translations($dataTypeContent, 'content')
                ])
                <textarea class="form-control"name="content" style="min-height:150px;width:95%;margin:0 auto;margin-bottom:25px;">@if(isset($dataTypeContent->content)){{ $dataTypeContent->content }}@endif</textarea>
                </div><!-- .panel -->
                </div>
                <div class="col-md-4">
                    <!-- ### DETAILS ### -->
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-heading"><h3 class="panel-title">助手属性</h3><div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">用户点击数</label>
                                <input type="text" class="form-control" id="slug" name="click_count"
                                       placeholder="0"
                                       {{!! isFieldSlugAutoGenerator($dataType, $dataTypeContent, "click_count") !!}}
                                       value="@if(isset($dataTypeContent->click_count)){{ $dataTypeContent->click_count }}@else 0 @endif">
                            </div>
                            <div class="form-group">
                                <label for="name">助手分类</label>
                                <select class="form-control" name="category_id">
                                    @foreach(TCG\Voyager\Models\AsCategory::all() as $category)
                                        <option value="{{ $category->id }}" @if(isset($dataTypeContent->category_id) && $dataTypeContent->category_id == $category->id){{ 'selected="selected"' }}@endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{--<div class="form-group">--}}
                            {{--<label for="name">Featured</label>--}}
                            {{--<input type="checkbox" name="featured" @if(isset($dataTypeContent->featured) && $dataTypeContent->featured){{ 'checked="checked"' }}@endif>--}}
                            {{--</div>--}}
                        </div>
                    </div>


                    <!-- ### SEO CONTENT ### -->
                    <div class="panel panel-bordered panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-search"></i>SEO 优化内容</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">SEO关键字</label>
                                @include('voyager::multilingual.input-hidden', [
                                    '_field_name'  => 'seo_word',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'seo_word')
                                ])
                                <textarea class="form-control" name="seo_word">@if(isset($dataTypeContent->seo_word)){{ $dataTypeContent->seo_word }}@endif</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right">
                @if(isset($dataTypeContent->id)){{ '修改' }}@else <i class="icon wb-plus-circle"></i>创建 @endif
            </button>
        </form>

        <iframe id="form_target" name="form_target" style="display:none"></iframe>
        <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
            {{ csrf_field() }}
            <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
            <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
        </form>
    </div>
@stop

@section('javascript')
    <script>
        $('document').ready(function () {
            $('#slug').slugify();

            @if ($isModelTranslatable)
                $('.side-body').multilingual({"editing": true});
            @endif
        });
    </script>
    @if($isModelTranslatable)
        <script src="{{ voyager_asset('js/multilingual.js') }}"></script>
    @endif
    <script src="{{ voyager_asset('lib/js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ voyager_asset('js/voyager_tinymce.js') }}"></script>
    <script src="{{ voyager_asset('js/slugify.js') }}"></script>
@stop

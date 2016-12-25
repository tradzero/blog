@extends('admin.master')
@section('title')撰写新文章@endsection
@section('content')
@include('editor::head')
    <div class="container-fluid">
        <div class="row">
            <!-- main -->
            <form action="/admin/posts" method="POST">
                <div class="col-md-9">
                    {{ csrf_field() }}
                    <div class="form-group">
                        @if($errors->has('title'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-ban"></i> 提示!</h4>
                            {{ $errors->first('title') }}
                        </div>
                        @endif
                        <input class="form-control" name="title" type="text" placeholder="在此输入标题">
                    </div>

                    <div class="form-group">
                        <div class="editor">
                            @if($errors->has('content'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-ban"></i> 提示!</h4>
                                {{ $errors->first('content') }}
                            </div>
                            @endif
                            <textarea name="content" class="form-control" id="myEditor"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">发表</button>
                    </div>
                </div>
                <!-- toolbar -->
                <div class="col-md-3">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">选项</h3>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <label class="form-control" for="visible-select">选择文章可见性</label>
                                <select class="form-control" name="visible" id="visible-select">
                                    <option value="0" selected>对所有人可见</option>
                                    <option value="1">对认证用户可见</option>
                                    <option value="2">隐藏(对自己可见)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

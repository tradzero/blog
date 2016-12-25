@extends('admin.master')
@section('title')撰写新文章@endsection
@section('content')
@include('editor::head')
    <div class="container-fluid">
        <div class="row">
            <!-- main -->
            <div class="col-md-9">
                <form action="/admin/posts" method="POST">
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
                </form>
            </div>
            <!-- toolbar -->
            <div class="col-md-3">
            </div>
        </div>
    </div>
@endsection

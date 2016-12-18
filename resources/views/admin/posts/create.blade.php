@extends('admin.master')
@section('title')撰写新文章@endsection
@section('content')
@include('editor::head')
    <div class="container-fluid">
        <div class="row">
            <!-- main -->
            <div class="col-md-9">
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="在此输入标题">
                </div>
                <div class="form-group">
                    <div class="editor">
                        <textarea id='myEditor'></textarea>
                    </div>
                </div>
            </div>
            <!-- toolbar -->
            <div class="col-md-3">
            </div>
        </div>
    </div>
@endsection

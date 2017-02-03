@extends('admin.master')
@section('title')分类管理@endsection
@section('subtitle')新的分类@endsection
@section('style')
    <link href="//cdn.bootcss.com/bootstrap-sweetalert/1.0.1/sweetalert.min.css" rel="stylesheet">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <form action="{{ URL::route('tags.store') }}" method="POST">
                {{ csrf_field() }}
                <div class="col-md-9">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="在此输入分类名" value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">创建</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
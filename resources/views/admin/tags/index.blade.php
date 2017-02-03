@extends('admin.master')
@section('title')分类管理@endsection
@section('subtitle')所有分类@endsection

@section('content')
    <div>
        @if(session('success'))
            @include('admin.component.alert-success', ['success' => session('success')])
        @endif
    </div>
    <div class="container-fluid">
        <div class="row">
            <a href="{{ URL::route('tags.create') }}" class="btn btn-primary">新的分类</a>
        </div>
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <span class="box-title">分类列表</span>
                </div>
                <div class="box-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>分类名</th>
                                <th>已有文章数</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                    <th>{{ $tag->name }}</th>
                                    <th>{{ $tag->posts_count }}</th>
                                    <th>
                                        <a href="{{ URL::route('tags.edit', $tag->id) }}" class="btn btn-primary">修改</a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $tags->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
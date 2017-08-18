@extends('admin.master')
@section('title')文章管理@endsection
@section('style')
    <link href="//cdn.bootcss.com/bootstrap-sweetalert/1.0.1/sweetalert.min.css" rel="stylesheet">
@endsection
@section('content')
    <div>
        @if(session('success'))
            @include('admin.component.alert-success', ['success' => session('success')])
        @endif
    </div>
    <div class="container-fluid">
        <div class="row">
            <a href="{{ URL::route('posts.create') }}" class="btn btn-primary">写文章</a>
        </div>
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <span class="box-title">文章列表</span>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>文章id</th>
                                <th>文章标题</th>
                                <th>赞</th>
                                <th>踩</th>
                                <th>可见性</th>
                                <th>删除？</th>
                                <th>创建时间</th>
                                <th>上次修改时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->id }}</td>
                                    <td><a href="{{ URL::route('posts.edit', $post->id) }}">{{ $post->title }}</a></td>
                                    <td>{{ $post->like }}</td>
                                    <td>{{ $post->unlike }}</td>
                                    <td>{{ trans('post.visible:' . $post->visible) }}</td>
                                    <td>{{ $post->is_deleted ? '是' : '否' }}</td>
                                    <td>{{ $post->created_at->diffForHumans() }}</td>
                                    <td>{{ $post->updated_at->diffForHumans() }}</td>
                                    <td>
                                        @if(!$post->is_deleted)
                                            @can('adminDestroy', $post)
                                                <form action="{{ URL::route('posts.destroy', $post->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="button" onclick="deleteConfirm(this.parentNode)" class="btn btn-danger">删除</button>
                                                </form>
                                            @endcan
                                        @else
                                            @can('adminRecovery', $post)
                                                <form action="{{ URL::route('posts.recovery', $post->id) }}" method="POST">
                                                    {{ csrf_field() }}
                                                    {{ method_field('PATCH') }}
                                                    <button type="button" onclick="recoveryConfirm(this.parentNode)" class="btn btn-primary">恢复</button>
                                                </form>
                                            @endcan
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer clear-fix">
                    <div class="no-margin pull-right">
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="//cdn.bootcss.com/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
    <script>
        function deleteConfirm(that)
        {
            swal({
                title: "是否确定删除",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "删除",
                cancelButtonText: "取消",
                closeOnConfirm: false,
                closeOnCancel: true
            },function(confirm){
                if(confirm){
                    that.submit();
                }
            });
        }
        function recoveryConfirm(that)
        {
            swal({
                title: "是否确定恢复",
                type: "info",
                showCancelButton: true,
                confirmButtonClass: "btn-primary",
                confirmButtonText: "恢复",
                cancelButtonText: "取消",
                closeOnConfirm: false,
                closeOnCancel: true
            },function(confirm){
                if(confirm){
                    that.submit();
                }
            });
        }
    </script>
@endsection
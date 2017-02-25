@extends('admin.master')
@section('title')评论管理@endsection
@section('subtitle')评论列表@endsection
@section('style')
    <link href="//cdn.bootcss.com/bootstrap-sweetalert/1.0.1/sweetalert.min.css" rel="stylesheet">
    <style>
        .th-title {
            width: 17%;
        }
        .th-comment {
            width: 35%;
        }
        .th-user {
            width: 10%;
        }
        .th-time {
            width: 8%;
        }
        .th-status {
            width: 8%;
        }
        .th-opera {
            width: 22%;
        }
        .td-cut {
            overflow:hidden;
            text-overflow:ellipsis;
            white-space: nowrap;
        }
        .table-fix {
            table-layout: fixed;
        }
        .table>tbody>tr>td, 
        .table>tbody>tr>th, 
        .table>tfoot>tr>td, 
        .table>tfoot>tr>th, 
        .table>thead>tr>td, 
        .table>thead>tr>th {
            vertical-align: middle;
            text-align: center;
        }
    </style>
@endsection
@section('content')
    <div>
        @if(session('success'))
            @include('admin.component.alert-success', ['success' => session('success')])
        @endif
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <span class="box-title">评论列表</span>
                </div>
                <div class="box-body">
                    <table class="table table-striped table-responsive table-hover table-fix">
                        <thead>
                            <tr>
                                <th class="th-user">作者</th>
                                <th class="th-comment">评论内容</th>
                                <th class="th-title">回复至</th>
                                <th class="th-time">评论时间</th>
                                <th class="th-status">评论状态</th>
                                <th class="th-opera">操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td>
                                        {{ $comment->user->nickname }}
                                        <br>
                                        {{ $comment->user->username }}
                                    </td>
                                    <td>
                                        {{ $comment->comment }}
                                    </td>
                                    <td class="td-cut">
                                        <a href="/post/{{ $comment->post->id }}">{{ $comment->post->title }}</a>
                                    </td>
                                    <td>
                                        {{ $comment->created_at->diffForHumans() }}
                                    </td>
                                    <td>
                                        {{ $comment->is_deleted ? '审核中' : '显示中' }}
                                    </td>
                                    <td>
                                        <div class="button-group">
                                            <a href="{{ URL::route('comments.show', $comment->id) }}" class="btn btn-info">查看</a>
                                            @if($comment->is_deleted)
                                                <button onclick="setVisibility('pass', {{ $comment->id }})" class="btn btn-success">通过</button>
                                            @else
                                                <button onclick="setVisibility('deny', {{ $comment->id }})" class="btn btn-danger">隐藏</button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $comments->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="//cdn.bootcss.com/axios/0.15.3/axios.min.js"></script>
    <script>
        function setVisibility(attribute, id)
        {
            var url = '/admin/comments/' + id + '/' + attribute;
            axios.post(url, null, {
                header: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(function(data) {
                location.reload();
            }).catch(function (error) {
                console.log(error);
            })
        }
    </script>
@endsection
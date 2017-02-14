@extends('admin.master')
@section('title')评论管理@endsection
@section('subtitle')查看评论@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="box">
                <div class="box-header with-border">
                    <div class="user-block">
                        <span class="username">{{ $comment->user->nickname }}</span>
                        <span class="description">评论发表于{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                <div class="box-body">
                    <h4>评论内容</h4>
                    <blockquote>{{ $comment->comment }}</blockquote>
                    <h4>相关文章</h4>
                    <div class="attachment-block clearfix">
                        <a href="/post/{{ $comment->post->id }}">{{ $comment->post->title }}</a>
                    </div>
                    <h4>当前状态</h4>
                    <p>
                        是否显示：<span class="label {{ $comment->is_deleted ? 'label-danger' : 'label-success' }}">{{ $comment->is_deleted ? '隐藏':'显示' }}</span>
                         共有{{ $comment->like }}人点赞, {{ $comment->unlike }}人点踩
                    </p>
                </div>
                <div class="box-footer">
                    <div class="clearfix list-inline">
                        <div class="pull-left">
                            <h4>操作</h4>
                        </div>
                        <div class="pull-right">
                            @if($comment->is_deleted)
                                <button onclick="setVisibility('pass', {{ $comment->id }})" class="btn btn-success">通过</button>
                            @else
                                <button onclick="setVisibility('deny', {{ $comment->id }})" class="btn btn-danger">隐藏</button>
                            @endif
                        </div>
                    </div>
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
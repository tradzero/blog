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
                    <p>{{ $comment->comment }}</p>
                    <h4>相关文章</h4>
                    <div class="attachment-block clearfix">
                        <a href="/post/{{ $comment->post->id }}">{{ $comment->post->title }}</a>
                    </div>
                </div>
                <div class="box-footer">
                    
                </div>
            </div>
        </div>
    </div>
@endsection
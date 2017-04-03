@extends('admin.master')
@section('title')用户资料@endsection
@section('subtitle'){{ $user->nickname }}的个人资料@endsection
@section('style')
    <style>
        .counter {
            font-size: 3.8vh;
            color: #3C8DBC;
            display: block;
            text-decoration: none;
        }
    </style>
@endsection
@section('content')
    <!-- left side -->
    <div class="row">
        <div class="col-md-3">
            <!-- user infomation -->
            <div class="box">
                <div class="box-body">
                    <div class="image">
                        <img class="profile-user-img img-responsive img-circle" src="{{ $user->avatar ? : asset('avatar.png') }}">
                    </div>
                    <h3 class="profile-username text-center">
                        {{ $user->nickname }}
                    </h3>
                    <p class="text-muted text-center">
                        ID: {{ $user->username }}
                    </p>
                    <hr>
                    <div class="row">
                        <div class="text-center">
                            <div class="col-md-6">
                                <p class="text-muted">
                                    <span class="counter">{{ $user->comments_count }}</span>
                                    评论
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="text-muted">
                                    <span class="counter">{{ $user->posts_count }}</span>
                                    文章
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-success btn-block btn-flat">编辑资料</a>
                </div>
            </div>
        </div>
        <!-- right side -->
        
        <div class="col-md-9">
            @if(Auth::user()->can('create', App\Post::class))
                <div class="box with-border">
                    <div class="box-header">
                        <span class="box-title">最新文章</span>
                    </div>
                    <div class="box-body">
                        <div class="text-center">
                            <a href="{{ route('posts.create') }}" class="btn btn-primary btn-flat">
                                <i class="fa fa-paint-brush"> 写一篇文章</i>
                            </a>
                        </div>
                        <br>
                        <div>
                            @foreach($user->posts as $post)
                                <a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a> <span class="text-muted"> {{ $post->like }} 赞 - {{ $post->created_at->diffForHumans() }}</span> 
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <div class="box with-border">
                <div class="box-header">
                    <span class="box-title">最新评论</span>
                </div>
                <div class="box-body">
                    @foreach($user->comments as $comment)
                        <a href="{{ route('post.show', $comment->post->id) }}">{{ $comment->post->title }}</a> <span class="text-muted"> - {{ $comment->created_at->diffForHumans() }}</span>
                        <blockquote>
                            {{ $comment->comment }}
                        </blockquote>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
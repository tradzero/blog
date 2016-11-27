<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="https://use.fontawesome.com/4e5ef8f80f.js"></script>
        <title>{{ $post->title }}</title>
        <!-- Fonts -->
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/front.css" rel="stylesheet">
        <!-- Styles -->
        <script src="/js/jquery-3.1.1.js"></script>
    </head>
<body>
    <div class="flex-center position-ref full-height">
        @include('component.loginbar')
        <div class="top-left">
            <a class="navi" href="/"><i class="fa fa-home fa-5" aria-hidden="true"></i></a>
        </div>
        <div class="header">
            <div class="postTitle">{{ $post->title }}</div>
        </div>
        <div class="article">
            <div class="postInfo center">
                <div class="postTags">
                    @foreach($post->tags as $tag)
                        <a href="/tag/{{ $tag->id }}">{{ $tag->name }}</a>
                    @endforeach
                </div>
                <div class="postDate">
                    {{ $post->created_at }}
                </div>
            </div>
            <div class="content postContent">
                {{ $post->content }}
            </div>
        </div>
        <div class="about">
            <p>本文标签：@foreach($post->tags as $tag){{ $tag->name }} @endforeach </p>
            <p>本文作者：{{ $post->user->username }}</p>
            <p>已有：{{ $post->like }} 点赞</p>
            <p>已有：{{ $post->unlike }} 踩</p>
        </div>
        <div class="comments">
            @foreach($post->comments as $comment)
                <div class="comment">
                    {{ $comment->comment }}
                    <p>点赞：{{ $comment->like }} 踩：{{ $comment->unlike }} {{ $comment->created_at }} </p>
                </div>
            @endforeach
            <form action="/post/{{ $post->id }}/comment" method="post">
                {{ csrf_field() }}
                <textarea name="" id="" cols="30" rows="10" placeholder="留下你的评论"></textarea>
                <p><button type="submit">提交</button></p>
            </form>
        </div>
    </div>
</body>
</html>
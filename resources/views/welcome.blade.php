<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <title>{{ config('blog.name') }}</title>

        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">
        <link href="/css/front.css" rel="stylesheet">
        <link rel="stylesheet" href="/css/welcome.css">
        <!-- Script -->
        <script src="/js/jquery.min.js"></script>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="wrap">
                @include('component.loginbar')
                <div class="header">
                    <div class="title">
                        {{ config('blog.name') }}
                    </div>
                    <div class="subtitle m-b-md">
                        {{ config('blog.second_title') }}
                    </div>
                    <div class="navi">
                        @foreach(config('blog.urls') as $name => $url)
                            <a href="{{ $url }}">{{ $name }}</a>
                        @endforeach
                    </div>
                </div>
                @foreach($indexPosts as $post)
                <div class="article">
                    <div>
                        <div class="content content-title m-b-md"><a href="/post/{{$post->id}}">{{ $post->title }}</a></div>
                        <div class="wysiwyg">
                            <div>
                                {!! $post->content !!}
                            </div>
                        </div>
                    </div>
                    <div class="article-footer">
                        <p>
                            <span>
                                <i class="fa fa-calendar"></i>
                                {{ $post->created_at }} 发表于 {{ (new Carbon($post->created_at))->diffForHumans() }}
                            </span>
                            <span><i class="fa fa-user"></i> <a href="/users/{{ $post->user->id }}">{{ $post->user->nickname }}</a></span>
                            <span>
                                <i class="fa fa-thumbs-o-up" aria-hidden="true">{{ $post->like }}</i> 
                                <i class="fa fa-thumbs-o-down" aria-hidden="true">{{ $post->unlike }}</i>
                            </span>
                            <span><i class="fa fa-eye" aria-hidden="true"></i>已有{{ null != Redis::zscore('postViewCount', 'post:' . $post->id) ? : '0' }}次查看</span>
                        </p>
                    </div>
                </div>
                @endforeach
                <div class="paginator">
                    {{ $indexPosts->links('vendor.pagination.default') }}
                </div>
            </div>
            @include('component.footerbar')
        </div>
    </body>
</html>

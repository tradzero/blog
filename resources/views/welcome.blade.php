<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <title>Zero的胡言乱语</title>

        <!-- Fonts -->
        <link href="/css/app.css" rel="stylesheet">
        <!-- Styles -->
        <script src="/js/jquery-3.1.1.js"></script>
        <link href="/css/front.css" rel="stylesheet">
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @include('component.loginbar')
            <div class="header">
                <div class="title">
                    Zero的胡言乱语
                </div>
                <div class="subtitle m-b-md">
                    recoding, learning
                </div>
                <div class="navi">
                    <a target="_blank" href="http://www.weibo.com/u/2681234077/">weibo</a>
                    <a target="_blank" href="mailto:admin@drakframe.com">E-MAIL</a>
                    <a target="_blank" href="https://laravel.com/">Laravel</a>
                </div>
            </div>

            @foreach($indexPosts as $post)
            <div class="article">
                 <div class="content">
                    <div class="content-title m-b-md"><a href="/post/{{$post->id}}">{{ $post->title }}</a></div>
                    <div>{{ $post->content }}</div>
                </div>
                <div class="article-footer">
                    <p>
                         <span>
                            <i class="fa fa-calendar"></i>
                            {{ $post->created_at }} 发表于 {{ (new Carbon($post->created_at))->diffForHumans() }}
                        </span>
                         <span><i class="fa fa-user"></i> <a href="/user/{{ $post->user->id }}">{{ $post->user->nickname }}</a></span>
                         <span>
                            <i class="fa fa-thumbs-o-up" aria-hidden="true">{{ $post->like }}</i> 
                            <i class="fa fa-thumbs-o-down" aria-hidden="true">{{ $post->unlike }}</i>
                         </span>
                         <span><i class="fa fa-eye" aria-hidden="true"></i>已有{{ null != Redis::zscore('postViewCount', 'post:' . $post->id) ?
                                                                                  Redis::zscore('postViewCount', 'post:' . $post->id) : '0' }}次查看</span>
                    </p>
                </div>
            </div>
            @endforeach
            <div class="paginator">
                {{ $indexPosts->links('vendor.pagination.default') }}
            </div>
        </div>
    </body>
</html>

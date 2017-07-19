<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <title>{{ $user->nickname }}</title>
    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/front.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/welcome.css"> 
    <style>
        .user-detail {
            border: 1px solid #ddd;
            margin-top: 20px;
            padding: 15px;
            background: #f9f9f9;
            font-size: 12px;
            overflow: hidden;
            position: relative;
            border-radius: 8px;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
        }
        .user-tag {
            color: #fff;
            position: absolute;
            right: 20px;
            top: 0;
            background: #666;
            height: 25px;
            line-height: 25px;
            padding: 0 15px;
            border-radius: 0 0 5px 5px;
            -webkit-border-radius: 0 0 5px 5px;
            -moz-border-radius: 0 0 5px 5px;
        }
    </style>

    <!-- Script -->
    <script src="/js/jquery.min.js"></script>
</head>
<body>
    <div class="flex-center position-ref full-height">
        <div class="wrap">
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
            <div class="row">
                <div class="col-xs-6 col-sm-4 col-md-offset-4 user-detail text-center">
                    <div class="user-tag">关于作者</div>
                    {{ $user->nickname }}    
                </div>
            </div>
            @foreach($posts as $post)
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
        </div>
        <div class="paginator">
            {{ $posts->render('vendor.pagination.default') }}
        </div>
        @include('component.footerbar')
    </div>
</body>
</html>